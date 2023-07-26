<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTieuChuanTuyenChonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tieu_chuan_tuyen_chon', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('id_vi_tri');
            $table->boolean('gioi_tinh')->default(1);
            $table->text('tuoi');
            $table->text('hoc_van');
            $table->text('chuyen_mon');
            $table->text('vi_tinh');
            $table->text('anh_ngu');
            $table->text('kinh_nghiem');
            $table->text('ky_nang');
            $table->text('to_chat');
            $table->text('ngoai_hinh');
            $table->text('suc_khoe');
            $table->text('ho_khau');
            $table->text('uu_tien');
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
        Schema::dropIfExists('tieu_chuan_tuyen_chon');
    }
}
