<?php

namespace App\Policies\Thuong;

use App\Models\Thuong\ThuongKhoangThoiGian;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThuongThoiGianPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if($user->can('view_thuongnhanvien') || $user->nhanVien->id_nhom_nhan_vien != "") {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Thuong\ThuongKhoangThoiGian  $thuongKhoangThoiGian
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ThuongKhoangThoiGian $thuongKhoangThoiGian)
    {

        if($user->can('view_thuongnhanvien') || $thuongKhoangThoiGian->id_nhan_vien == $user->nhanVien->id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('add_thuongnhanvien');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Thuong\ThuongKhoangThoiGian  $thuongKhoangThoiGian
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->can('edit_thuongnhanvien');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Thuong\ThuongKhoangThoiGian  $thuongKhoangThoiGian
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->can('delete_thuongnhanvien');
    }

    
}
