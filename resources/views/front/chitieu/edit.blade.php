<x-dashboard-layout>
@if ($errors->any())
  <div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <p style="font-size:12px">{{ $error }}</p>
    @endforeach
  </div>
  @endif
  <div class="main-div">
    <div class="row " >
      <div class="col-xs-12">
        <form method="post" action="{{route('chi-tieu.update',$chiTieu)}}">
          @csrf
          @method('PUT')
            <div class="card col-12 col-md-8">
              <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0">Cập nhật chỉ tiêu</h6>
                    </div>
                    <div class="col-6 text-end">
                        <button type="submit" class="btn btn-primary btn-md mb-0">Cập nhật</button>
                    
                    </div>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <label for="exampleInputEmail1">ID Chỉ tiêu</label>
                    <input type="text" value="{{$chiTieu->id}}" disabled name="" class="form-control" id="" placeholder="">
                  </div>

                  <div class="col-12 col-md-6">
                    <label for="ten_chi_tieu">Tên chỉ tiêu</label>
                    <input value="{{$chiTieu->ten_chi_tieu}}"  type="text" name="ten_chi_tieu" class="form-control" id="ten_chi_tieu" placeholder="">
                    @error('ten_chi_tieu')
                        <span class="help text-danger"> {{ $message}}</span>
                    @enderror
                  </div>

                  <div class="col-12 col-md-6">
                      <label class="label" for="id_nhom_nhan_vien">
                          Áp dụng cho nhóm
                      </label>
                      <select class="form-control" name="id_nhom_nhan_vien" id="id_nhom_nhan_vien">
                          <option value=""></option>
                          @foreach($dsNhomNhanVien as $nhomNhanVien)
                              <?php 
                                  if($nhomNhanVien->id === $chiTieu->id_nhom_nhan_vien) {
                                      $selected = "selected";
                                  } else {
                                      $selected = "";
                                  }
                              ?>

                              <option {{$selected}} value="{{$nhomNhanVien->id}}">{{$nhomNhanVien->ten_nhom}}</option>
                          @endforeach

                        
                      </select>
                      @error('id_nhom_nhan_vien')
                          <span class="help text-red-500"> {{ $message}}</span>
                      @enderror
                  </div>

                  <div class="col-12 col-md-6">
                    <label for="loai_chi_tieu">Loại chỉ tiêu</label>
                    <input value="{{$chiTieu->loai_chi_tieu}}" type="text" name="loai_chi_tieu" class="form-control" id="loai_chi_tieu" placeholder="">
                    @error('loai_chi_tieu')
                        <span class="help text-danger"> {{ $message}}</span>
                    @enderror
                  </div>

                  <div class="col-12 col-md-6">
                    <label for="muc_tieu_mac_dinh">Mục tiêu mặc định</label>
                    <input  type="text" name="muc_tieu_mac_dinh" class="form-control" id="muc_tieu_mac_dinh" placeholder="" value="{{thuGonSoLe($chiTieu->muc_tieu_mac_dinh)}}">
                    @error('muc_tieu_mac_dinh')
                        <span class="help text-danger"> {{ $message}}</span>
                    @enderror
                  </div>

                  <div class="col-12 col-md-6">
                    <label for="chieu_huong_tot">Chiều hướng tốt</label>

                    <div class="form-check">
                      <label for="chieu_huong_tot_radio_1" class="custom-control-label" >Tăng</label>
                      <input type="radio" class="form-check-input" id="chieu_huong_tot_radio_1" name="chieu_huong_tot" value="1" {{($chiTieu->chieu_huong_tot==$chiTieu::CHIEU_HUONG_TOT_TANG)?" checked ":""}}>
                    </div>
                    <div class="form-check">  
                        <label for="chieu_huong_tot_radio_0" class="custom-control-label">Giảm</label>
                        <input type="radio" id="chieu_huong_tot_radio_0" class="form-check-input" name="chieu_huong_tot" value="0" {{($chiTieu->chieu_huong_tot==$chiTieu::CHIEU_HUONG_TOT_GIAM)?" checked ":""}}>
                    </div>
                    @error('chieu_huong_tot')
                        <span class="help text-danger"> {{ $message}}</span>
                    @enderror
                  </div>

                  <div class="col-12">
                    <label for="mo_ta" class="form-control-label">Mô tả</label>
                    <textarea name="mo_ta"  class="form-control" rows="5">{{$chiTieu->mo_ta}}</textarea>
                  </div> 

                  <div class="col-12">
                    <label for="thu_tu_sap_xep" class="custom-control-label">Thứ tự sắp xếp</label>
                        <input type="text" id="thu_tu_sap_xep" class="form-control" name="thu_tu_sap_xep" value="{{$chiTieu->thu_tu_sap_xep}}" />
                  </div> 
                </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@push('styles')
    <link rel="stylesheet" href="{{asset('css/slimselect.min.css')}}">
    <style>
    .ss-main .ss-multi-selected,
    .ss-main .ss-single-selected{
        min-height:38px;
        padding:0.2rem 0.3rem
    }
    .ss-main{
        padding:0;
    }
    </style>
@endpush

@push('scripts')
    <script src="{{asset('js/slimselect.min.js')}}"></script>
    <script type="text/javascript">
        new SlimSelect({
            select: '#nhan_vien'
        })
        new SlimSelect({
            select: '#thang_su_dung'
        })
        
    </script>
@endpush

</x-dashboard-layout>