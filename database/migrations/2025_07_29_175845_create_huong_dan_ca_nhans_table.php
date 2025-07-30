<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHuongDanCaNhansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tochuc___huong_dan_ca_nhans', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('id_vi_tri');
            $table->text('ten_huong_dan')->default(null);
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
        Schema::dropIfExists('tochuc___huong_dan_ca_nhans');
    }
}
