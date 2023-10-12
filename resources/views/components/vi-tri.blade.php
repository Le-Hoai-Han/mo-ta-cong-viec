<!-- The Modal -->
<div id="model-edit-vi-tri" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close" id="close_vi_tri">&times;</span>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit vị trí</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label class="label" for="ten_vi_tri">
                                            Tên vị trí
                                        </label>
                                        <input class="form-control" name="ten_vi_tri" type="text"
                                            placeholder="Tên vị trí" value="{!! old('ten_vi_tri', $viTri->ten_vi_tri) !!}" disabled>
                                        @error('ten_vi_tri')
                                            <span class="help text-red-500"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label class="label" for="phong_ban">
                                            Phòng ban
                                        </label>
                                        <input class="form-control" name="phong_ban" type="text"
                                            placeholder="Tên phòng ban" value="{!! old('phong_ban', $viTri->phong_ban) !!}" id="input-phong-ban-edit-vi-tri">
                                        @error('phong_ban')
                                            <span class="help text-red-500"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label class="label" for="noi_lam_viec">
                                            Vị trí cấp trên
                                        </label>
                                        <select name="id_vi_tri_quan_ly" id="tom-select-it1" class="form-control select-vi-tri-cap-tren-edit-vi-tri" onchange="insertValueSelectViTriCapTrenEditViTri(this.value)">
                                            @foreach ($listViTri as $item)
                                                <option <?php echo $viTri->capQuanLy->id == $item->id ? 'selected' : ' '; ?> value="{{ $item->id }}">
                                                    {{ $item->ten_vi_tri }}
                                                    - {{ $item->user != null ? $item->user->name : '' }}</option>
                                            @endforeach

                                        </select>
                                        @error('id_vi_tri_quan_ly')
                                            <span class="help text-red-500"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="label" for="id_user">
                                            User
                                        </label>
                                        <select name="id_user" id="tom-select-it" class="form-control select-user-edit-user" onchange="insertValueUser(this.value)">
                                            @foreach ($listUser as $user)
                                                <option
                                                    {{ ($viTri->user != null ? $viTri->user->id : '') == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                            <option value="0" {{$viTri->id_user == null ? 'selected' :''}}>null</option>
                                        </select>
                                        @error('id_user')
                                            <span class="help text-red-500"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="label" for="noi_lam_viec">
                                            Nơi làm việc
                                        </label>
                                        <input class="form-control" name="noi_lam_viec" type="text"
                                            placeholder="Nơi làm việc" value="{!! old('noi_lam_viec', $viTri->noi_lam_viec) !!}" id="input-noi-lam-viec-edit-vi-tri">
                                        @error('noi_lam_viec')
                                            <span class="help text-red-500"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-4">
                                        <label class="label" for="muc_dich">
                                            Mục đích
                                        </label>
                                        <textarea rows="5" class="form-control" name="muc_dich" type="text" placeholder="Mục đích" id="input-muc-dich-edit-vi-tri">{!! old('muc_dich', $viTri->muc_dich) !!}</textarea>
                                        @error('muc_dich')
                                            <span class="help text-red-500" style="color:Red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-4">
                                        <label class="label" for="colorPicker">
                                            Màu nhánh
                                        </label>
                                        <input class="form-control" style="width: 100px;" name="stroke" type="color" placeholder="Mục đích" id="input-mau-nhanh-edit-vi-tri" value="{{$viTri->stroke}}"/>
                                        @error('stroke')
                                            <span class="help text-red-500" style="color:Red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <a class="btn btn-primary" onclick="updateViTri()">Lưu</a>
                                    <a onclick="refresh()" class="btn btn-secondary">Hủy</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div id="model-add-vi-tri" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close" id="close_add_vi_tri" >&times;</span>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Thêm vị trí</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label class="label" for="ten_vi_tri">
                                            Tên vị trí
                                        </label>
                                        <input class="form-control" name="ten_vi_tri" type="text"
                                            placeholder="Tên vị trí" value="{!! old('ten_vi_tri') !!}" id="input-add-ten-vi-tri">
                                        @error('ten_vi_tri')
                                            <span class="help text-red-500"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label class="label" for="phong_ban">
                                            Phòng ban
                                        </label>
                                        <input class="form-control" name="phong_ban" type="text"
                                            placeholder="Tên phòng ban" value="{!! old('phong_ban') !!}" id="input-phong-ban-add-vi-tri">
                                        @error('phong_ban')
                                            <span class="help text-red-500"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label class="label" for="noi_lam_viec">
                                            Vị trí cấp trên
                                        </label>
                                        <select name="id_vi_tri_quan_ly" class="form-control">
                                            <option  value="{{$viTri->id}}" id="input-vi-tri-cap-tren-add-vi-tri">{{$viTri->ten_vi_tri}}</option> 
                                        </select>
                                        @error('id_vi_tri_quan_ly')
                                            <span class="help text-red-500"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="label" for="id_user">
                                            User
                                        </label>
                                        <select name="id_user" id="tom-select-it2" class="form-control select-user-add-user" onchange="insertValueAddUser(this.value)">
                                            <option value="0">Trống</option>
                                            @foreach ($listUser as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_user')
                                            <span class="help text-red-500"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="label" for="noi_lam_viec">
                                            Nơi làm việc
                                        </label>
                                        <input class="form-control" name="noi_lam_viec" type="text"
                                            placeholder="Nơi làm việc" value="{!! old('noi_lam_viec') !!}" id="input-noi-lam-viec-add-vi-tri">
                                        @error('noi_lam_viec')
                                            <span class="help text-red-500"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-4">
                                        <label class="label" for="muc_dich">
                                            Mục đích
                                        </label>
                                        <textarea rows="5" class="form-control" name="muc_dich" type="text" placeholder="Mục đích" id="input-muc-dich-add-vi-tri">{!! old('muc_dich') !!}</textarea>
                                        @error('muc_dich')
                                            <span class="help text-red-500" style="color:Red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-4">
                                        <label class="label" for="colorPicker">
                                            Màu nhánh
                                        </label>
                                        <input class="form-control" name="stroke" type="color" placeholder="Mục đích" id="input-mau-nhanh-add-vi-tri" style="width: 100px;"/>
                                        @error('stroke')
                                            <span class="help text-red-500" style="color:Red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <a class="btn btn-primary" onclick="addViTri()">Lưu</a>
                                    <a onclick="refresh()" class="btn btn-secondary">Hủy</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<x-xac-nhan id="xac-nhan-delete-vi-tri" class="alert-danger">
    <x-slot name="title">Xác nhận</x-slot>
    <x-slot name="body">Vị trí sẽ bị xóa.Các mô tả liên quan đến vị trí sẽ bị khóa và không được phục hồi...</x-slot>
    <x-slot name="buttonClose">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
            id="btn-close-xac-nhan-xoa-vi-tri">Đóng</button>
    </x-slot>
    <x-slot name="button">
        <button type="button" class="btn btn-danger" onclick="xoaViTri()">Xóa</button>
    </x-slot>
</x-xac-nhan>

@push('scripts')
    <script>
        // Get the modal
        var modalViTri = document.getElementById("model-edit-vi-tri");
        var modalAddViTri = document.getElementById("model-add-vi-tri");
        var modalXacNhanXoaViTri = document.getElementById('xac-nhan-delete-vi-tri');

        // Get the button that opens the modal
        var btnEditViTri = document.getElementById("edit-vi-tri");
        var btnAddViTri = document.getElementById("add-vi-tri");
        var btnXoaViTri = document.getElementById('delete-vi-tri');

        var jsonViTri = JSON.parse(btnEditViTri.getAttribute('vi-tri'));
        var jsonAddViTri = JSON.parse(btnAddViTri.getAttribute('vi-tri'));

        // Get the <span> element that closes the modal
        var closeViTri = document.getElementById("close_vi_tri");
        var closeAddViTri = document.getElementById("close_add_vi_tri");
        var btnCloseXacNhanXoaViTri = document.getElementById('btn-close-xac-nhan-xoa-vi-tri');

         //Thêm giá trị input tên vị trí
         var inputAddTenViTri = document.getElementById('input-add-ten-vi-tri');
        var valueInputAddTenViTri = inputAddTenViTri.value;
        
        inputAddTenViTri.addEventListener('input',function(element){
            var inputValueAdd = element.target.value;
            valueInputAddViTri = inputValueAdd
        })

        //Thay đổi giá trị input phòng ban
        var inputPhongBanEditViTri = document.getElementById('input-phong-ban-edit-vi-tri');
        var valueInputPhongBanEditViTri = inputPhongBanEditViTri.value;
        
        inputPhongBanEditViTri.addEventListener('input',function(element){
            var inputValue = element.target.value;
            valueInputPhongBanEditViTri = inputValue
        })

        //Thay đổi giá trị input phòng ban khi add vị trí
        var inputPhongBanAddViTri = document.getElementById('input-phong-ban-add-vi-tri');
        var valueInputPhongBanAddViTri = inputPhongBanAddViTri.value;
        inputPhongBanAddViTri.addEventListener('input',function(element){
            var inputValueAddViTri = element.target.value;
            valueInputPhongBanAddViTri = inputValueAddViTri
        })

        // Thay đổi giá trị select vị trí cấp trên
        var inputViTriCapTrenEditViTri = document.getElementsByClassName('select-vi-tri-cap-tren-edit-vi-tri')[0];
        var idViTriCapTren = inputViTriCapTrenEditViTri.value;

        function insertValueSelectViTriCapTrenEditViTri(valueViTriCapTren){
            // Thay đổi giá trị
            idViTriCapTren = valueViTriCapTren;
        }


        // Thay đổi giá trị select user
        var inputUserEditUser = document.getElementsByClassName('select-user-edit-user')[0];
        var idUser = inputUserEditUser.value;

       function insertValueUser(valueUser){
            idUser = valueUser;
        }

        var inputUserAddUser = document.getElementsByClassName('select-user-add-user')[0];
        var idAddUser = inputUserAddUser.value;

        function insertValueAddUser(valueAddUser){
            idAddUser = valueAddUser;
        }

        // Thay đổi giá trị nơi làm việc

        var inputNoiLamViecAddViTri = document.getElementById('input-noi-lam-viec-add-vi-tri');
        var valueAddNoiLamViec = inputNoiLamViecAddViTri.value;
        inputNoiLamViecAddViTri.addEventListener('input',function(element){
            var valueAddNoiLamViecText = element.target.value;console.log(valueAddNoiLamViecText);
            valueAddNoiLamViec = valueAddNoiLamViecText
        })

         // Thay đổi giá trị nơi làm việc

        var inputNoiLamViecEditViTri = document.getElementById('input-noi-lam-viec-edit-vi-tri');
        var valueNoiLamViec = inputNoiLamViecEditViTri.value;
        inputNoiLamViecEditViTri.addEventListener('input',function(element){
            var valueNoiLamViecText = element.target.value;
            valueNoiLamViec = valueNoiLamViecText
        })

        // Thay đổi giá trị mục đích

        var inputMucDichAddViTri = document.getElementById('input-muc-dich-edit-vi-tri');
        var valueAddMucDich = inputMucDichAddViTri.value;
        inputMucDichAddViTri.addEventListener('input',function(element){
            var valueAddMucDichText = element.target.value;
            valueAddMucDich = valueAddMucDichText
        })

        var inputMucDichEditViTri = document.getElementById('input-muc-dich-edit-vi-tri');
        var valueMucDich = inputMucDichEditViTri.value;
        inputMucDichEditViTri.addEventListener('input',function(element){
            var valueMucDichText = element.target.value;
            valueMucDich = valueMucDichText
        })

        // Thay đổi giá trị màu nhánh
        var inputMauNhanhEditViTri = document.getElementById('input-mau-nhanh-edit-vi-tri');
        var colorEdit = inputMauNhanhEditViTri.value;
        inputMauNhanhEditViTri.addEventListener('input',function(event){
            var colorEditViTri = event.target.value;
            colorEdit = colorEditViTri;
        })

        var inputMauNhanhAddViTri = document.getElementById('input-mau-nhanh-add-vi-tri');
        var colorAdd = inputMauNhanhAddViTri.value;
        inputMauNhanhAddViTri.addEventListener('input',function(event){
            var colorAddViTri = event.target.value;
            colorAdd = colorAddViTri;
        })

        // When the user clicks the button, open the modal 
       
            btnEditViTri.addEventListener("click", function() {
                if (jsonViTri.trang_thai == 1) {
                    $('#thong-bao-trang-thai').removeClass('alert-success').addClass('alert-danger').html(
                        'Vị trí đang bị khóa thông tin').show();
                        closeSetTimeOut(500);
                        
                } else {
                    // Mở modal
                    openModal(modalViTri);
                }
            });

            btnAddViTri.addEventListener("click", function() {
                openModal(modalAddViTri);
            });


        // Event listener for closing the modal
        closeViTri.addEventListener("click", function(){
            // Đóng modal
            closeModal(modalViTri);
        });

        closeAddViTri.addEventListener("click", function(){
            // Đóng modal
            closeModal(modalAddViTri);
        });

        btnXoaViTri.addEventListener("click",function(){
            openModal(modalXacNhanXoaViTri);
        })

        btnCloseXacNhanXoaViTri.addEventListener("click",function(){
            closeModal(modalXacNhanXoaViTri);
        })

        

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalViTri) {
                closeModal(modalViTri);
            }
        }

        function updateViTri() {
            $.ajax({
                url: '{{route("front-vi-tri.update",$viTri)}}',
                type: 'PUT',
                dateType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "ten_vi_tri": "{{ $viTri->ten_vi_tri }}",
                    "phong_ban": valueInputPhongBanEditViTri,
                    "id_vi_tri_quan_ly": idViTriCapTren,
                    "id_user": idUser,
                    "noi_lam_viec": valueNoiLamViec,
                    "muc_dich": valueMucDich,
                    "stroke":colorEdit,
                },
                success: function(res) {
                    if(res.status == 'success'){
                        $('#thong-bao-trang-thai').addClass('alert-success').removeClass('alert-danger').html(res.message).show();
                    }else{
                        $('#thong-bao-trang-thai').addClass('alert-danger').removeClass('alert-success').html(res.message).show();
                    }
                    closeSetTimeOut(1000);
                    // closeModal(modalViTri);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        }

        function xoaViTri(){
            $.ajax({
                url:"{{route('front-vi-tri.destroy',$viTri)}}",
                type:'delete',
                dataType:'json',
                data:{
                    _token:'{{csrf_token()}}',
                },
                success:function(res){console.log(res);

                    if(res.status == 'success'){
                        $('#thong-bao-trang-thai').addClass('alert-success').removeClass('alert-danger').html(res.message).show();
                    }else{
                        $('thong-tao-trang-thai').addClass('alert-danger').removeClass('alert-danger').html(res.message).show();
                    }

                    window.location="/";
                }
            })
        }

        function addViTri(){
            $.ajax({
                url:"{{route('front-vi-tri.store')}}",
                type:'post',
                dataType:'json',
                data:{
                    _token:'{{csrf_token()}}',
                    id_vi_tri_quan_ly:"{{$viTri->id}}",
                    ten_vi_tri:valueInputAddViTri,
                    phong_ban:valueInputPhongBanAddViTri,
                    noi_lam_viec: valueAddNoiLamViec,
                    muc_dich:valueAddMucDich,
                    id_user:idAddUser,
                    stroke:colorAdd,
                },
                success:function(res){

                    if(res.status == 'success'){
                        $('#thong-bao-trang-thai').addClass('alert-success').removeClass('alert-danger').html(res.message).show();
                    }else{
                        $('thong-tao-trang-thai').addClass('alert-danger').removeClass('alert-danger').html(res.message).show();
                    }

                    window.location="/";
                }
            })
        }
    </script>
@endpush
