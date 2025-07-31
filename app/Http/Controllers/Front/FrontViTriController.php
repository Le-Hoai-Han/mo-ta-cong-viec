<?php

namespace App\Http\Controllers\Front;

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->__validate($request->all());
        Vitri::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Thêm thành công',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Vitri $viTri)
    {
        $listViTri = Vitri::select(['id', 'ten_vi_tri', 'id_user'])->get();
        $listUser = User::ActiveEmployees()->select(['id', 'name'])->get();
        $listNhiemVu = NhiemVu::select(['id', 'ten_nhiem_vu'])->get();
        $roles = Role::pluck('name', 'id');
        $listPhongBan = PhongBan::select(['id', 'name'])->get();
        $action = 'show-mo-ta';

        return view('front.vitri.show', [
            'viTri' => $viTri,
            'listViTri' => $listViTri,
            'listUser' => $listUser,
            'listNhiemVu' => $listNhiemVu,
            'roles' => $roles,
            'listPhongBan' => $listPhongBan,
            'action' => $action,
        ]);
    }

    public function showHuongDan($id)
    {
        $viTri = Vitri::find($id);
        $kiemTraCaNhan = auth()->user()->hasRole('Admin') ||
            (auth()->user()->hasRole('mo_ta_cong_viec') ||
                auth()->user()->isCapTren($viTri)) || auth()->user()->hasPermissionTo('edit_mtcv') || auth()->user()->id === $viTri->id_user;
       
        if(!$kiemTraCaNhan) {
            return redirect()->back()->with('error', 'Bạn không có quyền truy cập vào chức năng này');
        }
        $action = 'show-huong-dan';
        $roles = Role::pluck('name', 'id');

        return view('front.vitri.show-huong-dan', [
            'viTri' => $viTri,
            'action' => $action,
             'roles' => $roles,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $viTri = Vitri::find($id);

        if ($viTri->trang_thai == Vitri::TT_KHOA) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vị trí đang bị khóa thông tin',
            ]);
        }

        if ($request->fillable == 'id_vi_tri_quan_ly') {
            $viTri->update(
                ['id_vi_tri_quan_ly' => $request->value]
            );
        }

        if ($request->fillable == 'ten_vi_tri') {
            $viTri->update(
                ['ten_vi_tri' => $request->value]
            );
        }

        if ($request->fillable == 'phong_ban') {
            $viTri->update(
                ['id_phong_ban' => $request->value]
            );
        }

        if ($request->fillable == 'noi_lam_viec') {
            $viTri->update(
                ['noi_lam_viec' => $request->value]
            );
        }

        if ($request->fillable == 'muc_dich') {
            $viTri->update(
                ['muc_dich' => $request->value]
            );
        }

        if (isset($request->_token)) {
            $viTri->update([
                'ten_vi_tri' => $request->ten_vi_tri,
                'id_phong_ban' => $request->id_phong_ban,
                'id_vi_tri_quan_ly' => $request->id_vi_tri_quan_ly,
                'id_user' => $request->id_user,
                'noi_lam_viec' => $request->noi_lam_viec,
                'muc_dich' => $request->muc_dich,
                'stroke' => $request->stroke,
            ]);

            return redirect()->route('front-vi-tri.show', $viTri)->with('success', 'Cập nhật thành công');
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
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vitri $viTri)
    {
        if ($viTri->nhiemVu->isNotEmpty()) {
            foreach ($viTri->nhiemVu as $nhiemVu) {
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
        if ($viTri->capDuoi->isNotEmpty() && $viTri->capQuanLy != null) {
            foreach ($viTri->capDuoi as $viTriCapDuoi) {
                $viTriCapDuoi->update(
                    ['id_vi_tri_quan_ly' => $viTri->capQuanLy->id]
                );
            }
        }

        $viTri->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Xóa thành công',
        ]);
    }

    public function __getViTri(Request $request)
    {
        $viTri = Vitri::find($request->idViTri);

        return $viTri;
    }

    public function __validate($data)
    {
        $validate = Validator::make($data, [
            'ten_vi_tri' => 'required',
            'id_phong_ban' => 'required',
            'noi_lam_viec' => 'required',
            'muc_dich' => 'required',
            'id_vi_tri_quan_ly' => 'required',
            'id_user' => 'required',
            'stroke' => 'required',
        ], [
            'ten_vi_tri.required' => 'Tên vị trí không được bỏ trống',
            'id_phong_ban.required' => 'Tên phòng ban không được bỏ trống',
            'noi_lam_viec.required' => 'Nơi làm việc không được bỏ trống',
            'muc_dich.required' => 'Mục đích không được bỏ trống',
        ]);

        return $validate->validate();
    }

    public function lockViTri($id)
    {
        $viTri = Vitri::find($id);
        $viTri->trang_thai = Vitri::TT_KHOA;
        $viTri->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Khóa thành công',
        ]);
    }

    public function unlockViTri($id)
    {
        $viTri = Vitri::find($id);
        $viTri->trang_thai = Vitri::TT_MO_KHOA;
        $viTri->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Mở khóa thành công',
        ]);
    }

    public function getHistoryApi($id)
    {
        // Tải trước các quan hệ lồng nhau để tối ưu hóa truy vấn
        $viTri = Vitri::with(['nhiemVu.moTaNhiemVu'])->find($id);

        if (!$viTri) {
            return response()->json(['message' => 'Không tìm thấy đối tượng!'], 404);
        }

        // 1. Lấy lịch sử của chính đối tượng Vị trí
        $activities = $viTri->history;

        // 2. Lấy lịch sử của tất cả các Nhiệm vụ và Mô tả nhiệm vụ liên quan
        foreach ($viTri->nhiemVu as $nhiemVu) {
            // Trộn lịch sử của Nhiệm vụ
            $activities = $activities->merge($nhiemVu->history);

            // Trộn lịch sử của từng Mô tả nhiệm vụ bên trong
            foreach ($nhiemVu->moTaNhiemVu as $moTa) {
                $activities = $activities->merge($moTa->history);
            }
        }

        foreach ($viTri->thamQuyen as $thamQuyen) {
            // Trộn lịch sử của Nhiệm vụ
            $activities = $activities->merge($thamQuyen->history);

        }

        // 3. Sắp xếp toàn bộ lịch sử theo ngày tạo mới nhất lên đầu
        $sortedActivities = $activities->sortByDesc('created_at');

        // 4. Tải thông tin người dùng cho tất cả các hoạt động đã được sắp xếp
        $sortedActivities->load('user:id,name');

        // Chuẩn bị dữ liệu để trả về
        $data = [
            'subject' => [
                'id' => $viTri->id,
                'class_name' => get_class($viTri),
            ],
            // Chuyển collection về mảng và reset key để JSON trả ra là một mảng
            'activities' => $sortedActivities->values()->all(),
        ];

        return response()->json($data);
    }

    public function history($id)
    {
        $viTri = Vitri::find($id);
        if (!$viTri) {
            return redirect()->back()->with('error', 'Không tìm thấy vị trí!');
        }

        $history = $viTri->history()->get();

        return view('front.vitri.history', [
            'viTri' => $viTri,
            'history' => $history,
        ]);
    }

    public function updateHuongDan(Request $request, ViTri $vi_tri)
    {
        $validated = $request->validate([
            'huong_dan_cong_viec' => 'nullable|string',
        ]);

        // 3. Cập nhật dữ liệu
        $vi_tri->update([
            'huong_dan_cong_viec' => $validated['huong_dan_cong_viec'],
        ]);

        // 4. Quay về trang trước với thông báo thành công
        return back()->with('success', 'Đã cập nhật hướng dẫn công việc thành công!');
    }
}
