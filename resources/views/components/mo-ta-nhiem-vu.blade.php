
     <div id="model-add-mo-ta-trach-nhiem" class="modal">
        
        <!-- Modal content -->
        <div class="modal-content">
          <span class="close" id="close_add_mo_ta">&times;</span>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Mô tả nhiệm vụ</h5>
                        </div>
                        <div class="card-body">
                            <form>                 
                                <div class="mb-4">
                                    <label class="label" for="ten_nhiem_vu">
                                        Tên nhiệm vụ
                                    </label>
                                    <select name="id_nhiem_vu" class="form-control" id="select-ten-nhiem-vu-add-mo-ta">       
                                        <option value="" id="option_trach_nhiem"></option>
                                    </select>
                                    @error('ten_nhiem_vu')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="label" for="chi_tiet">
                                        Chi tiết 
                                    </label>
                                    <textarea rows="5" class="form-control" 
                                    name="chi_tiet" 
                                    type="text" 
                                    placeholder="Chi tiết"                        
                                    id="textarea-chi-tiet-add-mo-ta"></textarea>
                                    @error('chi_tiet')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="label" for="ket_qua">
                                        Kết quả 
                                    </label>
                                    <textarea rows="3" class="form-control" 
                                    name="ket_qua" 
                                    type="text" 
                                    placeholder="Kết quả"                        
                                    id="textarea-ket-qua-add-mo-ta"></textarea>
                                    @error('ket_qua')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>

                                {{-- <div class="mb-4">
                                    <label class="label" for="mo_ta">
                                        Mô tả 
                                    </label>
                                    <textarea rows="5" class="form-control"  
                                    name="mo_ta" 
                                    type="text" 
                                    placeholder="Mô tả"                        
                                    id="textarea-mo-ta-add-mo-ta"
                                ></textarea>
                                    @error('mo_ta')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div> --}}
                                <div class="mb-4">
                                    <a class="btn btn-primary" onclick="addMoTaNhiemVu()">Lưu</a>
                                    <a onclick="refresh()" class="btn btn-secondary">Hủy</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>

     {{-- Modal edit mo ta trach nhiem  --}}
     <div id="model-edit-mo-ta-trach-nhiem" class="modal">
        <div class="modal-content">
            <span class="close" id="close_edit_mo_ta">&times;</span>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Cập nhật mô tả nhiệm vụ</h5>
                        </div>
                        <div class="card-body">
                            <form id="form-update-mo-ta" method="POST">
                            @csrf   
                            @method('PUT')     
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="label" for="ten_nhiem_vu">
                                            Tên nhiệm vụ
                                        </label>
                                        <select name="id_nhiem_vu" class="form-control">
                                            @foreach($listNhiemVu as $nhiemVu)
                                            <option value="" id="option_edit_trach_nhiem"></option>
                                            @endforeach
                                        </select>
                                        @error('ten_nhiem_vu')
                                            <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label class="label" for="chi_tiet">
                                            Chi tiết 
                                        </label>
                                        <textarea rows="5" class="form-control" 
                                        id="chi_tiet_text" 
                                        name="chi_tiet" 
                                        type="text" 
                                        placeholder="Chi tiết"                        
                                        ></textarea>
                                        @error('chi_tiet')
                                            <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label class="label" for="ket_qua">
                                                Kết quả 
                                            </label>
                                            <textarea rows="5" class="form-control" 
                                            id="ket_qua_text" 
                                            name="ket_qua" 
                                            type="text" 
                                            placeholder="Kết quả"                        
                                            value="">{{old('ket_qua')}}</textarea>
                                            @error('ket_qua')
                                                <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <div class="mb-4">
                                            <label class="label" for="mo_ta">
                                                Mô tả 
                                            </label>
                                            <textarea rows="5" class="form-control" 
                                            id="mo_ta_text" 
                                            name="mo_ta" 
                                            type="text" 
                                            placeholder="Mô tả"                        
                                            value=""
                                        >{{old('mo_ta')}}</textarea>
                                            @error('mo_ta')
                                                <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                            @enderror
                                        </div>
                                    </div> --}}
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

     <x-xac-nhan id="xac-nhan-xoa-mo-ta-nhiem-vu" class="alert-danger">
        <x-slot name="title">Xác nhận</x-slot>
        <x-slot name="body">Nhiệm vụ này sẽ bị xóa. Bạn có chắc chắn</x-slot>
        <x-slot name="buttonClose">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                id="btn-close-xac-nhan-xoa-mo-ta-nhiem-vu">Đóng</button>
        </x-slot>
        <x-slot name="button">
            <button type="button" class="btn btn-danger" id="btn-xac-nhan-xoa-mo-ta-nhiem-vu">Xóa</button>
        </x-slot>
    </x-xac-nhan>
     
     @push('scripts')
     <script>
        // Lấy id model
        var modalAddMoTaTrachNhiem = document.getElementById('model-add-mo-ta-trach-nhiem');
        var modalEditMoTaTrachNhiem = document.getElementById('model-edit-mo-ta-trach-nhiem');
        var modalDeleteMoTaTrachNhiem = document.getElementById('xac-nhan-xoa-mo-ta-nhiem-vu');

        // lấy button để mở model
        var btnAddMoTaTrachNhiem = document.querySelectorAll('#add-mo-ta-trach-nhiem');
        var btnEditMoTaTrachNhiem = document.querySelectorAll('#edit-mo-ta-trach-nhiem');
        var btnDeleteMoTaTrachNhiem = document.querySelectorAll('#delete-mo-ta-nhiem-vu');

        // Lay id select chon trach nhiem
        var optionTrachNhiem = document.getElementById('option_trach_nhiem');
        var isProcessing = false;

        // KHi user click vào thêm mô tả sẽ show modal và truyền biến 
        btnAddMoTaTrachNhiem.forEach(function(element){
            element.addEventListener("click",function(){
                // if(isProcessing){
                //     return;
                // }
                // isProcessing = true;
                openModal(modalAddMoTaTrachNhiem);
                const idNhiemVu = this.getAttribute("id-nhiem-vu");
                showMoDalThemMoTa(idNhiemVu);
            })
        })

        var closeAddMoTa = document.getElementById("close_add_mo_ta");
        closeAddMoTa.addEventListener("click",function(){
            closeModal(modalAddMoTaTrachNhiem);
        })

        var closeEditMoTa = document.getElementById("close_edit_mo_ta");
        closeEditMoTa.addEventListener("click",function(){
            closeModal(modalEditMoTaTrachNhiem);
        })

        var btnCloseXacNhanXoaMoTaNhiemVu = document.getElementById('btn-close-xac-nhan-xoa-mo-ta-nhiem-vu');
        btnCloseXacNhanXoaMoTaNhiemVu.addEventListener("click",function(){
            closeModal(modalDeleteMoTaTrachNhiem);
        })


        btnEditMoTaTrachNhiem.forEach(function(element){
            element.addEventListener("click",function(){
                // console.log(isProcessing);
                // if(isProcessing){
                //     return;
                // }
                // isProcessing = true;
               openModal(modalEditMoTaTrachNhiem);
                const idNhiemVu = this.getAttribute("id-nhiem-vu");
                const idMoTa = this.getAttribute("id-mo-ta");
                showMoDalSuaMoTa(idNhiemVu,idMoTa);
            })
        })

        btnDeleteMoTaTrachNhiem.forEach(function(element){
            element.addEventListener("click",function(){
               openModal(modalDeleteMoTaTrachNhiem);
               var idMoTaNhiemVu = element.getAttribute('id-mo-ta');
               var btnXacNhanXoaMoTaNhiemVu = document.getElementById('btn-xac-nhan-xoa-mo-ta-nhiem-vu');
               btnXacNhanXoaMoTaNhiemVu.addEventListener("click",function(){
                    xoaMoTaNhiemVu(idMoTaNhiemVu);
               })
            })
        })

        // Thay đổi giá trị của chi tiết khi add thêm mô tả
        var textAreaChiTietAddMoTa = document.getElementById('textarea-chi-tiet-add-mo-ta');
        var valueChiTietAddMoTa = '';
        textAreaChiTietAddMoTa.addEventListener("input",function(event){
            valueChiTietAddMoTa = event.target.value;
        })

         // Thay đổi giá trị của kết quả khi add thêm mô tả
         var textAreaKetQuaAddMoTa = document.getElementById('textarea-ket-qua-add-mo-ta');
        var valueKetQuaAddMoTa = '';
        textAreaKetQuaAddMoTa.addEventListener("input",function(event){
            valueKetQuaAddMoTa = event.target.value;
        })

        // Thay đổi giá trị của mô tả khi add thêm mô tả
        // var textAreaMoTaAddMoTa = document.getElementById('textarea-mo-ta-add-mo-ta');
        // var valueMoTaAddMoTa = '';
        // textAreaMoTaAddMoTa.addEventListener("input",function(event){
        //     valueMoTaAddMoTa = event.target.value;
        // })

        function showMoDalThemMoTa(idTrachNhiem){
            $.ajax({
                url:'/get-data-trach-nhiem',
                type:'get',
                dataTyope:'json',
                data:{
                    _token:"{{csrf_token()}}",
                    idTrachNhiem:idTrachNhiem
                },
                success:function(res){
                    optionTrachNhiem.text = res.ten_nhiem_vu;
                    optionTrachNhiem.value = res.id;
                }
            })
        }

       
        function showMoDalSuaMoTa(idTrachNhiem,idMoTa){
            $.ajax({
                url:'/get-data-mo-ta-trach-nhiem',
                type:'get',
                dataType:'json',
                data:{
                    _token:"{{csrf_token()}}",
                    idTrachNhiem:idTrachNhiem,
                    idMoTa:idMoTa
                },
                success:function(res){
                     // Kiểm tra dữ liệu trả về 
                    if (res && res.length >= 2) {
                        const optionEditTrachNhiem = document.getElementById("option_edit_trach_nhiem");
                        const chiTietText = document.getElementById("chi_tiet_text");
                        const ketQuaText = document.getElementById("ket_qua_text");
                        const moTaText = document.getElementById("mo_ta_text");
                        var formUpdateMoTa = document.getElementById('form-update-mo-ta');
                
                        optionEditTrachNhiem.text = res[0].ten_nhiem_vu;
                        optionEditTrachNhiem.value = res[0].id;
                        chiTietText.value = res[1].chi_tiet;
                        ketQuaText.value = res[1].ket_qua;

                        routeUpdate = "{{url('front-mo-ta-nhiem-vu')}}/"+res[1].id+"/update";
                        console.log(routeUpdate);
                        formUpdateMoTa.action = routeUpdate;

                    }
                }
            })
        }

         // KHi người dùng click vào bên ngoài cửa sổ sẽ ẩn modal
         window.onclick = function(event){
            if(event.target == modalAddMoTaTrachNhiem){
                modalAddMoTaTrachNhiem.style.display = "none";
            }

            if(event.target == modalEditMoTaTrachNhiem){
                modalEditMoTaTrachNhiem.style.display = "none";
            }
        }


        
        // ADD thêm mô tả bằng ajax
        function addMoTaNhiemVu(){
            $.ajax({
                url:"{{route('front-mo-ta-nhiem-vu.store')}}",
                type:'POST',
                dataType:'json',
                data:{
                    "_token": "{{ csrf_token() }}",
                    "id_nhiem_vu":optionTrachNhiem.value,
                    "chi_tiet": valueChiTietAddMoTa,
                    "ket_qua": valueKetQuaAddMoTa,
                },
                success:function(res){
                    if(res.status == 'success'){
                        $('#thong-bao-trang-thai').addClass('alert-success').removeClass('alert-danger').html(res.message).show();
                    }else{
                        $('#thong-tao-trang-thai').addClass('alert-danger').removeClass('alert-success').html(res.message).show();
                    }

                    closeSetTimeOut(500,modalAddMoTaTrachNhiem);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            })
        }

        
        // Update mô tả bằng ajax
        // function updateMoTaNhiemVu(){console.log()
        //     $.ajax({
        //         url:routeUpdate,
        //         type:'PUT',
        //         dataType:'json',
        //         data:{
        //             '_token':'{{csrf_token()}}',
        //             'id_nhiem_vu': optionEditTrachNhiem.value,
        //             'chi_tiet':valueChiTietEditMoTa,
        //             'ket_qua':valueKetQuaEditMoTa,
        //             'mo_ta':valueMoTaEditMoTa
        //         },
        //         success:function(res){
        //             console.log(res);
        //         },
        //         error: function (xhr, ajaxOptions, thrownError) {
        //             console.log(xhr.status);
        //             console.log(thrownError);
        //         }
        //     })
        // }

        // Xóa mô tả bằng ajax
        function xoaMoTaNhiemVu(id){
            $.ajax({
                url:"{{url('front-mo-ta-nhiem-vu-delete')}}/"+id,
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

                    closeSetTimeOut(500,modalDeleteMoTaTrachNhiem);
                }
            })
        }

     </script>
     @endpush