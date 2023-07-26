

<div class="row mt-3">

    <div class="col-md-4">
        <x-card-small title="Doanh thu" desc="Tất cả đơn hàng" icon="dollar-sign" number="{{thuGonSoLe($tongDoanhThu)}}đ" colorClass='success' />    
    </div>
    <div class="col-md-4">
        <x-card-small title="Số đơn hàng" desc="Đơn hàng đã bán" icon="archive" number="{{$tongSoDonHang}}" colorClass='info' />    
    </div>
    <div class="col-md-4">
        <x-card-small title="Nợ xấu" desc="Tổng nợ xấu còn lại" icon="money-check-alt" number="{{thuGonSoLe($tongNoXau)}}đ" colorClass='danger' />    
    </div>
</div>

