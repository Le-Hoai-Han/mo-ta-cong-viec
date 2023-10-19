
    <!-- The Modal -->
    <div id="modal-add-tham-quyen" class="modal">
            
        <!-- Modal content -->
        <div class="modal-content">
        <span class="close" id="close-add-tham-quyen">&times;</span>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Thêm thẩm quyền</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('front-tham-quyen.store')}}" method="POST">
                        @csrf                  
                            <div class="mb-4">
                                <label class="label" for="id_vi_tri">
                                    Vị trí
                                </label>
                                <select class="form-control" name="id_vi_tri" disabled>
                                        <option value="" id="option-vi-tri"></option>
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
                                <a onclick="refresh()" class="btn btn-secondary">Hủy</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    {{-- Model edit thẩm quyền --}}
    <div id="modal-edit-tham-quyen" class="modal">
            
        <!-- Modal content -->
        <div class="modal-content">
        <span class="close" id="close-edit-tham-quyen">&times;</span>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Cập nhật thẩm quyền</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" id="form_update_tham_quyen">
                        @csrf
                        @method('PUT')         
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="label" for="id_vi_tri">
                                        Vị trí
                                    </label>
                                    <select class="form-control" name="id_vi_tri" disabled>
                                            <option value="" id="option-vi-tri-edit"></option>
                                    </select>
                                    @error('id_vi_tri')
                                        <span class="help text-red-500"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>    
                            <div class="col-md-3">
                                <div class="mb-4">
                                    <label class="label" for="loai">
                                        Loại
                                    </label>
                                    <select class="form-control" name="loai">
                                        <option id="option_tham_quyen_de_xuat" value="1">Đề xuất</option>
                                        <option id="option_tham_quyen_ra_quyet_dinh" value="2">Ra quyết định</option>
                                    </select>
                                    @error('loai')
                                        <span class="help text-red-500"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="mb-4">
                                    <label class="label" for="noi_dung">
                                        Nội dung
                                    </label>
                                    <textarea class="form-control" rows="5"
                                        id="noi-dung-edit" 
                                        name="noi_dung" 
                                        type="text" 
                                        placeholder="Nội dung"                        
                                        value="{!! old('noi_dung', '') !!}"
                                    ></textarea>
                                    @error('noi_dung')
                                        <span class="help text-red-500"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <button class="btn btn-primary">Lưu</button>
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

    <x-xac-nhan id="xac-nhan-xoa-tham-quyen" class="alert-danger">
        <x-slot name="title">Xác nhận</x-slot>
        <x-slot name="body">Thẩm quyền này sẽ bị xóa. Bạn có chắc chắn</x-slot>
        <x-slot name="buttonClose">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                id="btn-close-xac-nhan-xoa-tham-quyen">Đóng</button>
        </x-slot>
        <x-slot name="button">
            <button type="button" class="btn btn-danger" id="btn-xac-nhan-xoa-tham-quyen">Xóa</button>
        </x-slot>
    </x-xac-nhan>

    @push('scripts')
    <script>
        var modalAddThamQuyen = document.getElementById('modal-add-tham-quyen');
        var modalEditThamQuyen = document.getElementById('modal-edit-tham-quyen');
        var modalDeleteThamQuyen = document.getElementById('xac-nhan-xoa-tham-quyen');
        var btnAddThamQuyen = document.getElementById('btn-add-tham-quyen');
        var btnEditThamQuyen = document.querySelectorAll('#btn-edit-tham-quyen');
        var btnDeleteThamQuyen = document.querySelectorAll('#btn-delete-tham-quyen');
        var optionViTri = document.getElementById('option-vi-tri');
        var optionViTriEdit = document.getElementById('option-vi-tri-edit');
        var isProcessing = false;

        var btnCloseModalAddThamQuyen = document.getElementById('close-add-tham-quyen');
        var btnCloseModalEditThamQuyen = document.getElementById('close-edit-tham-quyen');
        var btnCloseModalDeleteThamQuyen = document.getElementById('btn-close-xac-nhan-xoa-tham-quyen');

        if(btnAddThamQuyen != null){
            btnAddThamQuyen.onclick = function(){
                openModal(modalAddThamQuyen);
                idViTri = btnAddThamQuyen.getAttribute('id-vi-tri');
                showMoDalThemThamQuyen(idViTri)
            }
        }

        btnCloseModalAddThamQuyen.addEventListener("click",function(){
            closeModal(modalAddThamQuyen);
        })

        btnCloseModalDeleteThamQuyen.addEventListener("click",function(){
            closeModal(modalDeleteThamQuyen);
        })

        btnEditThamQuyen.forEach(function(element){
            element.addEventListener("click",function(){
                if(isProcessing){
                    return;
                }
                isProcessing = true;
                openModal(modalEditThamQuyen);
                var idViTri = element.getAttribute('id-vi-tri');
                var idThamQuyen = element.getAttribute('id-tham-quyen');
                showMoDalSuaThamQuyen(idViTri,idThamQuyen);
            })
        })

        btnDeleteThamQuyen.forEach(function(element){
            element.addEventListener("click",function(){
                openModal(modalDeleteThamQuyen);
                var idThamQuyen = element.getAttribute('id-tham-quyen');
                var btnXacNhanXoaThamQuyen = document.getElementById('btn-xac-nhan-xoa-tham-quyen');
                btnXacNhanXoaThamQuyen.addEventListener("click",function(){
                    xoaThamQuyen(idThamQuyen);
                })
            })
        })

        btnCloseModalEditThamQuyen.addEventListener("click",function(){
            closeModal(modalEditThamQuyen);
        })

        function showMoDalThemThamQuyen(idViTri){
            $.ajax({
                url:'/get-data-vi-tri',
                type:'get',
                dataType:'json',
                data:{
                    _token:"{{csrf_token()}}",
                    idViTri:idViTri
                },
                success:function(res){
                    optionViTri.text = res.ten_vi_tri;
                    optionViTri.value = res.id;
                }
            })
        }

        function showMoDalSuaThamQuyen(idViTri,idThamQuyen){
            $.ajax({
                url:'/get-data-tham-quyen',
                type:'get',
                dataTyope:'json',
                data:{
                    _token:"{{csrf_token()}}",
                    idViTri:idViTri,
                    idThamQuyen:idThamQuyen
                },
                success:function(res){
                    optionViTriEdit.text = res[1].ten_vi_tri;
                    optionViTriEdit.value = res[1].id;

                    var noiDungEdit = document.getElementById('noi-dung-edit');
                    noiDungEdit.value = res[0].noi_dung;
                    console.log(res[0].loai);
                    if(res[0].loai == 1){
                        var optionThamQuyenDeXuat = document.getElementById('option_tham_quyen_de_xuat');
                        optionThamQuyenDeXuat.selected = true;
                    }

                    if(res[0].loai == 2){
                        var optionThamQuyenRaQuyetDinh = document.getElementById('option_tham_quyen_ra_quyet_dinh');
                        optionThamQuyenRaQuyetDinh.selected = true;
                    }

                    formUpdateThamQuyen = document.getElementById('form_update_tham_quyen');
                    var route_update = "{{url('front-tham-quyen')}}/" + res[0].id+"/update";
                    formUpdateThamQuyen.action = route_update;

                }
            })
        }

        function xoaThamQuyen(id){
            $.ajax({
                url:"{{url('front-tham-quyen-delete')}}/"+id,
                type:'delete',
                dataType:'json',
                data:{
                    _token:'{{csrf_token()}}',
                    id:id,
                },
                success:function(res){
                    if(res.status == 'success'){
                        $('#thong-bao-trang-thai').addClass('alert-success').removeClass('alert-danger').html(res.message).show();
                    }else{
                        $('thong-tao-trang-thai').addClass('alert-danger').removeClass('alert-danger').html(res.message).show();
                    }
                    
                    closeSetTimeOut(500,modalDeleteThamQuyen);
                }
            })
        }

    </script>

    @endpush


