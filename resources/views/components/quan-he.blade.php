
     <!-- The Modal -->
     <div id="modal_add_quan_he" class="modal">
            
        <!-- Modal content -->
        <div class="modal-content">
        <span class="close" id="close-add-quan-he">&times;</span>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Quan hệ</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('front-quan-he.store')}}" method="POST">
                        @csrf     
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="label" for="id_vi_tri">
                                        Tên vị trí
                                    </label>
                                    <select name="id_vi_tri"  class="form-control"> 
                                        <option value="" id="option_add_quan_he"></option>
                                    </select>
                                    @error('id_vi_tri')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>    
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="label" for="loai">
                                        Loại 
                                    </label>
                                    <select name="loai" class="form-control">
                                        <option value="0">Bên trong công ty</option>
                                        <option value="1">Bên ngoài công ty</option>
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
                                    id="noi_dung" 
                                    name="noi_dung" 
                                    type="text" 
                                    placeholder="Nội dung"                        
                                    value="">{{old('noi_dung','')}}</textarea>
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

     <div id="modal_edit_quan_he" class="modal">
            
        <!-- Modal content -->
        <div class="modal-content">
        <span class="close" id="close-edit-quan-he">&times;</span>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Cập nhật quan hệ</h5>
                        </div>
                        <div class="card-body">
                            <form id="form_update_quan_he" method="POST">
                            @csrf   
                            @method('PUT')     
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-4">
                                        <label class="label" for="id_vi_tri">
                                            Vị Trí
                                        </label>
                                        <select name="id_vi_tri" class="form-control">                             
                                            <option  value="" id="option_edit_quan_he"></option>
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
                                            <option id="option_loai_ben_trong_cong_ty" value="0">Bên trong công ty</option>
                                            <option id="option_loai_ben_ngoai_cong_ty" value="1">Bên ngoài công ty</option>
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
                                        id="noi_dung_text_edit" 
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
            <x-xac-nhan id="xac-nhan-xoa-quan-he" class="alert-danger">
                <x-slot name="title">Xác nhận</x-slot>
                <x-slot name="body">Quan hệ này sẽ bị xóa. Bạn có chắc chắn</x-slot>
                <x-slot name="buttonClose">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        id="btn-close-xac-nhan-xoa-quan-he">Đóng</button>
                </x-slot>
                <x-slot name="button">
                    <button type="button" class="btn btn-danger" id="btn-xac-nhan-quan-he">Xóa</button>
                </x-slot>
            </x-xac-nhan>

    @push('scripts')
     <script>
        var modelAddQuanHe = document.getElementById('modal_add_quan_he');
        var modelEditQuanHe = document.getElementById('modal_edit_quan_he');
        var modelDeleteQuanHe = document.getElementById('xac-nhan-xoa-quan-he');

        var btnAddQuanHe = document.getElementById('btn_add_quan_he');
        var btnEditQuanHe = document.querySelectorAll('#btn_edit_quan_he');
        var btnDeleteQuanHe = document.querySelectorAll('#btn_delete_quan_he');
        var isProcessing = false;

        var btnCloseModalAddQuanHe = document.getElementById('close-add-quan-he');
        var btnCloseModalEditQuanHe = document.getElementById('close-edit-quan-he');
        var btnCloseModalDeleteQuanHe = document.getElementById('btn-close-xac-nhan-xoa-quan-he');
        
        if(btnAddQuanHe){
            btnAddQuanHe.onclick = function(){
                openModal(modelAddQuanHe);
                var idViTri = this.getAttribute('id-vi-tri');
                showModalThemQuanHe(idViTri)
            }

        }

        btnCloseModalAddQuanHe.addEventListener("click",function(){
            closeModal(modelAddQuanHe);
        })

        btnCloseModalDeleteQuanHe.addEventListener("click",function(){
            closeModal(modelDeleteQuanHe);
        })

        btnEditQuanHe.forEach(function(element){
            element.addEventListener("click",function(){
                if(isProcessing){
                    return;
                }
                isProcessing = true;
                openModal(modelEditQuanHe);
                var idQuanHe = this.getAttribute('id-quan-he');
                showModalSuaQuanHe(idQuanHe)
            })
        })

        btnDeleteQuanHe.forEach(function(element){
            element.addEventListener("click",function(){
                openModal(modelDeleteQuanHe);
                var idQuanHe = this.getAttribute('id-quan-he');
                var btnXacNhanXoaQuanHe = document.getElementById('btn-xac-nhan-quan-he');
                btnXacNhanXoaQuanHe.addEventListener("click",function(){
                    xoaQuanHe(idQuanHe);
                })
            })
        })

        btnCloseModalEditQuanHe.addEventListener("click",function(){
            closeModal(modelEditQuanHe);
        })


        function showModalThemQuanHe(idViTri){
            $.ajax({
                url:'/get-data-vi-tri',
                type:'get',
                dateType:'json',
                data:{
                    _token:"{{csrf_token()}}",
                    idViTri:idViTri
                },
                success:function(res){
                    var optionAddQuanHe = document.getElementById('option_add_quan_he');
                    optionAddQuanHe.text = res.ten_vi_tri;
                    optionAddQuanHe.value = res.id;
                }
            })
        }

        function showModalSuaQuanHe(idQuanHe){
            $.ajax({
                url:'/get-data-quan-he',
                type:'GET',
                dataType:'json',
                data:{
                    idQuanHe:idQuanHe
                },
                success:function(res){
                    var optionEditQuanHe = document.getElementById('option_edit_quan_he');
                    var noiDungTextEdit = document.getElementById('noi_dung_text_edit');
                    var optionLoaiBenTrongCongTy = document.getElementById('option_loai_ben_trong_cong_ty');
                    var optionLoaiBenNgoaiCongTy = document.getElementById('option_loai_ben_ngoai_cong_ty');
                    var formUpdateQuanHe = document.getElementById('form_update_quan_he');

                   

                    optionEditQuanHe.value = res[1].id
                    optionEditQuanHe.text = res[1].ten_vi_tri
                    noiDungTextEdit.value = res[0].noi_dung

                    if(res[0].loai == 0){
                        optionLoaiBenTrongCongTy.selected = true;
                    }

                    if(res[0].loai == 1){
                        optionLoaiBenNgoaiCongTy.selected = true;
                    }
                    var routeUpdate = "{{url('/front-quan-he')}}/" +res[0].id+ "/update";
                    formUpdateQuanHe.action = routeUpdate;
                }
            })
        }

        // Xóa quan hệ bằng ajax
        function xoaQuanHe(id){
            $.ajax({
                url:"{{url('front-quan-he-delete')}}/"+id,
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
                        $('thong-tao-trang-thai').addClass('alert-danger').removeClass('alert-danger').html(res.message).show();
                    }
                    closeSetTimeOut(500,modelDeleteQuanHe);
                }
            })
        }


     </script>
     @endpush
