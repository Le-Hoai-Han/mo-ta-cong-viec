@push('scripts')
<style>
    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 15px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
    }
    .full-width {
        grid-column: span 2;
    }
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 15px;
    }
    .btn {
        padding: 10px 15px;
        border-radius: 5px;
    }
</style>
@endpush

<!-- The Modal -->
<div id="model-edit-vi-tri" class="modal">
    <div class="modal-content">
        <span class="close" id="close_vi_tri">&times;</span>
        <div class="card">
            <div class="card-header">
                <h5>Chỉnh sửa vị trí</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid-container">
                        <div class="form-group">
                            <label for="ten_vi_tri">Tên vị trí</label>
                            <input type="text" class="form-control" name="ten_vi_tri" placeholder="Nhập tên vị trí" value="{{ old('ten_vi_tri', $viTri->ten_vi_tri) }}" id="input-edit-ten-vi-tri">
                        </div>

                        <div class="form-group">
                            <label for="phong_ban">Phòng ban</label>
                            <select name="id_phong_ban" class="form-control" id="input-phong-ban-edit-vi-tri">
                                <option value="">Chưa cập nhật</option>
                                @foreach ($listPhongBan as $phongBan)
                                    <option {{ $viTri->id_phong_ban == $phongBan->id ? 'selected' :'' }} value="{{ $phongBan->id }}">{{ $phongBan->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_vi_tri_quan_ly">Vị trí cấp trên</label>
                            <select name="id_vi_tri_quan_ly" class="form-control select-vi-tri-cap-tren-edit-vi-tri" id="tom-select-it1">
                                @foreach ($listViTri as $item)
                                    <option {{ $viTri->capQuanLy &&  $viTri->capQuanLy->id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                        {{ $item->ten_vi_tri }} - {{ $item->user != null ? $item->user->name : 'Đang cập nhật' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_user">Người dùng</label>
                            <select name="id_user" class="form-control select-user-edit-user" id="tom-select-it">
                                @foreach ($listUser as $user)
                                    <option {{ ($viTri->user != null ? $viTri->user->id : '') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                                <option value="0" {{ $viTri->id_user == null ? 'selected' :'' }}>Trống</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="noi_lam_viec">Nơi làm việc</label>
                            <input type="text" class="form-control" name="noi_lam_viec" placeholder="Nhập nơi làm việc" value="{{ old('noi_lam_viec', $viTri->noi_lam_viec) }}" id="input-noi-lam-viec-edit-vi-tri">
                        </div>

                        <div class="form-group full-width">
                            <label for="muc_dich">Mục đích</label>
                            <textarea rows="4" class="form-control" name="muc_dich" placeholder="Nhập mục đích" id="input-muc-dich-edit-vi-tri">{{ old('muc_dich', $viTri->muc_dich) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="colorPicker">Màu nhánh</label>
                            <input type="color" class="form-control" name="stroke" id="input-mau-nhanh-edit-vi-tri" value="{{ $viTri->stroke }}">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        <button type="button" class="btn btn-secondary" onclick="refresh()">Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="model-add-vi-tri" class="modal">
    <div class="modal-content">
        <span class="close" id="close_add_vi_tri">&times;</span>
        <div class="card">
            <div class="card-header text-center">
                <h5>Thêm vị trí</h5>
            </div>
            <div class="card-body">
                <form>
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="ten_vi_tri">Tên vị trí</label>
                            <input class="form-control" name="ten_vi_tri" type="text" placeholder="Tên vị trí" value="{!! old('ten_vi_tri') !!}" id="input-add-ten-vi-tri">
                        </div>
                        <div>
                            <label for="phong_ban">Phòng ban</label>
                            <select name="id_phong_ban" class="form-control" id="input-phong-ban-add-vi-tri">
                                <option value="">Chưa cập nhật</option>
                                @foreach ($listPhongBan as $phongBan)
                                    <option value="{{ $phongBan->id }}">{!! old('phong_ban', $phongBan->name) !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="noi_lam_viec">Vị trí cấp trên</label>
                            <select name="id_vi_tri_quan_ly" class="form-control">
                                <option value="{{$viTri->id}}" id="input-vi-tri-cap-tren-add-vi-tri">{{$viTri->ten_vi_tri}} - {{$viTri->user != null ? $viTri->user->name:''}}</option>
                            </select>
                        </div>
                        <div>
                            <label for="id_user">User</label>
                            <select name="id_user" id="tom-select-it2" class="form-control select-user-add-user" onchange="insertValueAddUser(this.value)">
                                <option value="0">Trống</option>
                                @foreach ($listUser as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="noi_lam_viec">Nơi làm việc</label>
                            <input class="form-control" name="noi_lam_viec" type="text" placeholder="Nơi làm việc" value="{!! old('noi_lam_viec') !!}" id="input-noi-lam-viec-add-vi-tri">
                        </div>
                        <div>
                            <label for="muc_dich">Mục đích</label>
                            <textarea rows="3" class="form-control" name="muc_dich" placeholder="Mục đích" id="input-muc-dich-add-vi-tri">{!! old('muc_dich') !!}</textarea>
                        </div>
                        <div>
                            <label for="colorPicker">Màu nhánh</label>
                            <input class="form-control w-24" name="stroke" type="color" id="input-mau-nhanh-add-vi-tri">
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <a class="btn btn-primary" onclick="addViTri()">Lưu</a>
                        <a onclick="refresh()" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Get the modal
        var modalViTri = document.getElementById("model-edit-vi-tri");

        var modalAddViTri = document.getElementById("model-add-vi-tri");

        // Get the button that opens the modal
        var btnEditViTri = document.getElementById("edit-vi-tri");
        var btnAddViTri = document.getElementById("add-vi-tri");

        if( btnEditViTri != null){
            var jsonViTri = JSON.parse(btnEditViTri.getAttribute('vi-tri'));
        }

        if(btnAddViTri != null){
            var jsonAddViTri = JSON.parse(btnAddViTri.getAttribute('vi-tri'));
        }

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

         //Update giá trị input tên vị trí
         var inputEditTenViTri = document.getElementById('input-edit-ten-vi-tri');
        var valueInputEditTenViTri = inputEditTenViTri.value;
        inputEditTenViTri.addEventListener('input',function(element){
            var inputValueEdit = element.target.value;
            valueInputEditTenViTri = inputValueEdit
        })

        //Thay đổi giá trị input phòng ban
        var inputPhongBanEditViTri = document.getElementById('input-phong-ban-edit-vi-tri');
        var valueInputPhongBanEditViTri = inputPhongBanEditViTri.value;

        inputPhongBanEditViTri.addEventListener('change',function(element){
            var inputValue = element.target.value;
            valueInputPhongBanEditViTri = inputValue
        })

        //Thay đổi giá trị input phòng ban khi add vị trí
        var inputPhongBanAddViTri = document.getElementById('input-phong-ban-add-vi-tri');
        var valueInputPhongBanAddViTri = inputPhongBanAddViTri.value;
        inputPhongBanAddViTri.addEventListener('change',function(element){
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
        if(btnEditViTri != null){
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

        }

        if(btnAddViTri != null){
            btnAddViTri.addEventListener("click", function() {
                openModal(modalAddViTri);
            });
        }


        // Event listener for closing the modal
        closeViTri.addEventListener("click", function(){
            // Đóng modal
            closeModal(modalViTri);
        });

        closeAddViTri.addEventListener("click", function(){
            // Đóng modal
            closeModal(modalAddViTri);
        });


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
                    "ten_vi_tri": valueInputEditTenViTri,
                    "id_phong_ban": valueInputPhongBanEditViTri,
                    "id_vi_tri_quan_ly": idViTriCapTren,
                    "id_user": idUser,
                    "noi_lam_viec": valueNoiLamViec,
                    "muc_dich": valueMucDich,
                    "stroke":colorEdit,
                },
                success: function(res) {
                    if(res.status == 'success'){
                        hienThongBao(res.message);
                        setTimeout(function() {
                                location.reload();
                            }, 500);
                    }else{
                        hienLoi(res.message);
                        setTimeout(function() {
                                location.reload();
                            }, 500);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    // console.log(xhr.status);
                    // console.log(thrownError);
                }
            });
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
                    id_phong_ban:valueInputPhongBanAddViTri,
                    noi_lam_viec: valueAddNoiLamViec,
                    muc_dich:valueAddMucDich,
                    id_user:idAddUser,
                    stroke:colorAdd,
                },
                success:function(res){
                    if(res.status == 'success'){
                        hienThongBao(res.message);
                        setTimeout(function() {
                                location.reload();
                            }, 500);
                    }else{
                        hienLoi(res.message);
                        setTimeout(function() {
                                location.reload();
                            }, 500);
                    }

                    window.location="/";
                }
            })
        }
        // phương thức mở modal
        function openModal(modal) {
            modal.classList.add('show');
        }

        // phương thức đóng modal
        function closeModal(modal) {
            modal.classList.remove('show');
        }
    </script>
@endpush
