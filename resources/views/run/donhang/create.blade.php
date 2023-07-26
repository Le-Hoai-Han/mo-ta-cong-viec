<x-dashboard-layout>

  <div class="main-div">
    <div class="row">
      <div class="row">
        <div class="col-xs-12">
        <form name="them_chi_tieu" method="POST" id="frm_them_chi_tieu" action="{{route('don-hang.store')}}">
          @csrf
         
              <div class="card">
                <div class="card-header pb-0 p-3">
                  
                  <div class="row">
                      <div class="col-6 d-flex align-items-center">
                          <h6 class="mb-0">Thêm đơn hàng</h6>
                      </div>
                      <div class="col-6 text-end">
                          <button type="submit" class="btn btn-primary btn-md mb-0">Lưu thông tin</button>                
                      </div>
                  </div>
                </div>

                <div class="card-body">  
                  @if(Session::has('error'))
                  <div style="color:white" class="alert alert-danger">{{Session::get('error')}}</div>
                  @endif
                  <p class="text-uppercase text-sm">Thông tin đơn hàng</p>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="ma_don_hang" class="form-control-label">Mã đơn hàng</label>
                        <input class="form-control" type="text" value="{{old('ma_don_hang','')}}" name="ma_don_hang" id="ma_don_hang"  onfocus="focused(this)" onfocusout="defocused(this)">
                        @error('ma_don_hang')
                            <span class="help text-danger"> {{ $message}}</span>
                        @enderror
                      </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_nhan_vien" class="form-control-label">Người tạo</label>
                            
                            <select name="id_nhan_vien" id="nhan_vien" aria-label="Người tạo" placeholder="Người tạo" class="form-control">
                              @foreach ($dsNhanVien as $nhanVien)
                                  <option value="{{$nhanVien->id}}"> {{$nhanVien->ho_ten}}</option>
                              @endforeach
                            </select>
                            @error('id_nhan_vien')
                                <span class="help text-danger"> {{ $message}}</span>
                            @enderror
                        </div>
                    </div>                                    
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="doanh_so" class="form-control-label">Doanh số</label>
                        <input class="form-control" type="text" value="{{old('doanh_so',0)}}" name="doanh_so" id="doanh_so"  onfocus="focused(this)" onfocusout="defocused(this)">
                        @error('doanh_so')
                            <span class="help text-danger"> {{ $message}}</span>
                        @enderror
                      </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="doanh_thu" class="form-control-label">Doanh thu</label>                        
                            <input class="form-control" type="text" value="{{old('doanh_thu',0)}}" name="doanh_thu" id="doanh_thu"  onfocus="focused(this)" onfocusout="defocused(this)">
                            @error('doanh_thu')
                                <span class="help text-danger"> {{ $message}}</span>
                            @enderror
                        </div>
                    </div>                                    
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="tong_vat" class="form-control-label">Tổng VAT (VNĐ)</label>
                        <input class="form-control" type="text" value="{{old('tong_vat',0)}}" name="tong_vat" id="tong_vat"  onfocus="focused(this)" onfocusout="defocused(this)">
                        @error('tong_vat')
                            <span class="help text-danger"> {{ $message}}</span>
                        @enderror
                      </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="tong_chiet_khau" class="form-control-label">Tổng chiết khấu (VNĐ)</label>                        
                          <input class="form-control" type="text" value="{{old('tong_chiet_khau',0)}}" name="tong_chiet_khau" id="tong_chiet_khau"  onfocus="focused(this)" onfocusout="defocused(this)">
                          @error('tong_chiet_khau')
                              <span class="help text-danger"> {{ $message}}</span>
                          @enderror
                        </div>
                    </div>                                    
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="phi_van_chuyen" class="form-control-label">Phí vận chuyển (VNĐ)</label>
                        <input class="form-control" type="text" value="{{old('phi_van_chuyen',0)}}" name="phi_van_chuyen" id="phi_van_chuyen"  onfocus="focused(this)" onfocusout="defocused(this)">
                        @error('phi_van_chuyen')
                            <span class="help text-danger"> {{ $message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-6 col-md-3">
                      <div class="form-group">
                        <label for="da_duyet" class="form-control-label">Trạng thái</label>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="check_da_duyet" name="da_duyet" value="1">
                          <label class="form-check-label" for="check_da_duyet">Đã duyệt đơn</label>
                        </div>
                        @error('da_duyet')
                            <span class="help text-danger"> {{ $message}}</span>
                        @enderror
                      </div>                  
                    </div>     
                    <div class="col-6 col-md-3">
                      <div class="form-group">
                        <label for="da_thanh_toan" class="form-control-label">Thanh toán</label>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="check_da_thanh_toan" name="da_thanh_toan" value="1">
                          <label class="form-check-label" for="check_da_thanh_toan">Đã thanh toán</label>
                        </div>
                        @error('da_thanh_toan')
                            <span class="help text-danger"> {{ $message}}</span>
                        @enderror
                      </div>                  
                    </div>                                            
                  </div>
                  <hr class="horizontal dark">
                  <p class="text-uppercase text-sm">Thông tin thời gian đơn hàng</p>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="ngay_dat_hang" class="form-control-label">Ngày đặt hàng</label>
                        <input class="form-control datepicker" placeholder="dd/mm/yyyy"  type="text" value="{{old('ngay_tao_don',date('d/m/Y'))}}" name="ngay_tao_don" id="ngay_tao_don"  onfocus="focused(this)"  onfocusout="defocused(this)">
                        @error('ngay_tao_don')
                            <span class="help text-danger"> {{ $message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="ngay_bat_dau_tinh_thuong" class="form-control-label">Ngày xuất hóa đơn (ngày bắt đầu tính thưởng)</label>
                        <input class="form-control datepicker" placeholder="dd/mm/yyyy"  type="text" value="{{old('ngay_bat_dau_tinh_thoi_han','')}}" name="ngay_bat_dau_tinh_thoi_han" id="ngay_bat_dau_tinh_thoi_han"  onfocus="focused(this)"  onfocusout="defocused(this)">
                        @error('ngay_bat_dau_tinh_thoi_han')
                            <span class="help text-danger"> {{ $message}}</span>
                        @enderror
                      </div>                  
                    </div>                                            
                  </div>

                  {{-- <div class="row"> --}}
                    {{-- <div class="col-md-6">
                      <div class="form-group">
                        <label for="ngay_thanh_toan_gan_nhat" class="form-control-label">Ngày thanh toán gần nhất</label>
                        <input class="form-control datepicker" placeholder="dd/mm/yyyy" type="text" value="{{old('ngay_thanh_toan_gan_nhat','')}}" name="ngay_thanh_toan_gan_nhat" id="ngay_thanh_toan_gan_nhat"  onfocus="focused(this)"  onfocusout="defocused(this)">
                        @error('ngay_thanh_toan_gan_nhat')
                            <span class="help text-danger"> {{ $message}}</span>
                        @enderror
                      </div>
                    </div> --}}
                    
                    {{-- <div class="col-md-6">
                      <div class="form-group">
                        <label for="ngay_ket_thuc_tinh_thuong" class="form-control-label">Ngày hết hạn tính thưởng (60 ngày từ ngày bắt đầu)</label>
                        <input class="form-control datepicker" placeholder="dd/mm/yyyy" type="text" value="{{old('ngay_ket_thuc_tinh_thuong','')}}" name="ngay_ket_thuc_tinh_thuong" id="ngay_ket_thuc_tinh_thuong"  onfocus="focused(this)"  onfocusout="defocused(this)">
                        @error('ngay_ket_thuc_tinh_thuong')
                            <span class="help text-danger"> {{ $message}}</span>
                        @enderror
                      </div>                  
                    </div>                                                            
                  </div> --}}
                  <hr class="horizontal dark">
                  <p class="text-uppercase text-sm">Thông tin tính thưởng</p>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="duoc_tinh_thuong" class="form-control-label">Đủ điều kiện để tính thưởng</label>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="check_duoc_tinh_thuong" name="duoc_tinh_thuong"  value="1">
                          <label class="form-check-label" for="check_duoc_tinh_thuong">Được tính thưởng</label>
                        </div>
                        @error('duoc_tinh_thuong')
                            <span class="help text-danger"> {{ $message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="tien_thuong_don_hang" class="form-control-label">Tiền thưởng của đơn hàng (VNĐ)</label>
                        <input class="form-control"  type="text" value="{{old('tien_thuong_don_hang',0)}}" name="tien_thuong_don_hang" id="tien_thuong_don_hang"  onfocus="focused(this)"  onfocusout="defocused(this)">
                        @error('tien_thuong_don_hang')
                            <span class="help text-danger"> {{ $message}}</span>
                        @enderror
                      </div>                  
                    </div>                                                            
                  </div>

                  <hr class="horizontal dark">
                  <p class="text-uppercase text-sm">Thông tin sản phẩm</p>
                        @error('SanPham')
                            <span class="help text-danger"> {{ $message}}</span>
                        @enderror
                  <div class="row">
                    @include('run.donhang._them_san_pham_thuoc_don_hang',[
                      'dsSanPham'=>$dsSanPham
                    ])
                    
                  </div>
                </div>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>

  @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.css">
    <link rel="stylesheet" href="{{asset('css/selectize-bootstrap-5.css')}}">
    <style>
      .row-sp td{
        border:1px solid #e9ecef!important;
      }
    </style>
  @endpush

  @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"></script>
    <script type="text/javascript">
        let danhSachSanPham;
        const loadSelectSanPham = () => {
              $("#san_pham_"+i).selectize({
                placeholder:'Chọn sản phẩm',
                valueField: "id",
                labelField: "ten_san_pham",
                searchField: "ten_san_pham",
                options:danhSachSanPham
            });
          }
          const loadDanhSachSanPham = () => {
            $.ajax({
            url: "{{route('donhang.loadDanhSachSanPham')}}",
            type:"get",
            dataType:"json",
            data:{
              _token:"{{csrf_token()}}"
            },
            success: function (res) {
              danhSachSanPham = res.data;
              loadSelectSanPham();
            },
          });
          }
        
        
            
        const addDeleteLink = (item) => {
          let deleteCell = item.querySelector('.delete-row');
          deleteCell.addEventListener('click',(e)=>{
            e.preventDefault();
            let tr = deleteCell.parentElement.parentElement;
            tr.remove();
          });
          
        }
        let i=1;
        const createSPRow = () => {
          let rowSP = document.querySelector('.row-sp-'+i);
          const newRow = rowSP.cloneNode(true);  
          newIndex = i+1;            
          newRow.classList.replace('row-sp-'+i,'row-sp-'+newIndex);
          
          let str = newRow.innerHTML;
          let reg=new RegExp('SanPham\\['+i+'\\]','ig');
          console.log(str.search(reg));
          
          
          
          newRow.innerHTML = str.replace('selected-cell-'+i,'selected-cell-'+newIndex);
          str = newRow.innerHTML;
          newRow.innerHTML = str.replaceAll(reg,'SanPham['+newIndex+']');
          let dropDownRow = newRow.querySelector('#san_pham_'+newIndex);
          
          rowSP.parentElement.appendChild(newRow);
          

          let selectCell = newRow.querySelector('#selected-cell-'+newIndex);
          selectCell.innerHTML = '<select name="SanPham['+newIndex+'][id_san_pham]" id="san_pham_'+newIndex+'" class="form-control"></select>';
          console.log(selectCell);
          
          i = newIndex;          
          loadSelectSanPham();
        }
        $(function () {
            $("#nhan_vien").selectize();
            loadDanhSachSanPham();
        });

        document.querySelector('#add_row_product').addEventListener('click',function(){
          createSPRow();
        })
    </script> 
  @endpush

</x-dashboard-layout>