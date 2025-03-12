<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserThuocPhongBansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tochuc___user_thuoc_phong_bans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedInteger('id_phong_ban');

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_phong_ban')->references('id')->on('tochuc___phong_ban');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tochuc___user_thuoc_phong_bans');
    }
}
