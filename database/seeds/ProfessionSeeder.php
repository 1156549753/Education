<?php

use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('profession')->insert([
            ['pro_name'=>'全栈'],
            ['pro_name'=>'PHP'],
            ['pro_name'=>'前端'],
        ]);
    }
}

