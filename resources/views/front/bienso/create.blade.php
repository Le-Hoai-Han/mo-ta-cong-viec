<?php
$current="Thêm biến số";
$list=[
    url('/bien-so') =>"Biến số"
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="main-div">
        <div class="row">
            <div class="col-xs-12">
                <form name="thembienso" action="{{route('bien-so.store')}}" method="post">
                    @csrf
                    <div class="card col-12 col-md-8">

                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Thêm biến số </h6>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="submit" class="btn btn-primary btn-md mb-0">Lưu thông tin</button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="ten_bien" class="form-comtrol-label">Tên biến số</label>
                                        <input type="text" class="form-control" name="ten_bien" id="ten_bien" placeholder="Nhập tên biến số" onfocus="focused(this)" onfocusout="defocused(this)"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="gia_tri" class="form-comtrol-label">Giá trị</label>
                                        <input type="number" class="form-control" name="gia_tri" id="gia_tri" placeholder="Nhập giá trị biến số" onfocus="focused(this)" onfocusout="defocused(this)"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="kieu_du_lieu" class="form-comtrol-label">Kiểu dữ liệu</label>
                                        <input type="text" class="form-control" name="kieu_du_lieu" id="kieu_du_lieu" placeholder="Nhập kiểu dữ liệu" onfocus="focused(this)" onfocusout="defocused(this)"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="mo_ta" class="form-comtrol-label">Mô tả</label>
                                        <input type="text" class="form-control" name="mo_ta" id="mo_ta" placeholder="Nhập mô tả" onfocus="focused(this)" onfocusout="defocused(this)"/>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

</x-dashboard-layout>