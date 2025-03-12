<?php
$current = "Thẩm quyền";

?>

<x-dashboard-layout :current="$current">
    <x-slot name="title">Thêm vị trí</x-slot>

    <?php
    $list = [
        '/'=>'Trang chủ',
        route('tham-quyen.index')=>'Danh sách thẩm quyền'
    ]
    ?>
    <div class="main-div">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Thêm thẩm quyền</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('tham-quyen.store')}}" method="POST">
                        @csrf
                            <div class="mb-4">
                                <label class="label" for="id_vi_tri">
                                    Vị trí
                                </label>
                                <select class="form-control" name="id_vi_tri">
                                    @foreach($listViTri as $viTri)
                                        <option {{isset($viTriHT) && $viTriHT->id == $viTri->id ?'selected' :''}} value="{{$viTri->id}}">{{$viTri->ten_vi_tri}} - {{ $viTri->user ? $viTri->user->name :'Chưa cập nhật' }}</option>
                                    @endforeach
                                </select>
                                @error('id_vi_tri')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label" for="noi_dung">
                                    Nội dung
                                </label>
                                <input class="form-control"
                                    name="noi_dung"
                                    type="text"
                                    placeholder="Nội dung"
                                    value="{!! old('noi_dung', '') !!}"
                                >
                                @error('noi_dung')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label" for="loai">
                                    Loại
                                </label>
                                <select class="form-control" name="loai">
                                    <option value="1">Đề xuất</option>
                                    <option value="2">Ra quyết định</option>
                                </select>
                                @error('loai')
                                    <span class="help text-red-500"> {{ $message}}</span>
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
