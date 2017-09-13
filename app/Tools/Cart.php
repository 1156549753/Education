<?php

namespace App\Tools;

use Illuminate\Support\Facades\Session;
/***
购物车类
实现对购物车里边商品的添加、删除操作

购物车信息转化为二维数组的效果如下：
array(
商品id1=>array('course_id'=>'商品id','course_name'=>'名称','course_price'=>'单价'),
商品id2=>array('course_id'=>'商品id','course_name'=>'名称','course_price'=>'单价'),
商品id3=>array('course_id'=>'商品id','course_name'=>'名称','course_price'=>'单价'),
....
)
 */

class Cart{

    //购物车的一个属性，用于存放商品信息的
    private $cartInfo = array();

    function __construct(){
        $this -> loadData();
    }

    /***
    取得购物车里边已经存放的商品信息
    该方法是该类里边第一个被执行的方法
    在类的构造函数里边调用
     */
    function loadData(){
        if(Session::has('cart')){
            //获取购物车商品信息，并赋予给cartInfo成员属性
            $this->cartInfo = Session::get('cart');  //Array数组
        }
    }

    /***
    将商品添加到购物车里边
    @param $course = array('course_id'=>'商品id','course_name'=>'名称','course_price'=>'单价')
     */
    function add($course){
        $course_id = $course['course_id'];
        //对重复购买的商品要判断(还要判断当前的购物车是否为空，即是否是第一次添加商品)
        if(!empty($this->cartInfo) && array_key_exists($course_id, $this->cartInfo)){
            exit('课程不能重复购买！');
        } else {
            $this -> cartInfo[$course_id] = $course;
        }

        $this -> saveData();//将刷新的数据重新存入session
    }

    /***
    删除购物车里边指定的商品
    @param $course_id 被删除商品的id信息
     */
    function del($course_id){
        if(array_key_exists($course_id, $this -> cartInfo)){
            unset($this -> cartInfo[$course_id]);
        }
        $this -> saveData();//将刷新的数据重新存入session
    }

    /***
    清空购物车
     */
    function delall(){
        unset($this->cartInfo);
        $this -> saveData();//将刷新的数据重新存入session
    }


    /***
     * 获得购物车的商品数量和总价格
     */
    function getNumberPrice(){
        $number = 0;//商品数量
        $price = 0;//商品总价钱
        foreach($this->cartInfo as $_k => $_v){
            $number  += 1;
            $price += $_v['course_price'];
        }
        $arr['number'] = $number;
        $arr['price'] = $price;

        return $arr;
    }

    //返回购物车的商品信息，Array格式返回
    function getCartInfo(){
        return $this -> cartInfo;
    }

    /***
    将cartInfo数组的商品信息存入购物车
     */
    function saveData(){
        if(!empty($this->cartInfo)){
            Session::put('cart',$this->cartInfo);  //非空购物车
        }else{
            Session::put('cart','');    //空购物车
        }
    }
}


