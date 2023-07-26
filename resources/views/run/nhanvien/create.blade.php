<x-dashboard-layout>
    <x-slot name="title">Thêm thành viên</x-slot>

    <!-- <?php 
    // $list = [
    //     '/'=>'Trang chủ',
    //     route('users.index')=>'Danh sách thành viên',
    //     route('users.show',$user)=>$user->name,
    //     'Cập nhật'
    // ]
    ?> -->
    <div class="main-div">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Thêm nhân viên</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('nhanvien.store')}}" method="POST">
                        @csrf                  
                            <div class="mb-4">
                                <label class="label" for="ho_ten">
                                    Tên đầy đủ
                                </label>
                                <input class="form-control" 
                                    id="name" 
                                    name="ho_ten" 
                                    type="text" 
                                    placeholder="Tên đầy đủ"                        
                                    value="{!! old('ho_ten', '') !!}"
                                >
                                @error('ho_ten')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label class="label" for="id_nhom_nhan_vien">
                                    Nhóm
                                </label>
                                <select class="form-control" name="id_nhom_nhan_vien" id="id_nhom_nhan_vien">
                                    @foreach($dsNhomNhanVien as $nhomNhanVien)
                                        <?php 
                                            if($nhomNhanVien->id === $nhanVien->id_nhom_nhan_vien) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                        ?>

                                        <option {{$selected}} value="{{$nhomNhanVien->id}}">{{$nhomNhanVien->ten_nhom}}</option>
                                    @endforeach

                                 
                                </select>
                                @error('id_nhom_nhan_vien')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label" for="user_id">
                                    Tài khoản
                                </label>
                                <select class="form-control" name="user_id" id="user_id">
                                    @foreach($dsUser as $user)
                                        <?php 
                                            if($user->id === old('user_id')) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                        ?>

                                        <option {{$selected}} value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach

                                 
                                </select>
                                @error('user_id')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="label" for="getfly_id">
                                    Tài khoản getfly
                                </label>
                                <select class="form-control" name="getfly_id" id="getfly_id">
                                    <option value=""></option>
                                    @foreach($dsTaiKhoanGetfly as $taiKhoanGetfly)
                                        <?php 
                                            if($taiKhoanGetfly->id === $nhanVien->user_id) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                        ?>

                                        <option {{$selected}} value="{{$taiKhoanGetfly->id}}">{{$taiKhoanGetfly->ho_va_ten}}</option>
                                    @endforeach

                                 
                                </select>
                                @error('getfly_id')
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