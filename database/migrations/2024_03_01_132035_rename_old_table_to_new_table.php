<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameOldTableToNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('vi_tri', 'tochuc___vi_tri');
        Schema::rename('nhiem_vu', 'tochuc___nhiem_vu');
        Schema::rename('mo_ta_nhiem_vu', 'tochuc___mo_ta_nhiem_vu');
        Schema::rename('tham_quyen', 'tochuc___tham_quyen');
        Schema::rename('quan_he', 'tochuc___quan_he');
        Schema::rename('tieu_chuan', 'tochuc___tieu_chuan');
        Schema::rename('ask', 'tochuc___ask');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('tochuc___vi_tri', 'vi_tri');
        Schema::rename('tochuc___nhiem_vu', 'nhiem_vu');
        Schema::rename('tochuc___mo_ta_nhiem_vu', 'mo_ta_nhiem_vu');
        Schema::rename('tochuc___tham_quyen', 'tham_quyen');
        Schema::rename('tochuc___quan_he', 'quan_he');
        Schema::rename('tochuc___tieu_chuan', 'tieu_chuan');
        Schema::rename('tochuc___ask', 'ask');
    }
}
