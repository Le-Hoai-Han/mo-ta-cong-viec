<x-dashboard-layout>
    <x-slot name="title">Cập nhật nhóm nhân viên</x-slot>

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
                        <h5>Cập nhật nhóm nhân viên</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('nhomnhanvien.update',$nhomNhanVien->id)}}" method="POST">
                        @csrf                  
                        @method('PUT')        
                            <div class="mb-4">
                                <label class="label" for="name">
                                    Mã nhóm
                                </label>
                                <input class="form-control" 
                                    id="ma_nhom" 
                                    name="ma_nhom" 
                                    type="text" 
                                    placeholder="Mã Nhóm"                        
                                    value="{!! old('ma_mhom', optional($nhomNhanVien)->ma_nhom) !!}"
                                >
                                @error('ma_nhom')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label class="label" for="ten_nhom">
                                    Tên nhóm
                                </label>
                                <input class="form-control" 
                                    name="ten_nhom" 
                                    type="text" 
                                    placeholder="Tên nhóm"                        
                                    value="{!! old('ten_nhom', optional($nhomNhanVien)->ten_nhom) !!}"
                                >
                                @error('ten_nhom')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label class="label" for="id_quan_ly">
                                    Người quản lý
                                </label>
                                <select name="id_quan_ly" id="id_quan_ly">
                                    <option value="">Không</option>
                                    @if($nhomNhanVien->coQuanLy())
                                        <option value="{{$nhomNhanVien->id_quan_ly}}" selected>[{{$nhomNhanVien->quanLy->group}}] {{$nhomNhanVien->quanLy->ho_ten}}</option>
                                    @endif
                                    @foreach($dsNhanVien as $nhanVien)
                                        <option value="{{$nhanVien->id}}">[{{$nhanVien->group}}] {{$nhanVien->ho_ten}}</option>                                         
                                    @endforeach
                                </select>
                                @error('id_quan_ly')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <button class="btn btn-primary">Cập nhật</button>
                                <a href="{{route('nhomnhanvien.index')}}" class="btn btn-secondary">Hủy</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.css">
    <link rel="stylesheet" href="{{asset('css/selectize-bootstrap-5.css')}}">
  
    @endpush

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"></script>
        <script type="text/javascript">

            $(function () {
            
               $("#id_quan_ly").selectize({});
            });
            </script>
    @endpush
</x-dashboard-layout>