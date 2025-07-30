<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLichSuThayDoiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tochuc___lich_su_thay_doi', function (Blueprint $table) {
            // Khóa chính của bảng lịch sử
            $table->id();

            // Lưu ID của người dùng thực hiện hành động
            // nullable trong trường hợp hành động được thực hiện bởi hệ thống (vd: seeder, command)
            $table->unsignedBigInteger('user_id')->nullable();

            // Sử dụng quan hệ đa hình để liên kết với bất kỳ model nào
            // loggable_id: ID của bản ghi được thay đổi (vd: id của một vi_tri)
            // loggable_type: Tên class của Model được thay đổi (vd: App\Models\TochucViTri)
            $table->morphs('loggable');

            // Hành động đã thực hiện: 'created', 'updated', 'deleted'
            $table->string('action');

            // Lưu trạng thái của dữ liệu TRƯỚC và SAU khi thay đổi
            // Dùng kiểu JSON để dễ dàng truy vấn và xử lý
            $table->json('before')->nullable();
            $table->json('after')->nullable();

            // Thời gian thực hiện
            $table->timestamps();

            // Tạo index để tăng tốc độ truy vấn
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tochuc___lich_su_thay_doi');
    }
}
