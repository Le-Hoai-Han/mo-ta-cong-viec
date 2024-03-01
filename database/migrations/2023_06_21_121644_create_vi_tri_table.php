<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViTriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tochuc___vi_tri', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->text('ten_vi_tri')->nullable();
            $table->unsignedInteger('id_vi_tri_quan_ly');
            $table->text('phong_ban')->nullable();
            $table->text('noi_lam_viec')->nullable();
            $table->text('muc_dich')->nullable();
            $table->timestamps();

            $table->foreign('id_vi_tri_quan_ly')
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
        Schema::dropIfExists('tochuc___vi_tri');
    }
}
