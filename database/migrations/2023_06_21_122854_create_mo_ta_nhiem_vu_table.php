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
        Schema::create('mo_ta_nhiem_vu', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('id_nhiem_vu');
            $table->text('chi_tiet')->default(null);
            $table->text('ket_qua')->default(null);
            $table->text('mo_ta')->default(null);
            $table->timestamps();

            $table->foreign('id_nhiem_vu')
            ->on('nhiem_vu')
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
        Schema::dropIfExists('mo_ta_nhiem_vu');
    }
}
