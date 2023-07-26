<x-dashboard-layout>

  <div class="main-div">
    <div class="row">
      <div class="col-xs-12">
        <div class="card">
          <div class="card-header pb-0 p-3">
            <div class="row">
              <div class="col-6 d-flex align-items-center">
                <h6 class="mb-0">Cập nhật đơn hàng</h6>
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
              <form method="post" action="{{route('don-hang.update',['don_hang'=>$data])}}">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Id</label>
                      <input type="text" value="{{$data->id}}" disabled name="" class="form-control" id="" placeholder="">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Mã đơn hàng</label>
                      <input value="{{$data->ma_don_hang}}" disabled type="text" name="ma_san_pham" class="form-control" id="" placeholder="">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Tên người tạo</label>
                    <input value="{{$data->ten_nguoi_tao}}" disabled type="text" name="ten_san_pham" class="form-control" id="" placeholder="">
                  </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Doanh số</label>
                    <input value="{{$data->doanh_so}}" type="number" name="doanh_so" class="form-control" id="" placeholder="Nhập doanh số">
                  </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Doanh thu</label>
                    <input value="{{$data->doanh_thu}}" type="number" name="doanh_thu" class="form-control" id="" placeholder="Nhập doanh thu">
                  </div>

                

                  <div class="form-group">
                    <label for="exampleInputEmail1">Ngày bắt đầu tính thời hạn</label>
                    <input value="{{old('ngay_bat_dau_tinh_thoi_han',$data->ngay_bat_dau_tinh_thoi_han)}}" type="date" name="ngay_bat_dau_tinh_thoi_han" class="form-control" id="" placeholder="">
                  </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Lý do thay đổi</label>
                    <input value="" type="text" name="ly_do_cap_nhat" class="form-control" id="" placeholder="Nhập lý do">
                  </div>

                  @if(auth()->user()->hasRole('admin'))
                  <input name="trang_thai" id="" class="form-control" />

                
                  @endif


                  <!-- <div class="form-group">
        <label for="exampleInputEmail1">Đã thanh toán</label>
        <select name="da_thanh_toan" id="" class="form-control">
          @if(($data->da_thanh_toan) == old('da_thanh_toan',0))
          <option selected value="0">Chưa thanh toán</option>
          @else
          <option value="1">Đã thanh toán</option>
          @endif
        </select>
        </div> -->


                  <!-- <div class="form-group">
        <label for="exampleInputEmail1">Trạng thái</label>
        
        <select name="trang_thai" id="" class="form-control">
         
          @if(($data->trang_thai) == old('trang_thai',$data->TenTrangThai))
          <option selected value="{{$data->trang_thai}}">$data->TenTrangThai</option>
          @else
          <option value="{{$data->trang_thai}}">{{$data->TenTrangThai}}</option>
          @endif
          
        </select>
        </div> -->

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập Nhật</button>
                  <a href="{{route('don-hang.show',['don_hang'=>$data])}}" class="btn btn-secondary">Hủy</a>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



</x-dashboard-layout>