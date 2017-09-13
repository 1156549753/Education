<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_course', function (Blueprint $table) {
            $table -> increments('id')->comment('主键id');
            $table -> string('name',64)->unique()->comment('直播课程名称');
            $table -> integer('stream_id')->comment('归属直播流');
            $table -> char('cover_img',100)->nullable()->comment('封面图');
            $table -> integer('start_at')->comment('直播开始时间');
            $table -> integer('end_at')->comment('直播结束时间');
            $table -> text('desc')->nullable()->comment('描述');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('live_course');
    }
}
