<?php
$current = "Phòng ban ";

?>

<x-dashboard-layout :current="$current">
    <x-slot name="title">Xem phòng ban</x-slot>

    <?php
    $list = [
        '/'=>'Trang chủ',
        route('phong-ban.index')=>'Danh sách phòng ban'
    ]
    ?>
    <div class="main-div">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Xem phòng ban</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('phong-ban.update',$phongBan)}}" method="POST">
                        @csrf
                        @method('PUT')
                            <div class="mb-4">
                                <label class="label" for="ten_vi_tri">
                                    Tên phòng ban
                                </label>
                                <input class="form-control"
                                    name="name"
                                    type="text"
                                    placeholder="Tên phòng ban"
                                    value="{!! old('name', $phongBan->name) !!}"
                                >
                                @error('name')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label" for="ten_vi_tri">
                                    Nhân viên thuộc phòng ban
                                </label>
                                <select name="users[]" id="tom-select-it" class="form-control" multiple>
                                    @foreach($listUserThuocPhongBan as $userThuocPhongBan)
                                        <option selected value="{{$userThuocPhongBan->id}}">{{$userThuocPhongBan->name}}</option>
                                    @endforeach
                                    @foreach($listUser as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                @error('user')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label" for="description">
                                   Mô tả
                                </label>
                                <textarea rows="5" class="form-control"
                                    name="description"
                                    type="text"
                                    placeholder="Mô tả"
                                >{!! old('description', $phongBan->description) !!}</textarea>
                                @error('description')
                                    <span class="help text-red-500" style="color:Red"> {{ $message}}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <button class="btn btn-primary">Cập nhật</button>
                                <a href="{{url()->previous()}}" class="btn btn-secondary">Hủy</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
    <script>
        var settings = {};
        new TomSelect('#tom-select-it',settings);

        var settings1 = {};
        new TomSelect('#tom-select-it1',settings);
    </script>

@endpush

</x-dashboard-layout>
