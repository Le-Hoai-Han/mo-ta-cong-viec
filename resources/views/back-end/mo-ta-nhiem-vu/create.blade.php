<?php
$current = "Nhiệm vụ";

?>

<x-dashboard-layout :current="$current">
    <x-slot name="title">Mô tả nhiệm vụ</x-slot>

    <?php
    $list = [
        '/'=>'Trang chủ',
        route('nhiem-vu.index')=>'Danh sách nhiệm vụ'
    ]
    ?>
    <div class="main-div">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Mô tả nhiệm vụ</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('mo-ta-nhiem-vu.store')}}" method="POST">
                        @csrf
                            <div class="mb-4">
                                <label class="label" for="ten_nhiem_vu">
                                    Tên nhiệm vụ
                                </label>
                                <select name="id_nhiem_vu" class="form-control">
                                    @foreach($listNhiemVu as $nhiemVu)
                                    <option {{$nhiemVuHT && $nhiemVuHT->id == $nhiemVu->id ? 'selected':''}} value="{{$nhiemVu->id}}">{{$nhiemVu->ten_nhiem_vu}}</option>
                                    @endforeach
                                </select>
                                @error('ten_nhiem_vu')
                                    <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label" for="chi_tiet">
                                    Chi tiết
                                </label>
                                <textarea rows="5" class="form-control"
                                id=""
                                name="chi_tiet"
                                type="text"
                                placeholder="Chi tiết"
                                value=""></textarea>
                                @error('chi_tiet')
                                    <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label" for="ket_qua">
                                    Kết quả
                                </label>
                                <textarea rows="3" class="form-control"
                                id="ket_qua"
                                name="ket_qua"
                                type="text"
                                placeholder="Kết quả"
                                value=""></textarea>
                                @error('ket_qua')
                                    <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label" for="mo_ta">
                                    Mô tả
                                </label>
                                <textarea rows="5" class="form-control"
                                name="mo_ta"
                                type="text"
                                placeholder="Mô tả"
                                value=""
                            ></textarea>
                                @error('mo_ta')
                                    <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <button class="btn btn-primary">Lưu</button>
                                <a href="{{url()->previous()}}" class="btn btn-secondary">Hủy</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-dashboard-layout>
