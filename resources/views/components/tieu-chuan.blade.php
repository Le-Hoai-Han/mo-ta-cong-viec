
    {{-- Modal edit --}}
    <div id="modal_edit_tieu_chuan" class="modal">
        <div class="modal-content">
            <span class="close" id="close-edit-tieu-chuan">&times</span>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Tiêu chuẩn</h5>
                        </div>
                        <div class="card-body">
                            <form id="form_update_tieu_chuan" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label class="label" for="ten_nhiem_vu">
                                                Vị trí
                                            </label>
                                            <select name="id_vi_tri" class="form-control">
                                                <option value="" id="option_vi_tri_edit"></option>
                                            </select>
                                            @error('id_vi_tri')
                                                <span class="help text-red-500" style="color: red">
                                                    {{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label class="label" for="gioi_tinh">
                                                Giới tính
                                            </label>
                                            <select class="form-control" name="gioi_tinh">
                                                <option id="option_gioi_tinh_nam_edit" value="0">Nam</option>
                                                <option id="option_gioi_tinh_nu_edit" value="1">Nữ</option>
                                            </select>
                                            @error('gioi_tinh')
                                                <span class="help text-red-500" style="color: red">
                                                    {{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label class="label" for="tuoi">
                                                Độ tuổi
                                            </label>
                                            <textarea rows="1" class="form-control" id="textarea_tuoi_edit" name="tuoi" type="text" placeholder="Độ tuổi"
                                                value="">{!! old('tuoi') !!}</textarea>
                                            @error('tuoi')
                                                <span class="help text-red-500" style="color: red">
                                                    {{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">

                                        <div class="mb-4">
                                            <label class="label" for="hoc_van">
                                                Học vấn
                                            </label>
                                            <textarea rows="2" class="form-control" id="textarea_hoc_van_edit" name="hoc_van" type="text" placeholder="Học vấn"
                                                value="">{!! old('hoc_van') !!}</textarea>
                                            @error('hoc_van')
                                                <span class="help text-red-500" style="color: red">
                                                    {{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label class="label" for="chuyen_mon">
                                                Chuyên môn
                                            </label>
                                            <textarea rows="2" class="form-control" id="textarea_chuyen_mon_edit" name="chuyen_mon" type="text"
                                                placeholder="Chuyên môn" value="">{!! old('chuyen_mon') !!}</textarea>
                                            @error('chuyen_mon')
                                                <span class="help text-red-500" style="color: red">
                                                    {{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label class="label" for="vi_tinh">
                                                Tin học
                                            </label>
                                            <textarea rows="2" class="form-control" id="textarea_vi_tinh_edit" name="vi_tinh" type="text" placeholder="Tin học"
                                                value="">{!! old('vi_tinh') !!}</textarea>
                                            @error('vi_tinh')
                                                <span class="help text-red-500" style="color: red">
                                                    {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">


                                        <div class="mb-4">
                                            <label class="label" for="anh_ngu">
                                                Anh ngữ
                                            </label>
                                            <textarea rows="2" class="form-control" id="textarea_anh_ngu_edit" name="anh_ngu" type="text" placeholder="Anh ngữ"
                                                value="">{!! old('anh_ngu') !!}</textarea>
                                            @error('anh_ngu')
                                                <span class="help text-red-500" style="color: red">
                                                    {{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label class="label" for="kinh_nghiem">
                                                Kinh nghiệm
                                            </label>
                                            <textarea rows="2" class="form-control" id="textarea_kinh_nghiem_edit" name="kinh_nghiem" type="text"
                                                placeholder="Kinh nghiệm" value="">{!! old('kinh_nghiem') !!}</textarea>
                                            @error('kinh_nghiem')
                                                <span class="help text-red-500" style="color: red">
                                                    {{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label class="label" for="ky_nang">
                                                Kỹ năng
                                            </label>
                                            <textarea rows="2" class="form-control" id="textarea_ky_nang_edit" name="ky_nang" type="text" placeholder="Kỹ năng"
                                                value="">{!! old('ky_nang') !!}</textarea>
                                            @error('ky_nang')
                                                <span class="help text-red-500" style="color: red">
                                                    {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="mb-4">
                                            <label class="label" for="to_chat">
                                                Tố chất
                                            </label>
                                            <textarea rows="2" class="form-control" id="textarea_to_chat_edit" name="to_chat" type="text" placeholder="Tố chất"
                                                value="">{!! old('to_chat') !!}</textarea>
                                            @error('to_chat')
                                                <span class="help text-red-500" style="color: red">
                                                    {{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label class="label" for="ngoai_hinh">
                                                Ngoại hình
                                            </label>
                                            <textarea rows="2" class="form-control" id="textarea_ngoai_hinh_edit" name="ngoai_hinh" type="text"
                                                placeholder="Ngoại hình" value="">{!! old('ngoai_hinh') !!}</textarea>
                                            @error('ngoai_hinh')
                                                <span class="help text-red-500" style="color: red">
                                                    {{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label class="label" for="suc_khoe">
                                                Sức khỏe
                                            </label>
                                            <textarea rows="2" class="form-control" id="textarea_suc_khoe_edit" name="suc_khoe" type="text" placeholder="Sức khỏe"
                                                value="">{!! old('suc_khoe') !!}</textarea>
                                            @error('suc_khoe')
                                                <span class="help text-red-500" style="color: red">
                                                    {{ $message }}</span>
                                            @enderror
                                        </div>


                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label class="label" for="ho_khau">
                                                Nơi ở
                                            </label>
                                            <textarea rows="2" class="form-control" id="textarea_ho_khau_edit" name="ho_khau" type="text" placeholder="Nơi ở"
                                                value="">{!! old('ho_khau') !!}</textarea>
                                            @error('ho_khau')
                                                <span class="help text-red-500" style="color: red">
                                                    {{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label class="label" for="uu_tien">
                                                Ưu tiên
                                            </label>
                                            <textarea rows="2" class="form-control" id="textarea_uu_tien_edit" name="uu_tien" type="text" placeholder="Ưu tiên"
                                                value="">{!! old('uu_tien') !!}</textarea>
                                            @error('uu_tien')
                                                <span class="help text-red-500" style="color: red">
                                                    {{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label class="label" for="khac">
                                                Khác
                                            </label>
                                            <textarea rows="2" class="form-control" id="textarea_khac_edit" name="khac" type="text" placeholder="Khác"
                                                value="">{!! old('khac') !!}</textarea>
                                            @error('khac')
                                                <span class="help text-red-500" style="color: red">
                                                    {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <button class="btn btn-primary">Lưu</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Hủy</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>

        var modalEditTieuChuan = document.getElementById('modal_edit_tieu_chuan');
        var btnEditTieuChuan = document.getElementById('btn_edit_tieu_chuan');

        var btnCloseModalAddTieuChuan = document.getElementById('close-add-tieu-chuan');
        var btnCloseModalEditTieuChuan = document.getElementById('close-edit-tieu-chuan');

        btnCloseModalAddTieuChuan.addEventListener("click",function(){
            closeModal(modalAddTieuChuan);
        })



        if(btnEditTieuChuan != null){
            btnEditTieuChuan.onclick = function(){
               openModal(modalEditTieuChuan);
                idTieuChuan = this.getAttribute('id-tieu-chuan');
                showModalSuaTieuChuan(idTieuChuan);
            }
        }

        btnCloseModalEditTieuChuan.addEventListener("click",function(){
            closeModal(modalEditTieuChuan);
        })

        function showModalSuaTieuChuan(idTieuChuan){
            $.ajax({
                url:'/get-data-tieu-chuan',
                type:'get',
                dataType:'json',
                data:{
                    _token:"{{csrf_token()}}",
                    idTieuChuan:idTieuChuan
                },
                success:function(res){

                    var optionViTriEdit = document.getElementById('option_vi_tri_edit');
                    var optionGioiTinhNuEdit = document.getElementById('option_gioi_tinh_nu_edit');
                    var optionGioiTinhNamEdit = document.getElementById('option_gioi_tinh_nam_edit');
                    var textareaTuoiEdit = document.getElementById('textarea_tuoi_edit');
                    var textareaHocVanEdit = document.getElementById('textarea_hoc_van_edit');
                    var textareaAnhNguEdit = document.getElementById('textarea_anh_ngu_edit');
                    var textareaChuyenMonEdit = document.getElementById('textarea_chuyen_mon_edit');
                    var textareaKinhNghiemEdit = document.getElementById('textarea_kinh_nghiem_edit');
                    var textareaViTinhEdit = document.getElementById('textarea_vi_tinh_edit');
                    var textareaKyNangEdit = document.getElementById('textarea_ky_nang_edit');
                    var textareaToChatEdit = document.getElementById('textarea_to_chat_edit');
                    var textareaHoKhauEdit = document.getElementById('textarea_ho_khau_edit');
                    var textareaNgoaiHinhEdit = document.getElementById('textarea_ngoai_hinh_edit');
                    var textareaUuTienEdit = document.getElementById('textarea_uu_tien_edit');
                    var textareaKhacEdit = document.getElementById('textarea_khac_edit');
                    var textareaSucKhoeEdit = document.getElementById('textarea_suc_khoe_edit');
                    var formUpdateTieuChuan = document.getElementById('form_update_tieu_chuan');

                    optionViTriEdit.text = res[1].ten_vi_tri;
                    optionViTriEdit.value = res[1].id;
                    textareaTuoiEdit.value = res[0].tuoi;
                    textareaHocVanEdit.value = res[0].hoc_van;
                    textareaAnhNguEdit.value = res[0].anh_ngu;
                    textareaChuyenMonEdit.value = res[0].chuyen_mon;
                    textareaKinhNghiemEdit.value = res[0].kinh_nghiem;
                    textareaViTinhEdit.value = res[0].vi_tinh;
                    textareaKyNangEdit.value = res[0].ky_nang;
                    textareaToChatEdit.value = res[0].to_chat;
                    textareaHoKhauEdit.value = res[0].ho_khau;
                    textareaNgoaiHinhEdit.value = res[0].ngoai_hinh;
                    textareaUuTienEdit.value = res[0].uu_tien;
                    textareaKhacEdit.value = res[0].khac;
                    textareaSucKhoeEdit.value = res[0].suc_khoe;
                    if(res[0].gioi_tinh == 0){
                        optionGioiTinhNamEdit.selected = true;
                    }

                    if(res[0].gioi_tinh == 1){
                        optionGioiTinhNuEdit.selected = true;
                    }

                    var routeUpdate = "{{url('/front-tieu-chuan')}}/" +res[0].id +"/update";
                    formUpdateTieuChuan.action = routeUpdate;

                }
            })
        }
    </script>
    @endpush

