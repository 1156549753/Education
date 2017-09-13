<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher', function (Blueprint $table) {
            $table -> increments('teacher_id')->comment('主键id');
            $table -> string('teacher_name',64)->comment('老师名称');
            $table -> char('teacher_phone',11)->comment('手机号码');
            $table -> string('teacher_city')->comment('城市');
            $table -> string('teacher_address')->comment('地址');
            $table -> string('teacher_company')->comment('公司');
            $table -> string('teacher_email',128)->nullable()->comment('老师邮箱');
            $table -> string('teacher_pic',64)->nullable()->comment('老师头像');
            $table -> text('teacher_desc')->comment('老师说明');
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
        Schema::dropIfExists('teacher');
    }
}
