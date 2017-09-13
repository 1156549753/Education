<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*CREATE TABLE `qz_manager` (
  `mg_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `password` char(60) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `mg_role_ids` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '角色ids',
  `mg_sex` enum('男','女') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '男' COMMENT '性别',
  `mg_phone` char(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '手机号码',
  `mg_email` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `mg_remark` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '备注',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '删除时间',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '记住我标记',
  PRIMARY KEY (`mg_id`),
  UNIQUE KEY `manager_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
*/
        //利用php实现数据表的创建
        //$table必须使用Blueprint声明，代表其是对象，并可以调用成员
        Schema::create('manager',function(Blueprint $table){
            $table -> increments('mg_id')->comment('主键');
            $table -> string('username',64)->comment('名称'); //string-->varchar()  char-->char()
            $table -> char('password',60)->comment('密码');
            $table -> string('mg_role_ids')->comment('角色ids');
            $table -> enum('mg_sex',['男','女'])->default('男')->comment('性别');
            $table -> char('mg_phone',11)->nullable()->comment('手机号码');
            $table -> string('mg_email',64)->nullable()->comment('邮箱');
            $table -> text('mg_remark')->nullable()->comment('备注');
            $table -> timestamps(); //创建时间 修改时间
            $table -> softDeletes(); //删除时间
            $table -> rememberToken(); //记住我标识
            $table -> unique('username');  //给username创建唯一索引
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删除数据表
        Schema::dropIfExists('manager');
    }
}
