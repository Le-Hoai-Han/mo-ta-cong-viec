<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoTaHuongDanCaNhansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tochuc___mo_ta_huong_dan_ca_nhans', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('id_huong_dan');
            $table->text('chi_tiet')->nullable();
            $table->text('ket_qua')->nullable();
            $table->text('mo_ta')->nullable();
            $table->timestamps();

            $table->foreign('id_huong_dan')
            ->on('tochuc___huong_dan_ca_nhans')
            ->references('id')
            ->onDeleteCascade()
            ->onUpdateCascade();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tochuc___mo_ta_huong_dan_ca_nhans');
    }
}
