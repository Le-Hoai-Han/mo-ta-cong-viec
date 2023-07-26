<x-simple-card extClass="mt-3" headerClass="bg-dark text-white"> 
    <x-slot name="title"><h6 class="text-white">Thêm thông tin</h6></x-slot>
    <x-slot name="button">
        <button class="btn btn-success mb-2">{{$buttonLabel}}</button>
    </x-slot>
    @csrf
    <div class="row">
        <div class="form-group col-12">
            <label for="mo_ta">Mô tả</label>
            <input type="text" id="mo_ta" name="mo_ta" class="form-control" value="{{old('mo_ta',$soTienThuongKyThuat->mo_ta)}}" />
            @error('mo_ta')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group col-12 col-md-4">
            <label for="tien_thuong_co_ban">Tiền thưởng cơ bản</label>
            <input type="text" id="tien_thuong_co_ban" name="tien_thuong_co_ban" class="form-control" value="{{old('tien_thuong_co_ban',$soTienThuongKyThuat->tien_thuong_co_ban)}}" />
            @error('tien_thuong_co_ban')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group col-12 col-md-4">
            <label for="tien_thuong_vuot_muc">Tiền thưởng  vượt mức</label>
            <input type="text" id="tien_thuong_vuot_muc" name="tien_thuong_vuot_muc" class="form-control" value="{{old('tien_thuong_vuot_muc',$soTienThuongKyThuat->tien_thuong_vuot_muc)}}" />
            @error('tien_thuong_vuot_muc')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group col-12 col-md-4">
            <label for="so_luong_gioi_han">Số lượng giới hạn</label>
            <input type="text" id="so_luong_gioi_han" name="so_luong_gioi_han" class="form-control" value="{{old('so_luong_gioi_han',$soTienThuongKyThuat->so_luong_gioi_han)}}" />
            @error('so_luong_gioi_han')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group col-12 col-md-4">
            <label for="phien_ban">Phiên bản</label>
            <input type="text" id="phien_ban" name="phien_ban" class="form-control" value="{{old('phien_ban',$soTienThuongKyThuat->phien_ban)}}" />
            @error('phien_ban')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group col-12 col-md-4">
            <label for="id_phien_ban_cu">Phiên bản cũ</label>
            <select name="id_phien_ban_cu" class="form-select">
                <option value=""></option>
                @foreach($dsPhienBanCu as $phienBanCu) 
                    <option value="{{$phienBanCu->id}}" {{($phienBanCu->id == $soTienThuongKyThuat->id_phien_ban_cu)?"selected":""}}>{{$phienBanCu->mo_ta}} - {{$phienBanCu->phien_ban}}</option>
                @endforeach 
            </select>
            @error('id_phien_ban_cu')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group col-12 col-md-4">
            <label for="dang_su_dung">Trạng thái</label>
            <select name="dang_su_dung" class="form-select">                
                <option value="{{$soTienThuongKyThuat::TT_DANG_SU_DUNG}}" {{($soTienThuongKyThuat->dang_su_dung == $soTienThuongKyThuat::TT_DANG_SU_DUNG)?"selected":""}}>Đang sử dụng</option>
                <option value="{{$soTienThuongKyThuat::TT_NGUNG_SU_DUNG}}" {{($soTienThuongKyThuat->dang_su_dung == $soTienThuongKyThuat::TT_NGUNG_SU_DUNG)?"selected":""}}>Không sử dụng</option>
            </select>            
            @error('dang_su_dung')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
</x-simple-card>