<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $table = "order";   //设置表名
    protected $primaryKey = "order_id";//设置主键

    //"限制"通过form表单修改的字段,只有如下字段允许修改
    protected $fillable = ['order_sn','trade_sn','std_id','total_price','pay_money','pay_time','pay_status'];

    //设置软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
