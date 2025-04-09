<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\NhiemVu;
use App\Models\PhongBan;
use App\Models\Role;
use App\Models\User;
use App\Models\Vitri;
use App\Traits\PhongBanTraits;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Validator;

class FrontViTriController extends RoutingController
{
    use PhongBanTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->__validate($request->all());
        Vitri::create($data);
        return response()->json([
            'status'=>'success',
            'message' => 'Thêm thành công'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vitri $viTri)
    {
        $listViTri = Vitri::select(['id','ten_vi_tri','id_user'])->get();
        $listUser = User::ActiveEmployees()->select(['id','name'])->get();
        $listNhiemVu = NhiemVu::select(['id','ten_nhiem_vu'])->get();
        $roles = Role::pluck('name', 'id');
        $listPhongBan = PhongBan::select(['id','name'])->get();
        return view('front.vitri.show',[
            'viTri' => $viTri,
            'listViTri' => $listViTri,
            'listUser' => $listUser,
            'listNhiemVu' => $listNhiemVu,
            'roles' => $roles,
            'listPhongBan' => $listPhongBan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $viTri = Vitri::find($id);

        if($viTri->trang_thai == Vitri::TT_KHOA){
            return response()->json([
                'status'=>'error',
                'message' => 'Vị trí đang bị khóa thông tin'
            ]);
        }

        if($request->fillable == 'id_vi_tri_quan_ly'){
            $viTri->update(
                ['id_vi_tri_quan_ly' => $request->value]
            );
        }

        if($request->fillable == 'ten_vi_tri'){
            $viTri->update(
                ['ten_vi_tri' => $request->value]
            );
        }

        if($request->fillable == 'phong_ban'){
            $viTri->update(
                ['id_phong_ban' => $request->value]
            );
        }

        if($request->fillable == 'noi_lam_viec'){
            $viTri->update(
                ['noi_lam_viec' => $request->value]
            );
        }

        if($request->fillable == 'muc_dich'){
            $viTri->update(
                ['muc_dich' => $request->value]
            );
        }

        // Xử lý add vào phòng ban
        // if(isset($data['id_phong_ban']) && $viTri->user){
        //     $viTri->id_phong_ban = $data['id_phong_ban'];
        //     $viTri->save();

        //     // Xử lý add vào phòng ban
        //     $this->xuLyAddPhongBan($viTri);
        // }

        return response()->json(['success' => true, 'message' => 'Cập nhật thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vitri $viTri)
    {
        if($viTri->nhiemVu->isNotEmpty()){
            foreach($viTri->nhiemVu as $nhiemVu){
                $nhiemVu->moTaNhiemVu()->delete();
            }
            $viTri->nhiemVu()->delete();
        }

        // xóa thẩm quyền thuộc vị trí
        $viTri->thamQuyen()->delete();

         // xóa quanHe thuộc vị trí
         $viTri->quanHe()->delete();

          // xóa tiêu chuẩn thuộc vị trí
        $viTri->tieuChuan()->delete();

        // Chuyển vị trí cấp dưới
        if($viTri->capDuoi->isNotEmpty() && $viTri->capQuanLy != null){
            foreach($viTri->capDuoi as $viTriCapDuoi){
                $viTriCapDuoi->update(
                    ['id_vi_tri_quan_ly' => $viTri->capQuanLy->id]
                );
            }
        }

        $viTri->delete();


        return response()->json([
            'status'=>'success',
            'message' => 'Xóa thành công'
        ]);
    }

    public function __getViTri(Request $request){
        $viTri = Vitri::find($request->idViTri);
        return $viTri;
    }

    public function __validate($data){
        $validate = Validator::make($data,[
            'ten_vi_tri' => 'required',
            'id_phong_ban' => 'required',
            'noi_lam_viec' => 'required',
            'muc_dich' => 'required',
            'id_vi_tri_quan_ly' => 'required',
            'id_user' =>'required',
            'stroke' =>'required'
        ],[
            'ten_vi_tri.required' => 'Tên vị trí không được bỏ trống',
            'id_phong_ban.required' => 'Tên phòng ban không được bỏ trống',
            'noi_lam_viec.required' => 'Nơi làm việc không được bỏ trống',
            'muc_dich.required' => 'Mục đích không được bỏ trống',
        ]);

        return $validate->validate();
    }

    public function lockViTri($id){
        $viTri = Vitri::find($id);
        $viTri->trang_thai = Vitri::TT_KHOA;
        $viTri->save();
        return response()->json([
            'status' =>'success',
            'message' =>'Khóa thành công',
        ]);
    }

    public function unlockViTri($id){
        $viTri = Vitri::find($id);
        $viTri->trang_thai = Vitri::TT_MO_KHOA;
        $viTri->save();
        return response()->json([
            'status' =>'success',
            'message' =>'Mở khóa thành công',
        ]);
    }
}
