<?php

namespace App\Http\Controllers\Front;

use App\Models\HuongDanCaNhan;
use App\Models\MoTaHuongDanCaNhan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;

class FrontMoTaHuongDanCaNhanController extends RoutingController
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
        MoTaHuongDanCaNhan::create([
            'id_huong_dan' => $request->id_huong_dan,
            'chi_tiet' => $request->chi_tiet,
            'ket_qua' => $request->ket_qua,
        ]);

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
        $moTaHuongDan = MoTaHuongDanCaNhan::find($id);

        if (!$moTaHuongDan) {
            return redirect()->back()->with('error', 'Không tìm thấy hướng dẫn!');
        }
        if ($request->field == 'chi_tiet') {
            $moTaHuongDan->update(['chi_tiet' => $request->value]);
        }
        if ($request->field == 'ket_qua') {
            $moTaHuongDan->update(['ket_qua' => $request->value]);
        }

        return response()->json(['success' => true, 'message' => 'Cập nhật thành công']);
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
        $moTa = MoTaHuongDanCaNhan::find($id);
        $moTa->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Xóa thành công',
        ]);
    }

    public function __getHuongDan(Request $request)
    {
        $huongDan = HuongDanCaNhan::find($request->idTrachNhiem);
        $moTa = MoTaHuongDanCaNhan::find($request->idMoTa);

        return [$huongDan, $moTa];
    }
}
