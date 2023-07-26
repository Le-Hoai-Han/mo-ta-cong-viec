<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Thuong\ThuongNhanVien;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThuongNhanVienPolicy
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
     * @param  \App\Models\odel=Thuong\ThuongNhanVien  $thuongNhanVien
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ThuongNhanVien $thuongNhanVien)
    {
        if($user->can('view_thuongnhanvien') || $thuongNhanVien->id_nhan_vien == $user->nhanVien->id) {
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
     * @param  \App\Models\odel=Thuong\ThuongNhanVien  $thuongNhanVien
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
     * @param  \App\Models\odel=Thuong\ThuongNhanVien  $thuongNhanVien
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->can('delete_thuongnhanvien');
    }

}
