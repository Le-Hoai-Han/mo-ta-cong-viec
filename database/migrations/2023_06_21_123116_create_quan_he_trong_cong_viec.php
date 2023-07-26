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
        Schema::create('quan_he_trong_cong_viec', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->text('noi_dung')->default(null);
            $table->unsignedInteger('id_vi_tri');
            $table->boolean('loai')->default(1);
            $table->timestamps();

            $table->foreign('id_vi_tri')
            ->on('vi_tri')
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
        Schema::dropIfExists('quan_he_trong_cong_viec');
    }
}
