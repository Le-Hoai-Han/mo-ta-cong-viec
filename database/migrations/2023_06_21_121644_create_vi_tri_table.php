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
        Schema::create('vi_tri', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->text('ten_vi_tri')->default(null);
            $table->unsignedInteger('id_vi_tri_quan_ly');
            $table->text('phong_ban')->default(null);;
            $table->text('noi_lam_viec')->default(null);;
            $table->text('muc_dich')->default(null);;
            $table->timestamps();

            $table->foreign('id_vi_tri_quan_ly')
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
        Schema::dropIfExists('vi_tri');
    }
}
