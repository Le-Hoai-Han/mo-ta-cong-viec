<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThamQuyenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tham_quyen', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->text('noi_dung')->default(null);
            $table->unsignedInteger('id_vi_tri');
            $table->boolean('loai')->default(1);
            $table->timestamps();

            $table->foreign('id_vi_tri')
            ->on('vi_tri')
            ->references('id')
            ->onDeleteCascade();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tham_quyen');
    }
}
