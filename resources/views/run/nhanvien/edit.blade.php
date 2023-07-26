<x-dashboard-layout>
    <x-slot name="title">Cập nhật thành viên</x-slot>

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
                        <h5>Cập nhật nhân viên</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('nhanvien.update',$nhanVien->id)}}" method="POST">
                        @csrf                  
                        @method('PUT')        
                            <div class="mb-4">
                                <label class="label" for="name">
                                    Tên đầy đủ
                                </label>
                                <input class="form-control" 
                                    id="name" 
                                    name="name" 
                                    type="text" 
                                    placeholder="Tên đầy đủ"                        
                                    value="{!! old('name', optional($nhanVien)->ho_ten) !!}"
                                >
                                @error('name')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="label" for="email">
                                    Email
                                </label>
                                <input class="form-control" 
                                    id="email" 
                                    name="email" 
                                    type="email" 
                                    placeholder="Email"                        
                                    value="{!! old('email', optional($nhanVien)->User->email) !!}"
                                    readonly
                                >
                                @error('name')
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
                                @error('group')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                            
                            
                            <div class="mb-4">
                                <label class="label" for="da_xoa">
                                    Trạng thái
                                </label>
                                <select class="form-control" 
                                    id="da_xoa" 
                                    name="da_xoa" 
                                    type="text" 
                                    placeholder="Trạng thái"                        
                                    value="{!! old('da_xoa', $nhanVien->da_xoa) !!}"
                                >
                                @foreach($nhanVien->dsTrangThaiXoa as $value=>$trangThai)
                                    <option value={{$value}} {{($nhanVien->da_xoa==$value)?"selected":""}}>{{$trangThai}}</option>
                                @endforeach
                                </select>
                                @error('name')
                                    <span class="help text-red-500"> {{ $message}}</span>
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
    
</x-dashboard-layout>