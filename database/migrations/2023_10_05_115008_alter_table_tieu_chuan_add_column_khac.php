<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableTieuChuanAddColumnKhac extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tieu_chuan_tuyen_chon',function(Blueprint $table){
            $table->text('khac')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tieu_chuan_tuyen_chon',function(Blueprint $table){
            $table->dropColumn('khac');
        });
    }
}
