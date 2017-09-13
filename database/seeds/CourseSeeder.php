<?php

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('course')->insert([
            ['pro_id'=>100,'course_name'=>'jQuery','course_desc'=>'js封装的功能包'],
            ['pro_id'=>101,'course_name'=>'Linux','course_desc'=>'服务器端操作系统'],
            ['pro_id'=>101,'course_name'=>'面向对象','course_desc'=>'代码的高级封装'],
        ]);
    }
}
