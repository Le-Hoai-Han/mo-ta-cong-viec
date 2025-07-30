<?php

namespace App\Http\Controllers\Front;

use App\Models\HuongDanCaNhan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Validator;

class FrontHuongDanCaNhanController extends RoutingController
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
        HuongDanCaNhan::create($validate);

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
        $huongDan = HuongDanCaNhan::find($id);

        if (!$huongDan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy hướng dẫn!',
            ], 404);
        }

        // Validate dữ liệu đầu vào

        try {
            $huongDan->update([
                'ten_huong_dan' => $request->value,
            ]);

            return response()->json(['success' => true, 'message' => 'Cập nhật thành công']);
        } catch (\Exception $e) {
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
        $huongDan = HuongDanCaNhan::find($id);
        $huongDan->moTaHuongDan()->delete();
        $huongDan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Xóa thành công',
        ]);
    }

    public function __validate($data)
    {
        $validate = Validator::make($data, [
            'ten_huong_dan' => 'required',
            'id_vi_tri' => 'required',
        ], [
            'ten_huong_dan.required' => 'Tên nhiệm vụ không được bỏ trống',
            'ten_huong_dan.unique' => 'Nhiệm vụ bị trùng',
            'id_vi_tri.required' => 'Vị trí không được bỏ trống',
        ])->validate();

        return $validate;
    }

    public function __getHuongDanCaNhan(Request $request)
    {
        $nhiemVu = HuongDanCaNhan::find($request->idHuongDan);

        return $nhiemVu;
    }
}
