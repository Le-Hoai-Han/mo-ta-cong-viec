<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHuongDanCongViecToTochucViTriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tochuc___vi_tri', function (Blueprint $table) {
            Schema::table('tochuc___vi_tri', function (Blueprint $table) {
                $table->text('huong_dan_cong_viec')->nullable()->after('muc_dich');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tochuc___vi_tri', function (Blueprint $table) {
            $table->dropColumn('huong_dan_cong_viec');
        });
    }
}
