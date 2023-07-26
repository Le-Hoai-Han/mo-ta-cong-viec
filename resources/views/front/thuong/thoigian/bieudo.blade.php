<x-simple-card extClass="mt-3" headerClass="bg-info text-white ">
    
    <x-slot name="title"><h6 class="text-white">Biểu đồ theo chỉ tiêu</h6></x-slot>
    <select id="chon_chi_tieu_chart" class="form-select">

        @foreach($dsChiTieu as $chiTieuCaNhan) 
            <option value="{{$chiTieuCaNhan->id_chi_tieu}}" >{{$chiTieuCaNhan->chiTieu->ten_chi_tieu}}</option>
        @endforeach
    </select>
    <div class="mt-3">
        <x-base-chart id="chi-tieu-chart">

            <script defer>
                const drawLineChart = (labelList,dataMucTieu,dataKetQua) => {
                    const ctx = document.getElementById('chi-tieu-chart');
                    //xoa chart dang co
                    let chart = Chart.getChart(ctx, 0);
                    if(chart) {
                        chart.destroy();
                    }
                    //tao chart moi
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labelList,
                            datasets: [{
                                    label: 'Kết quả',
                                    data: dataKetQua,
                                    borderWidth: 4,
                                    pointStyle: 'circle',
                                    pointRadius: 5,
                                    pointHoverRadius: 7
                                },
                                {
                                    label: 'Mục tiêu',
                                    data: dataMucTieu,
                                    borderWidth: 4,
                                    pointStyle: 'circle',
                                    pointRadius: 5,
                                    pointHoverRadius: 7
                                }
                            ]
                        },
                        options: {
                        scales: {
                            y: {
                            beginAtZero: true
                            }
                        }
                        }
                    });
                }


                

                const getDatasetForChart = (thangBatDau, thangKetThuc, nam, idNhanVien, idChiTieu, token, url) => {
                    $.ajax({
                        url: url,
                        type:'post',
                        dataType:'json',
                        data:{
                            thang_bat_dau: thangBatDau,
                            thang_ket_thuc: thangKetThuc,
                            nam: nam,
                            id_nhan_vien: idNhanVien,
                            id_chi_tieu: idChiTieu,
                            _token: token
                        },
                        success:function(response) {
                            console.log(response);
                            drawLineChart(response.labelList,response.dataMucTieu,response.dataKetQua);
                        }
                    });
                }
                const chiTieuChartSelect = document.querySelector('#chon_chi_tieu_chart');
                chiTieuChartSelect.addEventListener('change',(e)=>{
                        console.log(e.target.value);
                        getDatasetForChart({{$thuongKhoangThoiGian->thang_bat_dau}},{{$thuongKhoangThoiGian->thang_ket_thuc}},{{$thuongKhoangThoiGian->nam}},{{$thuongKhoangThoiGian->id_nhan_vien}},e.target.value,"{{csrf_token()}}","{{route('chi-tieu.tao-dataset')}}");
                });
                window.onload = ()=>{
                    getDatasetForChart({{$thuongKhoangThoiGian->thang_bat_dau}},{{$thuongKhoangThoiGian->thang_ket_thuc}},{{$thuongKhoangThoiGian->nam}},{{$thuongKhoangThoiGian->id_nhan_vien}},chiTieuChartSelect.value,"{{csrf_token()}}","{{route('chi-tieu.tao-dataset')}}");
                };
                
            </script>
        </x-base-chart>
    </div>
</x-simple-card>

                