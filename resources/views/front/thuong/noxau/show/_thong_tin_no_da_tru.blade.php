<x-simple-card buttonCol="7" labelCol="5" extClass="mt-3" headerClass="bg-success text-white "> 
<x-slot name="title"><h6 class="text-white">
        Thông tin khoản nợ đã thanh toán (đã trừ)
    </h6></x-slot>
    @can('add_noxaus')
    <x-slot name="button">
        <x-link-them-moi :route="route('no-xau.da-tru.create',['noXau'=>$noXau])" label="Thêm mới"/>
    </x-slot>
    @endcan
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Ngày thanh toán</th>
                    <th>Số tiền đã trừ</th>
                    <th>Thưởng liên quan</th>
                    <th>Hành động</th>
                </tr>
                @forelse($noXau->noXauDaTru as $index=>$noXauDaTru)
                <tr>
                    <th>{{$index+1}}</th>
                    <td>{{formatNgayDMY($noXauDaTru->ngay_tru_no)}}</td>
                    <td>{{thuGonSoLe($noXauDaTru->so_tien)}}đ</td>
                    <td>{!!$noXauDaTru->createThuongThoiGianLink()!!}</td>
                    <td>                        
                        <x-link-cap-nhat label="" :route="route('no-xau.chi-tiet.edit',['chiTietNoXauDaTru'=>$noXauDaTru])" />
                        <x-link-xoa label="" :route="route('no-xau.chi-tiet.destroy',['chiTietNoXauDaTru'=>$noXauDaTru])" />
                    </td>
                </tr>
                @empty 
                <tr>
                    <th>Chưa có thông tin thanh toán nào</th>
                </tr>
                @endforelse
            </thead>
        </table>
    </div>
</x-simple-card>


@push('scripts')


<script type="text/javascript" async>

    
    let deleteChiTietNoXauUrl = '';
    
    function setDeleteUrl(url) {

        if(confirm('Xóa thong tin thanh toán này?')) {
            deleteChiTietNoXauUrl = url;
            deleteRow();
        } 
        return false;
        
        // $("#deleteModal").modal('show');
    }

    function deleteRow() {
        $.ajax({
            url: deleteChiTietNoXauUrl,
            type:'POST',
            data:{
                "_token": "{{ csrf_token() }}",
                "_method": "DELETE"
            },
            success:function(res) {
                // console.log('ok');
                // $("#deleteModal").modal('hide');
                deleteNhanVienUrl = '';
                location.reload();                    
            }
        });
    }

    
    
    </script>

@endpush