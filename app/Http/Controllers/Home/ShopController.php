<?php
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Course;
use App\Tools\Cart;
use App\Http\Models\Order;
use App\Http\Models\Ordercourse;


use EchoBool\AlipayLaravel\Facades\Alipay;

class ShopController extends Controller
{
    //添加课程到购物车
    public function cart_tianjia(Request $request,Course $course){
        //把$course课程信息添加到Cart购物车中
        $info = [
            'course_id'=>$course->course_id,
            'course_name'=>$course->course_name,
            'course_price'=>$course->course_price,
            ];
        $cart = new Cart();
        $cart -> add($info);

        return view('home/shop/cart_tianjia',compact('course'));
    }

    //展示购物车信息
    public function cart_account(Request $request){
        //用户登录判断
        if(!\Auth::guard('home')->check()){
            //return redirect('home/student/login');
            //return \Redirect::guest('home/student/login');
            return redirect()->guest('home/student/login');
        }

        //获得购物车课程信息
        $cart = new Cart();
        $info = $cart -> getCartInfo();

        //把购物车课程的id获得出来
        $ids = array_keys($info); 
        //dd($ids);  //[1,2]
        $course_img = Course::whereIn('course_id',$ids)->pluck('cover_img','course_id')->toArray(); //[course_id=>img,course_id=>img]
        //dd($course_img); //array[id => "img" ,id => "img"]


        //获取购物车课程总数量、总价格
        $numberprice = $cart->getNumberPrice();

        return view('home/shop/cart_account',compact('info','numberprice','course_img'));
    }

    //给购物车结算
    public function cart_jiesuan(Request $request){
        //获取购物车信息
        $cart = new Cart();
        $cartinfo = $cart -> getCartInfo(); //返回购物车二维数组信息
        $numberprice = $cart->getNumberPrice(); //返回购物车商品总数量/总价格

         //① 生成订单信息
        $info = [
            'order_sn' => uniqid('帅你懂吗-'),
            'std_id' => \Auth::guard('home')->user()->std_id,
            'total_price' => $numberprice['price'],
        ];
        $order = Order::create($info);
        //② 生成订单详情信息
        foreach($cartinfo as  $v){
            \DB::table('order_course')->insert([
                    'order_id'=>$order ->order_id,
                    'course_id'=>$v['course_id'],
                    'course_price'=>$v['course_price'],
                ]);
        }
        //③ 清空购物车信息
        $cart->delall();

        //④ 支付宝支付
        //echo "订单生成ok，请进行支付宝支付";

        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $info['order_sn'];
        //订单名称，必填
        $subject = '苹果笔记本电脑'.time();
        //付款金额，必填
        $total_amount = $numberprice['price'];
        //商品描述，可空
        $body = 'macbook pro2';

        $customData = json_encode(['model_name' => 'ewrwe', 'id' => 121]);//自定义参数
        $response = Alipay::tradePagePay($subject, $body, $out_trade_no, $total_amount,$customData);
        //输出表单
        return $response['redirect_url'];
    }

    /**
     * 支付宝完成支付后的get同步请求地址
     * @param Request $request
     */
    public function cart_complete(Request $request)
    {
        //echo "支付已经成功完成";
        //echo "<pre>";
        //print_r($_GET);
        //echo "</pre>";

        //完成业务逻辑后续处理(改订单状态)
        //要把支付宝本身的“校验”机制引入过来
        $result = Alipay::notify($_GET);
        /* 实际验证过程建议商户添加以下校验。
            1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
            2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
            3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
            4、验证app_id是否为该商户本身。
         */

        if ($result) {//验证成功
            //请在这里加上商户的业务逻辑程序代码

            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

            //商户订单号
            $out_trade_no = $_GET['out_trade_no'];

            //支付宝交易号(流水号码)
            $trade_no = htmlspecialchars($_GET['trade_no']);

            //修改订单状态(未付款---->已付款)，根据业务需求也会产生一些日志辅助付款信息
            //同时标记 支付宝流水号码、付款时间、付款金额
            $rst = Order::where('order_sn', $out_trade_no)
                ->update([
                    'pay_status' => '是',
                    'trade_sn' => $trade_no,
                    'pay_time' => strtotime($_GET['timestamp']),
                    'pay_money' => $_GET['total_amount'],
                ]);

            if ($rst){
                return view('home/shop/cart_complete');
            }else{
                echo "付款成功，订单数据更新失败";
            }
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
        } else {
            //验证失败
            echo "验证失败";
        }
    }
}


















