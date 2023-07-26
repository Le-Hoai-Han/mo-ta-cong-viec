<x-dashboard-layout>

  <div class="main-div">
    <div class="row">
      <div class="col-xs-12">
        <div class="card">
          <div class="card-header pb-0 p-3">
            <div class="row">
              <div class="col-6 d-flex align-items-center">
                <h6 class="mb-0">Cập nhật sản phẩm</h6>
              </div>
            </div>
          </div>

          <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
              <p>{{ $error }}</p>
              @endforeach

            </div><br>
            @endif

            @if(Session::has('error'))
            <div style="color:white" class="alert alert-danger">{{Session::get('error')}}</div>
            @endif


            <div class="row">
              <form method="post" action="{{route('danh-muc-san-pham.update',$data)}}">
                @csrf
                @method('PUT')
                <div class="card-header">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Id</label>
                    <input type="text" value="{{$data->id}}" readonly name="" class="form-control" id="" placeholder="">
                  </div>

                  <div class="form-group">
                    <label for="ma_san_pham">Mã sản phẩm</label>
                    <input value="{{$data->ma_san_pham}}" readonly type="text" name="ma_san_pham" class="form-control" id="ma_san_pham" placeholder="">
                  </div>

                  <div class="form-group">
                    <label for="ten_san_pham">Tên sản phẩm</label>
                    <input value="<?php echo ucfirst($data->ten_san_pham) ?>" readonly type="text" name="ten_san_pham" class="form-control" id="ten_san_pham" placeholder="">
                  </div>

                  {{-- <div class="form-group">
                    <label for="chiet_khau">Chiết khấu(%)</label>
                    <input value="{{$data->chiet_khau}}" type="number" name="chiet_khau" class="form-control" id="chiet_khau" placeholder="Nhập chiết khấu">
                  </div> --}}

                  <div class="form-group">
                    <label for="thue_vat">Thuế VAT(%)</label>
                    <input value="{{$data->thue_vat}}" type="number" name="thue_vat" class="form-control" id="thue_vat" placeholder="Nhập thuế VAT">
                  </div>

                  <div class="form-group">
                    <label for="ti_le_thuong_thanh_ly">Tỷ lệ thưởng máy thanh lý</label>
                    <input value="{{$data->ti_le_thuong_thanh_ly}}" type="number" name="ti_le_thuong_thanh_ly" class="form-control" id="ti_le_thuong_thanh_ly" placeholder="Nhập tỉ lệ thưởng">
                  </div>

                  <div class="form-group">
                    <label for="ti_le_thuong_bd">Tỉ lệ thưởng BD (PM) (%)</label>
                    <input value="{{$data->ti_le_thuong_bd}}" type="number" name="ti_le_thuong_bd" class="form-control" id="ti_le_thuong_bd" placeholder="Nhập tỉ lệ thưởng">
                  </div>

                  <div class="form-group">
                    <label for="ti_le_thuong_sale">Tỉ lệ thưởng Sale (Nguồn tự tìm) (%)</label>
                    <input value="{{$data->ti_le_thuong_sale}}" type="number" name="ti_le_thuong_sale" class="form-control" id="ti_le_thuong_sale" placeholder="Nhập tỉ lệ thưởng">
                  </div>

                  <div class="form-group">
                    <label for="ti_le_thuong_sale_nguon_co_san">Tỉ lệ thưởng Sale (Nguồn marketing) (%)</label>
                    <input value="{{$data->ti_le_thuong_sale_nguon_co_san}}" type="number" name="ti_le_thuong_sale_nguon_co_san" class="form-control" id="ti_le_thuong_sale_nguon_co_san" placeholder="Nhập tỉ lệ thưởng">
                  </div>

                  <div class="form-group">
                    <label for="tien_thuong_dich_vu">Tiền thưởng cho đơn dịch vụ</label>
                    <input value="{{$data->tien_thuong_dich_vu}}" type="number" name="tien_thuong_dich_vu" class="form-control" id="tien_thuong_dich_vu" placeholder="Nhập tiền thưởng với đơn dịch vụ">
                  </div>
                 
                  <div class="form-group">
                    <label for="danh_muc_san_pham">Thuộc danh mục</label>
                    <select name="id_loai_san_pham" id="" class="form-control">
                      @foreach($listLoaiSanPham as $loaiSanPham)
                        <option value="{{$loaiSanPham->id}}" {{($data->id_loai_san_pham == $loaiSanPham->id ? 'selected' : '')}}>{{$loaiSanPham->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Mô tả</label>
                    <input value="{{$data->mo_ta}}" type="text" name="mo_ta" class="form-control" id="" placeholder="Nhập mô tả">
                  </div>
                  <div class="form-group">
                    <label for="dong_san_pham">Dòng sản phẩm</label>
                    <input value="{{$data->dong_san_pham}}" type="text" name="dong_san_pham" class="form-control" id="" placeholder="Nhập dòng sản phẩm">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập Nhật</button>

                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</x-dashboard-layout>