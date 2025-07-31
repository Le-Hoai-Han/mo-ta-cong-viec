<?php

namespace App\Traits;

use App\Models\LichSuThayDoi;
use App\Models\NhiemVu;
use App\Models\PhongBan;
use App\Models\User;
use App\Models\Vitri;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

trait LogsActivity
{
    // ... hàm bootLogsActivity giữ nguyên ...
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
     * Phiên bản gỡ lỗi chi tiết.
     */
    protected static function logChange(Model $model, string $action)
    {
        // Log khi bắt đầu vào hàm
        Log::info('[LogsActivity] Bắt đầu logChange cho model: '.get_class($model));

        // Kiểm tra isDirty()
        if ($action === 'updated') {
            if (!$model->isDirty()) {
                Log::warning('[LogsActivity] Bỏ qua vì isDirty() là FALSE cho model: '.get_class($model));

                return;
            } else {
                // Nếu isDirty() là TRUE, ghi lại những trường đã thay đổi
                Log::info('[LogsActivity] isDirty() là TRUE. Các trường thay đổi: ', $model->getChanges());
            }
        }

        // ... (phần logic lấy tên vị trí, user giữ nguyên) ...
        $beforeData = $action === 'updated' ? $model->getOriginal() : null;
        $afterData = $action !== 'deleted' ? $model->getAttributes() : null;

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

        if (array_key_exists('id_user', $model->getAttributes())) {
            if ($action === 'updated' && $model->isDirty('id_user')) {
                $oldUserId = $model->getOriginal('id_user');
                if ($oldUserId) {
                    $beforeData['ten_nhan_su'] = User::find($oldUserId)->name ?? 'Không tìm thấy';
                }
            }
            if ($action === 'created' || ($action === 'updated' && $model->isDirty('id_user'))) {
                $newUserId = $model->id_user;
                if ($newUserId) {
                    $afterData['ten_nhan_su'] = User::find($newUserId)->name ?? 'Không tìm thấy';
                }
            }
        }

        if (array_key_exists('id_phong_ban', $model->getAttributes())) {
            if ($action === 'updated' && $model->isDirty('id_phong_ban')) {
                $oldManagerId = $model->getOriginal('id_phong_ban');
                if ($oldManagerId) {
                    $beforeData['ten_phong_ban'] = PhongBan::find($oldManagerId)->name ?? 'Không tìm thấy';
                }
            }
            if ($action === 'created' || ($action === 'updated' && $model->isDirty('id_phong_ban'))) {
                $newManagerId = $model->id_phong_ban;
                if ($newManagerId) {
                    $afterData['ten_phong_ban'] = PhongBan::find($newManagerId)->name ?? 'Không tìm thấy';
                }
            }
        }

        if (array_key_exists('id_nhiem_vu', $model->getAttributes())) {
            if ($action === 'updated' && $model->isDirty('id_nhiem_vu')) {
                $oldManagerId = $model->getOriginal('id_nhiem_vu');
                if ($oldManagerId) {
                    $beforeData['ten_nhiem_vu'] = NhiemVu::find($oldManagerId)->ten_nhiem_vu ?? 'Không tìm thấy';
                }
            }
            if ($action === 'created' || ($action === 'updated' && $model->isDirty('id_nhiem_vu'))) {
                $newManagerId = $model->id_nhiem_vu;
                if ($newManagerId) {
                    $afterData['ten_nhiem_vu'] = NhiemVu::find($newManagerId)->ten_nhiem_vu ?? 'Không tìm thấy';
                }
            }
        }

        if (array_key_exists('ket_qua', $model->getAttributes())) {
            if ($action === 'updated' && $model->isDirty('ket_qua')) {
                $oldManagerId = $model->getOriginal('ket_qua');
                if ($oldManagerId) {
                    $beforeData['ten_nhiem_vu'] = NhiemVu::find($oldManagerId)->ten_nhiem_vu ?? 'Không tìm thấy';
                }
            }
            if ($action === 'created' || ($action === 'updated' && $model->isDirty('ket_qua'))) {
                $newManagerId = $model->id_nhiem_vu;
                if ($newManagerId) {
                    $afterData['ten_nhiem_vu'] = NhiemVu::find($newManagerId)->ten_nhiem_vu ?? 'Không tìm thấy';
                }
            }
        }

        try {
            Log::info('[LogsActivity] Chuẩn bị tạo bản ghi lịch sử...');
            LichSuThayDoi::create([
                'user_id' => Auth::id(),
                'loggable_id' => $model->getKey(),
                'loggable_type' => get_class($model),
                'action' => $action,
                'before' => $beforeData,
                'after' => $afterData,
            ]);
            // Log khi tạo thành công
            Log::info('[LogsActivity] ĐÃ TẠO THÀNH CÔNG bản ghi lịch sử cho model: '.get_class($model));
        } catch (\Exception $e) {
            Log::error('[LogsActivity] Lỗi khi tạo bản ghi lịch sử: '.$e->getMessage());
        }
    }
}
