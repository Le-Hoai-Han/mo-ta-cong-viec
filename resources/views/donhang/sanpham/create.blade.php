<x-dashboard-layout>

  <div class="main-div">
    <div class="row">
      <div class="col-xs-12">
        <div class="card">
          <div class="card-header pb-0 p-3">
            <div class="row">
              <div class="col-6 d-flex align-items-center">
                <h6 class="mb-0">Thêm sản phẩm</h6>
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
              <form method="POST" action="{{route('danh-muc-san-pham.store')}}">
                @csrf
                <div class="card-header">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mã sản phẩm</label>
                    <input value="{{old('ma_san_pham')}}" type="text" name="ma_san_pham" class="form-control" id="" placeholder="Nhập mã sản phẩm">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                    <input value="{{old('ten_san_pham')}}" type="text" name="ten_san_pham" class="form-control" id="" placeholder="Nhập tên sản phẩm">
                  </div>

                  {{-- <div class="form-group">
                    <label for="exampleInputEmail1">Chiết khấu(%)</label>
                    <input value="" type="number" name="chiet_khau" class="form-control" id="" placeholder="Nhập chiết khấu">
                  </div> --}}

                  <div class="form-group">
                    <label for="exampleInputEmail1">Thuế VAT(%)</label>
                    <input value="{{old('thue_vat',0)}}" type="number" name="thue_vat" class="form-control" id="" placeholder="Nhập thuế VAT">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Tỉ lệ thưởng Sale(%)</label>
                    <input value="{{old('ti_le_thuong_sale',0)}}" type="number" name="ti_le_thuong_sale" class="form-control" id="" placeholder="Nhập tỉ lệ thưởng">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Tỉ lệ thưởng BD(%)</label>
                    <input value="{{old('ti_le_thuong_pd',0)}}" type="number" name="ti_le_thuong_bd" class="form-control" id="" placeholder="Nhập tỉ lệ thưởng">
                  </div>
                  <div class="form-group">
                    <label for="danh_muc_san_pham">Thuộc danh mục</label>
                    <select name="id_loai_san_pham" id="" class="form-control">
                      @foreach($listLoaiSanPham as $loaiSanPham)
                        <option value="{{$loaiSanPham->id}}" >{{$loaiSanPham->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Mô tả</label>
                    <input value="{{old('mo_ta')}}" type="text" name="mo_ta" class="form-control" id="" placeholder="Nhập mô tả">
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