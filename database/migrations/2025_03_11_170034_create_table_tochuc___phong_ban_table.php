<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTochucPhongBanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tochuc___phong_ban', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('stt')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on('tochuc___phong_ban')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tochuc___phong_ban');
    }
}
