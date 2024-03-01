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
        Schema::create('tochuc___tieu_chuan', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('id_vi_tri');
            $table->boolean('gioi_tinh')->default(1);
            $table->text('tuoi')->nullable();
            $table->text('hoc_van')->nullable();
            $table->text('chuyen_mon')->nullable();
            $table->text('vi_tinh')->nullable();
            $table->text('anh_ngu')->nullable();
            $table->text('kinh_nghiem')->nullable();
            $table->text('ky_nang')->nullable();
            $table->text('to_chat')->nullable();
            $table->text('ngoai_hinh')->nullable();
            $table->text('suc_khoe')->nullable();
            $table->text('ho_khau')->nullable();
            $table->text('uu_tien')->nullable();
            $table->timestamps();

            $table->foreign('id_vi_tri')
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
        Schema::dropIfExists('tochuc___tieu_chuan');
    }
}
