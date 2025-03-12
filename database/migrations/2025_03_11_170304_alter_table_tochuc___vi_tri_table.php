<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableTochucViTriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tochuc___vi_tri',function(Blueprint $table){
            $table->unsignedInteger('id_phong_ban')->nullable()->after('phong_ban');

            $table->foreign('id_phong_ban')
            ->references('id')
            ->on('tochuc___phong_ban')
            ->onUpdate('cascade')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tochuc___vi_tri',function(Blueprint $table){
            $table->dropColumn('id_phong_ban');
        });
    }
}
