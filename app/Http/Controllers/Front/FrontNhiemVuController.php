<?php

namespace App\Http\Controllers\Front;

use App\Models\NhiemVu;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Validator;

class FrontNhiemVuController extends RoutingController
{
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
        $validate = $this->__validate($request->all());
        NhiemVu::create($validate);

        return response()->json(['success' => true, 'message' => 'Thêm thành công']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $nhiemVu = NhiemVu::find($id);

        if (!$nhiemVu) {
            return response()->json([
            'status' => 'error',
            'message' => 'Không tìm thấy nhiệm vụ!',
        ], 404);
        }

        // Gán giá trị mới vào model
        $nhiemVu->ten_nhiem_vu = $request->value;

        // *** BƯỚC GỠ LỖI QUAN TRỌNG ***
        // Kiểm tra xem model có thực sự thay đổi không
        if (!$nhiemVu->isDirty()) {
            // Nếu không có gì thay đổi, trả về thông báo này và không làm gì cả
            return response()->json([
            'success' => true,
            'message' => 'Không có gì thay đổi để cập nhật.',
        ]);
        }

        try {
            // Nếu có thay đổi, bây giờ mới thực hiện lưu
            $nhiemVu->save();

            return response()->json(['success' => true, 'message' => 'Cập nhật thành công']);
        } catch (\Exception $e) {
            // Ghi lại lỗi chi tiết để dễ dàng kiểm tra trong file laravel.log
            \Illuminate\Support\Facades\Log::error('Lỗi khi cập nhật NhiemVu: '.$e->getMessage());

            return response()->json([
            'status' => 'error',
            'message' => 'Có lỗi xảy ra, vui lòng thử lại!',
        ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trachNhiem = NhiemVu::find($id);
        $trachNhiem->moTaNhiemVu()->delete();
        $trachNhiem->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Xóa thành công',
        ]);
    }

    public function __validate($data)
    {
        $validate = Validator::make($data, [
            'ten_nhiem_vu' => 'required',
            'id_vi_tri' => 'required',
        ], [
            'ten_nhiem_vu.required' => 'Tên nhiệm vụ không được bỏ trống',
            'ten_nhiem_vu.unique' => 'Nhiệm vụ bị trùng',
            'id_vi_tri.required' => 'Vị trí không được bỏ trống',
        ])->validate();

        return $validate;
    }

    public function __getTrachNhiem(Request $request)
    {
        $nhiemVu = NhiemVu::find($request->idTrachNhiem);

        return $nhiemVu;
    }
}
