<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKechengTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //创建专业表
        Schema::create('profession',function(Blueprint $table){
            $table -> increments('pro_id')->comment('主键');
            $table -> string('pro_name',64)->unique()->comment('专业名称');
            $table -> string('teacher_ids',60)->nullable()->comment('任课老师的ids串，如 10,13,21');
            $table -> text('pro_desc')->nullable()->comment('简介');
            $table -> char('cover_img',100)->nullable()->comment('封面图');
            $table -> text('carousel_imgs')->nullable()->comment('轮播图片');
            $table -> timestamps();
            $table -> softDeletes();
        });
        //创建课程表
        Schema::create('course',function(Blueprint $table){
            $table -> increments('course_id')->unique()->comment('主键');
            $table -> integer('pro_id')->comment('(归属)专业id');
            $table -> string('course_name',64)->unique()->comment('课程名称');
            $table -> decimal('course_price',7,2)->default('0.00')->comment('售价');
            $table -> text('course_desc')->nullable()->comment('课程描述');
            $table -> string('cover_img',128)->nullable()->comment('封面图');
            $table -> timestamps();
            $table -> softDeletes();
        });
        //创建课时表
        Schema::create('lesson',function(Blueprint $table){
            $table -> increments('lesson_id')->unique()->comment('主键');
            $table -> integer('course_id')->comment('(归属)课程id');
            $table -> string('lesson_name',64)->unique()->comment('课程名称');
            $table -> string('cover_img')->comment('封面图');
            $table -> string('video_address',128)->nullable()->comment('播放视频地址');
            $table -> text('lesson_desc')->nullable()->comment('视频描述');
            $table -> integer('lesson_duration')->default(0)->comment('视频分钟数');
            $table -> string('teacher_ids',128)->nullable()->comment('视频讲解老师');
            $table -> timestamps();
            $table -> softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profession');
        Schema::dropIfExists('course');
        Schema::dropIfExists('lesson');
    }
}
