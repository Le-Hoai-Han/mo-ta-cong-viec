<x-dashboard-layout>

  <div class="main-div">
    <div class="row">
      <div class="col-xs-12">
        <div class="card">
          <div class="card-header pb-0 p-3">
            <div class="row">
              <div class="col-6 d-flex align-items-center">
                <h6 class="mb-0">Cập nhật sản phẩm thuộc đơn hàng</h6>
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
              <form method="post" action="{{route('sanphamthuocdonhang.update',$sanPham)}}">
                @csrf
                @method('PUT')
                <div class="card-header">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Id</label>
                    <input type="text" value="{{$sanPham->id}}" disabled name="" class="form-control" id="" placeholder="">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Mã sản phẩm</label>
                    <input value="{{$sanPham->danhMucSanPham->ma_san_pham}}" disabled type="text" name="ma_san_pham" class="form-control" id="" placeholder="">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                    <input value="<?php echo ucfirst($sanPham->danhMucSanPham->ten_san_pham) ?>" disabled type="text" name="ten_san_pham" class="form-control" id="" placeholder="">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                    <input value="{{$sanPham->gia_san_pham}}" type="number" name="gia_san_pham" class="form-control" id="" placeholder="">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Chiết khấu(VNĐ)</label>
                    <input value="{{$sanPham->chiet_khau}}" type="number" name="chiet_khau" class="form-control" id="" placeholder="Nhập chiết khấu">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Giá bán</label>
                    <input value="{{$sanPham->gia_ban}}" type="number" name="gia_ban" class="form-control" id="" placeholder="">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Thuế VAT(VNĐ)</label>
                    <input value="{{$sanPham->thue_vat}}" type="number" name="thue_vat" class="form-control" id="" placeholder="Nhập thuế VAT">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Tỉ lệ thưởng</label>
                    <input value="{{$sanPham->ti_le_thuong}}" type="number" name="ti_le_thuong" class="form-control" id="" placeholder="Nhập tỉ lệ thưởng">
                    </div>

                 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Chi phí phát sinh </label>
                    <input value="{{$sanPham->chi_phi_phat_sinh}}" type="number" name="chi_phi_phat_sinh" class="form-control" id="chi_phi_phat_sinh" placeholder="Nhập chi phí phát sinh">
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