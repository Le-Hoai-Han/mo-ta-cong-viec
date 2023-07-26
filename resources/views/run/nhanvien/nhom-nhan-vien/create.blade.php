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
                        <h5>Thêm nhóm nhân viên</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p style="color:white">{{ $error }}</p>
                        @endforeach
                            </div><br>
                        @endif          

                        @if(Session::has('error'))
                            <div style="color:white" class="alert alert-danger">{{Session::get('error')}}</div>
                        @endif
                        <form action="{{route('nhomnhanvien.store')}}" method="POST">
                        @csrf                          
                            <div class="mb-4">
                                <label class="label" for="name">
                                    Mã nhóm
                                </label>
                                <input class="form-control" 
                                    id="ma_nhom" 
                                    name="ma_nhom" 
                                    type="text" 
                                    placeholder="Mã Nhóm"                        
                                    value="{{old('ma_nhom')}}"
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
                                    id="ten_nhom" 
                                    name="ten_nhom" 
                                    type="text" 
                                    placeholder="Tên nhóm"                        
                                    value="{{old('ten_nhom')}}"
                                >
                                @error('ten_nhom')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>
                            
                            
                            <div class="mb-4">
                                <label class="label" for="id_quan_ly">
                                    Người quản lý
                                </label>
                                <select name="id_quan_ly" id='id_quan_ly'>
                                    <option value="">Không</option>
                                    
                                    @foreach($dsNhanVien as $nhanVien)
                                        <option value="{{$nhanVien->id}}">[{{$nhanVien->group}}] {{$nhanVien->ho_ten}}</option>                                         
                                    @endforeach
                                </select>
                                @error('id_quan_ly')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <button class="btn btn-primary">Thêm nhóm</button>
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

            // console.log(dsNhanVien);
            $(function () {
                
                // $("#hang_muc_thuong").selectize();
                // $("#cong_thuc_tinh").selectize();
               $("#id_quan_ly").selectize({});
            });
            </script>
    @endpush
</x-dashboard-layout>