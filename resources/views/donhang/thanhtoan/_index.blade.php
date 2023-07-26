<x-simple-card extClass="mt-3 " headerClass="bg-info text-white">
    <x-slot name="title">
        <h6 class="text-white">Thanh toán thuộc đơn hàng</h6>
    </x-slot>
    @if(auth()->user()->can('edit_orders'))
    <x-slot name="button">
            <a href="{{route('don-hang.thanh-toan.create',[
                                    'don_hang'=>$donHang
                                ])}}" 
                class="btn btn-warning btn-md align-middle">
                Thêm
            </a>
            <a href="{{route('don-hang.__updateThanhToan',[
                                    'idDonHang'=>$donHang
                                ])}}" 
                class="btn btn-primary btn-md">
                Cập nhật
            </a>
    </x-slot>
    @endif
    <div class="table-responsive">
        <table class="table table-borderless " id="table-chi-tieu">
            <thead class="table-dark">
                <tr>
                    <th class="col-7" style="overflow-x:auto;text-align:center">Ngày</th>
                    <th class="col-2">Số tiền (VNĐ)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $donHang->load('thanhToanThuocDonHang');
                ?>
                @forelse($donHang->thanhToanThuocDonHang as $thanhToan)
                    <tr class="align-middle">
                        <td style="border:none;text-align:center">{{formatNgayDMY($thanhToan->ngay_thanh_toan)}}</td>
                        <td style="border:none;text-align:right">{{thuGonSoLe($thanhToan->so_tien_thanh_toan)}}</td>
                        @if(auth()->user()->can('edit_orders'))
                        <td style="border:none;text-align:center">
                            <a href="{{route('don-hang.thanh-toan.edit',[
                                    'don_hang'=>$donHang,
                                    'thanh_toan'=>$thanhToan
                                ])}}" class=""><span class="material-icons md-18 text-primary">
                                    edit
                                </span></a>
                            <a href="#" class="delete-thanh-toan" delete-att="{{route('don-hang.thanh-toan.destroy',[
                                    'don_hang'=>$donHang,
                                    'thanh_toan'=>$thanhToan
                                ])}}" class="" >
                                <span class="material-icons md-18 text-danger">
                                    delete
                                </span>
                            </a>
                    </td>
                    @endif
                </tr>
                @empty 
                <tr>
                    <th colspan="2">Chưa có thông tin thanh toán</th>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @push('scripts')
    <script defer>
        window.addEventListener('load',()=>{
            let deleteButtonList = document.querySelectorAll('.delete-thanh-toan');
            if(deleteButtonList) {
                deleteButtonList.forEach(button=>{
                    button.addEventListener('click',(e)=>{
                        e.preventDefault();
                        if(confirm('Xóa thông tin thanh toán này?')) {
                            $.ajax({
                                url: button.getAttribute('delete-att'),
                                type: "DELETE",
                                data:{
                                    _token:"{{csrf_token()}}"
                                },
                                success:function(data) {
                                    location.reload();
                                }
                            })
                        }
                    })
                    
                });
            }
        });
    </script>
    @endpush
</x-simple-card>