
     <!-- The Modal -->
     <div id="modal_add_ask" class="modal">
            
        <!-- Modal content -->
        <div class="modal-content">
        <span class="close" id="close-add-ask">&times;</span>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>ASK (Attitude - Skill - Knowledge)</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('front-ask.store')}}" method="POST">
                        @csrf     
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="label" for="id_vi_tri">
                                        Tên vị trí
                                    </label>
                                    <select name="id_vi_tri"  class="form-control"> 
                                        <option value="" id="option_add_ask"></option>
                                    </select>
                                    @error('id_vi_tri')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>   
                            
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="label" for="loại">
                                        Loại 
                                    </label>
                                   <select name="loai" class="form-control">
                                        <option id="option_loai_thai_do" value="0">Attitude (Thái độ)</option>
                                        <option id="option_loai_ky_nang" value="1">Skill (Kỹ năng)</option>
                                        <option id="option_loai_kien_thuc" value="2">Knowledge (Kiến thức)</option>
                                   </select>
                                    @error('loai')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="mb-4">
                                    <label class="label" for="noi_dung">
                                        Nội dung 
                                    </label>
                                    <textarea rows="5" class="form-control" 
                                    id="noi_dung_text_ask_add" 
                                    name="noi_dung" 
                                    type="text" 
                                    placeholder="Nội dung"                        
                                    value="">{{old('noi_dung')}}</textarea>
                                    @error('noi_dung')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
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

     <div id="modal_edit_ask" class="modal">
            
        <!-- Modal content -->
        <div class="modal-content">
        <span class="close" id="close-edit-ask">&times;</span>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Cập nhật ASK (Attitude - Skill - Knowledge)</h5>
                        </div>
                        <div class="card-body">
                            <form id="form_update_ask" method="POST">
                            @csrf   
                            @method('PUT')     
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label class="label" for="id_vi_tri">
                                            Vị Trí
                                        </label>
                                        <select name="id_vi_tri" class="form-control">                             
                                            <option  value="" id="option_edit_ask"></option>
                                        </select>
                                        @error('id_vi_tri')
                                            <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label class="label" for="loại">
                                            Loại 
                                        </label>
                                       <select name="loai" class="form-control">
                                            <option id="option_loai_thai_do_edit" value="0">Attitude (Thái độ)</option>
                                            <option id="option_loai_ky_nang_edit" value="1">Skill (Kỹ năng)</option>
                                            <option id="option_loai_kien_thuc_edit" value="2">Knowledge (Kiến thức)</option>
                                       </select>
                                        @error('loai')
                                            <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-4">
                                        <label class="label" for="noi_dung">
                                            Nội dung 
                                        </label>
                                        <textarea rows="5" class="form-control" 
                                        id="noi_dung_ask_edit" 
                                        name="noi_dung" 
                                        type="text" 
                                        placeholder="Nội dung"                        
                                        value="">{{old('noi_dung')}}</textarea>
                                        @error('noi_dung')
                                            <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                </div>
                                <div class="mb-4">
                                    <button class="btn btn-primary">Cập nhật</button>
                                    <a onclick="refresh()" class="btn btn-secondary">Hủy</a>
                                </div>
                            </div>
                                
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <x-xac-nhan id="xac-nhan-xoa-ask" class="alert-danger">
                <x-slot name="title">Xác nhận</x-slot>
                <x-slot name="body">ASK này sẽ bị xóa. Bạn có chắc chắn</x-slot>
                <x-slot name="buttonClose">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        id="btn-close-xac-nhan-xoa-ask">Đóng</button>
                </x-slot>
                <x-slot name="button">
                    <button type="button" class="btn btn-danger" id="btn-xac-nhan-ask">Xóa</button>
                </x-slot>
            </x-xac-nhan>

    @push('scripts')
     <script>
        var modelAddASK = document.getElementById('modal_add_ask');
        var modelEditASK = document.getElementById('modal_edit_ask');
        var modelDeleteASK = document.getElementById('xac-nhan-xoa-ask');

        var btnAddASK = document.getElementById('btn_add_ask');
        var btnEditASK = document.querySelectorAll('#btn_edit_ask');
        var btnDeleteASK = document.querySelectorAll('#btn_delete_ask');
        var isProcessing = false;

        var btnCloseModalAddASK = document.getElementById('close-add-ask');
        var btnCloseModalEditASK = document.getElementById('close-edit-ask');
        var btnCloseModalDeleteASK = document.getElementById('btn-close-xac-nhan-xoa-ask');
        
        if(btnAddASK){
            btnAddASK.onclick = function(){
                openModal(modelAddASK);
                var idViTri = this.getAttribute('id-vi-tri');
                showModalThemASK(idViTri)
            }

        }

        btnCloseModalAddASK.addEventListener("click",function(){
            closeModal(modelAddASK);
        })

        btnCloseModalDeleteASK.addEventListener("click",function(){
            closeModal(modelDeleteASK);
        })

        btnEditASK.forEach(function(element){
            element.addEventListener("click",function(){
                // if(isProcessing){
                //     return;
                // }
                // isProcessing = true;
                openModal(modelEditASK);
                var idASK = this.getAttribute('id-ask');
                showModalSuaASK(idASK)
            })
        })

        btnDeleteASK.forEach(function(element){
            element.addEventListener("click",function(){
                openModal(modelDeleteASK);
                var idASK = this.getAttribute('id-ask');
                var btnXacNhanXoaASK = document.getElementById('btn-xac-nhan-ask');
                btnXacNhanXoaASK.addEventListener("click",function(){
                    xoaASK(idASK);
                })
            })
        })

        btnCloseModalEditASK.addEventListener("click",function(){
            closeModal(modelEditASK);
        })


        function showModalThemASK(idViTri){
            $.ajax({
                url:'/get-data-vi-tri',
                type:'get',
                dateType:'json',
                data:{
                    _token:"{{csrf_token()}}",
                    idViTri:idViTri
                },
                success:function(res){
                    var optionAddASK = document.getElementById('option_add_ask');
                    optionAddASK.text = res.ten_vi_tri;
                    optionAddASK.value = res.id;
                }
            })
        }

        function showModalSuaASK(idASK){
            $.ajax({
                url:'/get-data-ask',
                type:'GET',
                dataType:'json',
                data:{
                    idASK:idASK
                },
                success:function(res){
                    var optionEditASK = document.getElementById('option_edit_ask');
                    var noiDungAskEdit = document.getElementById('noi_dung_ask_edit');
                    var formUpdateASK = document.getElementById('form_update_ask');
                    var optionLoaiThaiDo = document.getElementById('option_loai_thai_do_edit');
                    var optionLoaiKyNang = document.getElementById('option_loai_ky_nang_edit');
                    var optionLoaiKienThuc = document.getElementById('option_loai_kien_thuc_edit');
                    
                    console.log(res);
                    noiDungAskEdit.value = res[0].noi_dung
                    optionEditASK.text = res[1].ten_vi_tri
                    optionEditASK.value = res[1].id

                    if(res[0].loai == 0){
                        optionLoaiThaiDo.selected = true;
                    }

                    if(res[0].loai == 1){
                        optionLoaiKyNang.selected = true;
                    }

                    if(res[0].loai == 2){
                        optionLoaiKienThuc.selected = true;
                    }

                    var routeUpdate = "{{url('/front-ask')}}/" +res[0].id+ "/update";
                    formUpdateASK.action = routeUpdate;
                }
            })
        }

        // Xóa quan hệ bằng ajax
        function xoaASK(id){
            $.ajax({
                url:"{{url('front-ask-delete')}}/"+id,
                type:'delete',
                dataType:'json',
                data:{
                    _token:"{{csrf_token()}}",
                    id:id,
                },
                success:function(res){
                    if(res.status == 'success'){
                        $('#thong-bao-trang-thai').addClass('alert-success').removeClass('alert-danger').html(res.message).show();
                    }else{
                        $('#thong-tao-trang-thai').addClass('alert-danger').removeClass('alert-danger').html(res.message).show();
                    }
                    closeSetTimeOut(500,modelDeleteASK);
                }
            })
        }


     </script>
     @endpush
