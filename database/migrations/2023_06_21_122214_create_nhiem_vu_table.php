<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNhiemVuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tochuc___nhiem_vu', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('id_vi_tri');
            $table->text('ten_nhiem_vu')->default(null);
            $table->timestamps();

            $table->foreign('id_vi_tri')
            ->on('tochuc___vi_tri')
            ->references('id')
            ->onDeleteCascase()
            ->onUpdateCascase();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tochuc___nhiem_vu');
    }
}
