<?php

namespace App\Traits;

use App\Models\LichSuThayDoi;
// *** QUAN TRỌNG: Đảm bảo bạn đã import model Vị trí ***
use App\Models\User;         // *** THÊM MỚI: Import model User ***
use App\Models\Vitri;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    /**
     * Tự động đăng ký các event listener khi model được khởi tạo.
     */
    protected static function bootLogsActivity()
    {
        static::created(function (Model $model) {
            static::logChange($model, 'created');
        });

        static::updated(function (Model $model) {
            static::logChange($model, 'updated');
        });

        static::deleted(function (Model $model) {
            static::logChange($model, 'deleted');
        });
    }

    /**
     * Ghi log thay đổi vào cơ sở dữ liệu.
     */
    protected static function logChange(Model $model, string $action)
    {
        // Đối với hành động 'update', thoát nếu không có gì thay đổi
        if ($action === 'updated' && !$model->isDirty()) {
            return;
        }

        $beforeData = $action === 'updated' ? $model->getOriginal() : null;
        $afterData = $action !== 'deleted' ? $model->getAttributes() : null;

        // --- Logic tùy chỉnh để lấy tên vị trí quản lý ---
        if (array_key_exists('id_vi_tri_quan_ly', $model->getAttributes())) {
            if ($action === 'updated' && $model->isDirty('id_vi_tri_quan_ly')) {
                $oldManagerId = $model->getOriginal('id_vi_tri_quan_ly');
                if ($oldManagerId) {
                    $beforeData['ten_vi_tri_quan_ly'] = Vitri::find($oldManagerId)->ten_vi_tri ?? 'Không tìm thấy';
                }
            }
            if ($action === 'created' || ($action === 'updated' && $model->isDirty('id_vi_tri_quan_ly'))) {
                $newManagerId = $model->id_vi_tri_quan_ly;
                if ($newManagerId) {
                    $afterData['ten_vi_tri_quan_ly'] = ViTri::find($newManagerId)->ten_vi_tri ?? 'Không tìm thấy';
                }
            }
        }

        // --- [THÊM MỚI] Logic tùy chỉnh để lấy tên nhân sự (user) ---
        if (array_key_exists('id_user', $model->getAttributes())) {
            // Nếu là hành động 'update' VÀ trường 'id_user' có thay đổi
            if ($action === 'updated' && $model->isDirty('id_user')) {
                $oldUserId = $model->getOriginal('id_user');
                if ($oldUserId) {
                    // Bổ sung tên của nhân sự CŨ vào dữ liệu 'before'
                    $beforeData['ten_nhan_su'] = User::find($oldUserId)->name ?? 'Không tìm thấy';
                }
            }
            // Nếu là 'tạo mới' hoặc 'cập nhật' và trường id_user có giá trị
            if ($action === 'created' || ($action === 'updated' && $model->isDirty('id_user'))) {
                $newUserId = $model->id_user;
                if ($newUserId) {
                    // Bổ sung tên của nhân sự MỚI vào dữ liệu 'after'
                    $afterData['ten_nhan_su'] = User::find($newUserId)->name ?? 'Không tìm thấy';
                }
            }
        }
        // --- Kết thúc logic tùy chỉnh ---

        LichSuThayDoi::create([
            'user_id' => Auth::id(),
            'loggable_id' => $model->getKey(),
            'loggable_type' => get_class($model),
            'action' => $action,
            'before' => $beforeData,
            'after' => $afterData,
        ]);
    }
}
