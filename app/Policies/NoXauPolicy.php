<?php

namespace App\Policies;

use App\Models\Thuong\NoXauThuocNhanVien;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NoXauPolicy
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
        return $user->can('view_noxaus');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\NoXauThuocNhanVien  $noXauThuocNhanVien
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, NoXauThuocNhanVien $noXauThuocNhanVien)
    {
        if($user->can('view_noxaus') || $noXauThuocNhanVien->id_nhan_vien == $user->nhanVien->id) {
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
        return $user->can('add_noxaus');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\NoXauThuocNhanVien  $noXauThuocNhanVien
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, NoXauThuocNhanVien $noXauThuocNhanVien)
    {
        return $user->can('edit_noxaus');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\NoXauThuocNhanVien  $noXauThuocNhanVien
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->can('delete_noxaus');
    }

}
