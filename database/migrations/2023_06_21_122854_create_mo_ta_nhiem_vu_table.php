<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoTaNhiemVuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tochuc___mo_ta_nhiem_vu', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('id_nhiem_vu');
            $table->text('chi_tiet')->nullable();
            $table->text('ket_qua')->nullable();
            $table->text('mo_ta')->nullable();
            $table->timestamps();

            $table->foreign('id_nhiem_vu')
            ->on('tochuc___nhiem_vu')
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
        Schema::dropIfExists('tochuc___mo_ta_nhiem_vu');
    }
}
