<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnForManager extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manager',function(Blueprint $table){
            //$table -> tinyinteger('is_ok')->comment('是否启用')->after('mg_email');
            $table -> enum('is_ok',['是','否'])->comment('是否启用')->after('mg_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manager',function(Blueprint $table){
            $table -> dropColumn('is_ok');
        });
    }
}

