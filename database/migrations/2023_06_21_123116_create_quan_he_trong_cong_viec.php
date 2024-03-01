<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuanHeTrongCongViec extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tochuc___quan_he', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->text('noi_dung')->nullable();
            $table->unsignedInteger('id_vi_tri');
            $table->boolean('loai')->default(1);
            $table->timestamps();

            $table->foreign('id_vi_tri')
            ->on('tochuc___vi_tri')
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
        Schema::dropIfExists('tochuc___quan_he');
    }
}
