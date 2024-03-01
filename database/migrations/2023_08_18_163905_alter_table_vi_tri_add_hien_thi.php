<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableViTriAddHienThi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tochuc___vi_tri',function(Blueprint $table){
            $table->string('stroke')->default('#000');
            $table->string('arrow_start')->nullable();
            $table->string('arrow_end')->nullable();
            $table->string('stroke_dasharray')->nullable();
            $table->string('type')->default('step');
            $table->string('stackIndent')->default(30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tochuc___vi_tri',function(Blueprint $table){
            $table->dropColumn('stroke');
            $table->dropColumn('arrow_start');
            $table->dropColumn('arrow_end');
            $table->dropColumn('stroke_dasharray');
            $table->dropColumn('type');
            $table->dropColumn('stackIndent');
        });
    }
}
