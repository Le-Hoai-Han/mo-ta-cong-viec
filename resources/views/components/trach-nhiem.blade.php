
    <!-- The Modal -->
    <div id="model-add-trach-nhiem" class="modal">
        
        <!-- Modal content -->
        <div class="modal-content">
          <span class="close" id="close-add-nhiem-vu">&times;</span>
          <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Thêm nhiệm vụ</h5>
                    </div>
                    <div class="card-body">
                        <form>
                        @csrf                  
                            <div class="mb-4">
                                <label class="label" for="ten_nhiem_vu">
                                    Tên nhiệm vụ
                                </label>
                                <input class="form-control"
                                    name="ten_nhiem_vu" 
                                    type="text" 
                                    placeholder="Tên nhiệm vụ"                        
                                    value="{!! old('ten_nhiem_vu', '') !!}"
                                    id="add-name-nhiem-vu"
                                >
                                @error('ten_nhiem_vu')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                            

                            <div class="mb-4">
                                <label class="label" for="id_vi_tri">
                                    Vị trí
                                </label>
                                <select  name="id_vi_tri" class="form-control">
                                    @foreach($listViTri as $viTri)
                                    <option {{$viTriHienTai->id == $viTri->id ? 'selected' :''}}  value="{{$viTri->id}}">{{$viTri->ten_vi_tri}}</option>
                                    @endforeach
                                </select>
                                @error('id_vi_tri')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                           
                            <div class="mb-4">
                                <a class="btn btn-primary" onclick="addTrachNhiem()">Lưu</a>
                                <a href="{{url()->previous()}}" class="btn btn-secondary">Hủy</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    {{-- model edit trách nhiệm --}}
    <div id="model-edit-trach-nhiem" class="modal">
        
        <!-- Modal content -->
        <div class="modal-content">
          <span class="close" id="close-edit-nhiem-vu">&times;</span>
          <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Cập nhật nhiệm vụ</h5>
                    </div>
                    <div class="card-body">
                        <form id="form-edit-trach-nhiem">                 
                            <div class="mb-4">
                                <label class="label" for="ten_nhiem_vu">
                                    Tên nhiệm vụ
                                </label>
                                <input class="form-control" 
                                    id="edit_name_nhiem_vu" 
                                    name="ten_nhiem_vu" 
                                    type="text" 
                                    placeholder="Tên nhiệm vụ"                        
                                    value="{!! old('ten_nhiem_vu') !!}"
                                >
                                @error('ten_nhiem_vu')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                            

                            <div class="mb-4">
                                <label class="label" for="id_vi_tri">
                                    Vị trí
                                </label>
                                <select  name="id_vi_tri" class="form-control">
                                    @foreach($listViTri as $viTri)
                                    <option {{$viTriHienTai->id == $viTri->id ? 'selected' :''}}  value="{{$viTri->id}}">{{$viTri->ten_vi_tri}}</option>
                                    @endforeach
                                </select>
                                @error('id_vi_tri')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                           
                            <div class="mb-4">
                                <a class="btn btn-primary" onclick="updateTrachNhiem()">Lưu</a>
                                <a href="{{url()->previous()}}" class="btn btn-secondary">Hủy</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <x-xac-nhan id="xac-nhan-xoa-trach-nhiem" class="alert-danger">
        <x-slot name="title">Xác nhận</x-slot>
        <x-slot name="body">Trách nhiệm này sẽ bị xóa. Bạn có chắc chắn</x-slot>
        <x-slot name="buttonClose">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                id="btn-close-xac-nhan-xoa-trach-nhiem">Đóng</button>
        </x-slot>
        <x-slot name="button">
            <button type="button" class="btn btn-danger" id="btn-xac-nhan-xoa-trach-nhiem">Xóa</button>
        </x-slot>
    </x-xac-nhan>
    @push('scripts')
    <script>
         // Get the modal
         var modalAddTrachNhiem = document.getElementById("model-add-trach-nhiem");
         var modalEditTrachNhiem = document.getElementById("model-edit-trach-nhiem");
         var modalXacNhanXoaTrachNhiem = document.getElementById('xac-nhan-xoa-trach-nhiem');
         var formEditTrachNhiem = document.getElementById('form-edit-trach-nhiem');
         
         // Get the button that opens the modal
         var btnAddNhiemVu = document.getElementById("add-trach-nhiem");
         var btnEditNhiemVu = document.querySelectorAll("#edit-trach-nhiem");
         var btnDeleteNhiemVu = document.querySelectorAll("#delete-trach-nhiem");
         
        var closeAddModalNhiemVu = document.getElementById("close-add-nhiem-vu");
        var closeEditModalNhiemVu = document.getElementById("close-edit-nhiem-vu");
        var closeDeleteModalNhiemVu = document.getElementById("btn-close-xac-nhan-xoa-trach-nhiem");


        var addNameNhiemVu = document.getElementById('add-name-nhiem-vu');
        var valueTenNhiemVuAdd = addNameNhiemVu.value;
        addNameNhiemVu.addEventListener("input",function(event){
            valueTenNhiemVuAdd = event.target.value;
        })

        // Lấy input chứa tên nhiệm vụ cần edit
        var editNameNhiemVu = document.getElementById('edit_name_nhiem_vu');

        //  Thay đổi giá trị tên nhiệm vụ(trách nhiệm)
        var valueTenNhiemVuEdit = editNameNhiemVu.value;
        editNameNhiemVu.addEventListener("input",function(event){
            valueTenNhiemVuEditText = event.target.value;
            valueTenNhiemVuEdit = valueTenNhiemVuEditText;
        })
        
        // When the user clicks the button, open the modal 
        btnAddNhiemVu.onclick = function() {
           openModal(modalAddTrachNhiem);
        }

        
        // When the user clicks on <span> (x), close the modal
            closeAddModalNhiemVu.addEventListener("click",function(){
                closeModal(modalAddTrachNhiem);
            })
            closeEditModalNhiemVu.addEventListener("click",function(){
                closeModal(modalEditTrachNhiem);
            })

            closeDeleteModalNhiemVu.addEventListener("click",function(){
                closeModal(modalXacNhanXoaTrachNhiem);
            })
        
        // When the user clicks anywhere outside of the modal, close it
       

        // show modal và truyền biến vào

        btnEditNhiemVu.forEach(function(element){
            element.addEventListener("click",function(){
                openModal(modalEditTrachNhiem);
                showTrachNhiem(element.getAttribute('id-trach-nhiem'));
            })
         })

         btnDeleteNhiemVu.forEach(function(element){
            element.addEventListener("click",function(){
                openModal(modalXacNhanXoaTrachNhiem);
                var idNhiemVu = element.getAttribute('id-trach-nhiem');
                var btnXacNhanXoaTrachNhiem = document.getElementById('btn-xac-nhan-xoa-trach-nhiem');
                btnXacNhanXoaTrachNhiem.addEventListener("click",function(){
                    xoaTrachNhiem(idNhiemVu);
                });
            })
         })

        

        function showTrachNhiem(idTrachNhiem){
            $.ajax({
                url:'/get-data-trach-nhiem',
                type:'GET',
                dataType:"json",
                data:{
              _token:"{{csrf_token()}}",
              idTrachNhiem:idTrachNhiem
            },
            success:function(res){
                editNameNhiemVu.value = res.ten_nhiem_vu;
                routeUpdate = "{{ url('front-nhiem-vu') }}/"+res.id+"/update";
                formEditTrachNhiem.action = routeUpdate;
            }
            })
        }

        function updateTrachNhiem() {
            $.ajax({
                url: routeUpdate,
                type: 'PUT',
                dateType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "ten_nhiem_vu": valueTenNhiemVuEdit,
                    "id_vi_tri": "{{$viTriHienTai->id}}",
                },
                success: function(res) {
                    if(res.status == 'success'){
                        $('#thong-bao-trang-thai').addClass('alert-success').removeClass('alert-danger').html(res.message).show();
                    }else{
                        $('#thong-bao-trang-thai').addClass('alert-danger').removeClass('alert-success').html(res.message).show();
                    }

                    closeSetTimeOut(500,modalEditTrachNhiem);
                }
            });
        }

        function addTrachNhiem() {
            $.ajax({
                url: "{{route('front-nhiem-vu.store')}}",
                type: 'POST',
                dateType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "ten_nhiem_vu": valueTenNhiemVuAdd,
                    "id_vi_tri": "{{$viTriHienTai->id}}",
                },
                success: function(res) {
                    if(res.status == 'success'){
                        $('#thong-bao-trang-thai').addClass('alert-success').removeClass('alert-danger').html(res.message).show();
                    }else{
                        $('#thong-bao-trang-thai').addClass('alert-danger').removeClass('alert-success').html(res.message).show();
                    }
    
                    closeSetTimeOut(500,modalAddTrachNhiem);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        }

        function xoaTrachNhiem(id){
            $.ajax({
                url:"{{url('front-nhiem-vu-delete')}}/" +id ,
                type:"delete",
                dataType:"json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id":id,
                },
                success:function(res){
                    if(res.status == 'success'){
                        $('#thong-bao-trang-thai').addClass('alert-success').removeClass('alert-danger').html(res.message).show();
                    }else{
                        $('#thong-bao-trang-thai').addClass('alert-danger').removeClass('alert-success').html(res.message).show();
                    }
                    closeModal(modalXacNhanXoaTrachNhiem);
                    closeSetTimeOut(500,modalXacNhanXoaTrachNhiem);
                }
            })
        }
    </script>
    @endpush

