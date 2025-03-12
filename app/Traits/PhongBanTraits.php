<?php
namespace App\Traits;
trait PhongBanTraits
{
    public function xuLyAddPhongBan($viTri)
    {
        // Kiểm tra $user
        $user = $viTri->user;
        // Lấy danh sách phòng ban của user
        $phongBanThuocUser = $user->userThuocPhongBan()->first();

        // Phòng ban thuộc vị trí
        $phongBanThuocViTri = $viTri->phongBan;
        if($phongBanThuocUser && $phongBanThuocUser->id != $phongBanThuocViTri->id){
            // xóa user khỏi phòng ban
            $phongBanThuocUser->userThuocPhongBan()->detach($user->id);

            // THêm user vòa phòng ban thuộc vị trí
            $phongBanThuocViTri->userThuocPhongBan()->attach($user->id);
        }else{
            // Thêm user vào phòng ban thuộc user
            $user->userThuocPhongBan()->attach($phongBanThuocViTri->id);
        }
    }
}
