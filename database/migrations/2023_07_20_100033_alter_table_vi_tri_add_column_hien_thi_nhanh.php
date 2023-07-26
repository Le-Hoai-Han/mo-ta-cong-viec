<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableViTriAddColumnHienThiNhanh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vi_tri',function(Blueprint $table){
            $table->boolean('hien_thi_nhanh')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vi_tri',function(Blueprint $table){
            $table->dropColumn('hien_thi_nhanh');
        });
    }
}
