<div class="card col-xs-12">
    <div class="card-header pb-0 p-3">
        <div class="col-6 d-flex align-items-center">
            <h6 class="mb-0">Thông tin hạng mục</h6>
        </div>
        <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="ten_hang_muc" class="form-control-label">Tên hạng mục</label>
                    <input readonly class="form-control" type="text" value="{{old('ten_hang_muc',$hangMuc->ten_hang_muc)}}" name="ten_hang_muc" id="ten_hang_muc"  onfocus="focused(this)" onfocusout="defocused(this)">
                </div>                            
            </div>                                                     
        </div>     
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="mo_ta" class="form-control-label">Mô tả</label>
                    <textarea readonly class="form-control" type="text" name="mo_ta" id="mo_ta">{{old('mo_ta',$hangMuc->mo_ta)}} </textarea>
                </div>                            
            </div>                                                     
        </div>   
    </div>                              
</div>