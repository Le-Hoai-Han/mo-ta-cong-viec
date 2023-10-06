<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box
    }
    body{
        font-family: Arial, Helvetica, sans-serif;
        margin: 0 auto;
        background-color: #ccc;
    }
    .container{
        margin: 0px auto;
        max-width: 1080px;
        width: 1080px;
        display: flex;
        justify-content: center;
        flex-direction: column;
        font-size: 20px;
        background-color: #fff;
        padding: 0px 40px;
    }
    table,tr, td,th{
        border: 1px solid black;
        border-collapse: collapse;
       
    }
    table{
        max-width: 1000px;
        width: 1000px;
        margin: 20px 0px;
    }
    td,th{
        width: 200px;
        min-width: 200px;
        padding: 5px;
    }
    .table-childrent{
        width: 100%;
    }

    .img-profile{
        max-height: 300px;
        height: auto;
    }
    .text-thong-tin{
        margin: 5px 0px;
        font-size: 18px;
    }
   
    .so-do-to-chuc{
        text-align: center;
        /* display: flex;
        flex-direction: column;
       gap: 20px; */
       
    }
    .so-do-to-chuc_tieu_de{
     margin-top: 50px;
    }
    .cap_tren_truc_tiep{
        border: solid 2px #000;
        width: 400px;
        height: 100px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0px 20px 0px; 
        position: relative;
        z-index: 2;
      
    }
    .so_do{
        position: relative;
    }
    .so_do::before{
        content: "";
    position: absolute;
    width: 3px;
    background-color: #000;
    /* opacity: 0.4; */
    top: 100px;
    bottom: 100px;
    left: 50%;
    z-index: 1;
    }
    .vi_tri_can_mo_ta{
        width: 800px;
        height: 60px;
        border: solid 2px #000;
        display:inline-flex;
        align-items: center;
        justify-content: center; 
        margin: 20px 0px; 
        border-radius: 50%;
        position: relative;
        z-index: 2;
        background-color: #fff;
    }
    .vi_tri_can_mo_ta_text{
        color: #000;
        text-decoration: none;
        
    }
   

    .trach-nhiem{
        width: 400px;
        min-height: 100px;
        border: solid 2px #000;
        display:inline-flex;
        align-items:baseline;
       text-align:left; 
        flex-direction: column;
        justify-content: left;
        margin: 20px 0px; 
        padding:10px 10px;
        position: relative;
        z-index: 2;
        background-color: #fff;
       
    }
    .trach-nhiem-text{
        text-decoration: none;
        color: #000;
    }
    .trach-nhiem-text:hover{
        color: #b81717 ;
        font-weight: bold;
    }
    #xem-them{
        text-align: center;
        margin: 20px 0px;
    }
    .xem-them-text{
        cursor: pointer;
    }
    .xem-them-text:hover{
        color: #b81717;
    }
    #show-chi-tiet{
        display: none;
        margin: 50px 0px;
    }
    .list-nhiem-vu,.list-quan-he, .list-tham-quyen{
        padding-left: 40px;
        min-height: 100px;
    }
    .list-nhiem-vu li,.list-tham-quyen li,.list-quan-he li{
        margin: 5px 0px;
        font-size: 16px;
    }
    .tieu-chuan-tuyen-chon td {
        font-size: 16px;
    }
    
</style>
<body>
    <div class="container">
        <table>
            <tr>
                <td style="width: 10%;text-align: center"></td>
                <td style="width: 50%;">
                    <h2><center>MÔ TẢ CÔNG VIỆC</center></h2>
                </td>
                <td>
                    <table class="table-childrent">
                        <tr>
                            <td>Ngày ban hành</td>
                        </tr>
                        <tr>
                            <td>Lần ban hành</td>
                        </tr>
                        <tr>
                            <td>Số trang</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td style="width: 10%;"><img src="{{asset('storage/'. $viTri->user->profile_photo_path)}}" alt="" height="300px" class="img-profile"></td>
                <td style="vertical-align: top;">
                    <p class="text-thong-tin"> Họ và tên: {{$viTri->user->name}}</p>
                    <p class="text-thong-tin"> Số điện thoại: {{$viTri->user->sdt}}</p>
                </td>
            </tr>
           
        </table>

        <table>
            <tr>
                <td colspan="2"><b>1. Mô tả chung về chức danh/vị trí công việc</b></td>
            </tr>
            <tr>
                <td><p>Chức danh công việc</p></td>
                <td>{{$viTri->ten_vi_tri}}</td>
            </tr>
            <tr>
                <td class="">
                    <p>Phòng ban</p>
                </td>
                <td>{{$viTri->phong_ban}}</td>
               
            </tr>
            <tr>
                <td class="">
                    <p>Cấp quản lý trực tiếp</p>
                </td>
                <td>{{$viTri->capQuanly->ten_vi_tri}}</td>
            </tr>
            <tr>
                <td class="">
                    <p>Nơi làm việc</p>
                </td>
                <td>
                    <p>{{$viTri->noi_lam_viec}}</p>
                </td>
            </tr>
            <tr>
                <td colspan=""><b>2. Mục đích công việc vị trí</b></td>
                <td>
                    <p>{{$viTri->muc_dich}}</p>
                </td>
            </tr>
        </table>

        <div class="so-do-to-chuc">
            <p style="text-align: left" class="so-do-to-chuc_tieu_de"><b>3. Sơ đồ tổ chức</b></p>
            <div class="so_do">
                <div class="cap_tren_truc_tiep">
                    <h3>{{$viTri->capQuanly->user->name}}</h3>
                </div>
    
                <div class="vi_tri_can_mo_ta">
                    <h4><a class="vi_tri_can_mo_ta_text">{{$viTri->ten_vi_tri}}</a></h4>
                </div>
    
                <div class="trach-nhiem">
                    @foreach($viTri->nhiemVu as $nhiemVu)
                        <a class="trach-nhiem-text" href="{{route('nhiem-vu.show',$nhiemVu)}}">- {{$nhiemVu->ten_nhiem_vu}}</a>
                    @endforeach
                </div>

            </div>
        </div>
       
        <div id="">
            <div class="">
                <p style="text-align: left" class="so-do-to-chuc_tieu_de"><b>4. Các trách nhiệm và nhiệm vụ chính</b></p>
                <div class="trach-nhiem-nhiem-vu">
                   <table>
                    <thead>
                        <tr>
                            <th>Trách nhiệm và nhiệm vụ chính</th>
                            <th>Kết quả đầu ra</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($viTri->nhiemVu as $nhiemVu)
                            <tr>
                                <td>
                                    <p style="font-size: 18px"> <b>Trách nhiệm thứ {{$i++}}. {{$nhiemVu->ten_nhiem_vu}}</b></p>
                                    <ul class="list-nhiem-vu">
                                        @foreach($nhiemVu->moTaNhiemVu as $moTa)
                                            <li>{{$moTa->chi_tiet}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                   </table>
                </div>
    
             
            </div>
    
            <div class="tham-quyen">
                <p style="text-align: left" class="so-do-to-chuc_tieu_de"><b>5. Thẩm quyền/Quyền hạn</b></p>
                   <table>
                    <thead>
                        <tr>
                            <th>Đề xuất</th>
                            <th>Ra quyết định</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>
                                    <ul class="list-tham-quyen">
                                        @foreach($viTri->thamQuyen->where('loai',1) as $thamQuyen)
                                            <li>{{$thamQuyen->noi_dung}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <ul class="list-tham-quyen">
                                        @foreach($viTri->thamQuyen->where('loai',2) as $thamQuyen)
                                            <li>{{$thamQuyen->noi_dung}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                    </tbody>
                   </table>
            </div>
    
            <div class="quan-he">
                <p style="text-align: left" class="so-do-to-chuc_tieu_de"><b>6. Quan hệ công việc</b></p>
                   <table>
                    <thead>
                        <tr>
                            <th>Bên trong công ty</th>
                            <th>Bên ngoài công ty</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>
                                    <ul class="list-quan-he">
                                        @foreach($viTri->quanHe->where('loai',0) as $quanHe)
                                            <li>{{$quanHe->noi_dung}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <ul class="list-quan-he">
                                        @foreach($viTri->quanHe->where('loai',1) as $quanHe)
                                            <li>{{$quanHe->noi_dung}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                    </tbody>
                   </table>
            </div>
    
            <div class="tieu-chuan-tuyen-chon">
                <p style="text-align: left" class="so-do-to-chuc_tieu_de"><b>7. Tiêu chuẩn tuyển chọn</b></p>
                   <table>
                    <thead>
                        <tr>
                            <th>Tiêu chí</th>
                            <th>Yêu cầu</th>
                        </tr>
                    </thead>
                    <tbody>
    
                        @foreach($viTri->tieuChuan as $tieuChi)
                            <tr>
                                <td>Giới tính</td>
                                <td> <p>{{$tieuChi->gioi_tinh == 0? 'Nam' :'Nữ'}}</p></td>
                            </tr>
                            <tr>
                                <td>Độ tuổi</td>
                                <td><p>{{$tieuChi->tuoi}}</p></td>
                            </tr>
                            <tr>
                                <td>Học vấn</td>
                                <td> <p>{{$tieuChi->hoc_van}}</p></td>
                            </tr>
                            <tr>
                                <td>Chuyên môn</td>
                                <td><p>{{$tieuChi->chuyen_mon}}</p></td>
                            </tr>
                            <tr>
                                <td>Vi tính</td>
                                <td> <p>{{$tieuChi->vi_tinh}}</p></td>
                            </tr>
                            <tr>
                                <td>Anh ngữ</td>
                                <td><p>{{$tieuChi->anh_ngu}}</p></td>
                            </tr>
                            <tr>
                                <td>Kinh nghiệm</td>
                                <td><p>{{$tieuChi->kinh_nghiem}}</p></td>
                            </tr>
                            <tr>
                                <td>Kỹ năng cần có</td>
                                <td>  <p>{{$tieuChi->ky_nang}}</p></td>
                            </tr>
                            <tr>
                                <td>Thái độ/tố chất cần có</td>
                                <td>   <p>{{$tieuChi->to_chat}}</p></td>
                            </tr>
                            <tr>
                                <td>Ngoại hình</td>
                                <td><p>{{$tieuChi->ngoai_hinh}}</p></td>
                            </tr>
                            <tr>
                                <td>Sức khỏe</td>
                                <td> <p>{{$tieuChi->suc_khoe}}</p></td>
                            </tr>
                            <tr>
                                <td>Hộ khẩu thường trú</td>
                                <td> <p>{{$tieuChi->ho_khau}}</p></td>
                            </tr>
                            <tr>
                                <td>Ưu tiên</td>
                                <td><p>{{$tieuChi->uu_tien}}</p></td>
                            </tr>
                            <tr>
                                <td>Khác</td>
                                <td><p>{{$tieuChi->khac}}</p></td>
                            </tr>
                        @endforeach
                    </tbody>
                   </table>
            </div>
        </div>
    </div>
    <script>
        
    </script>
</body>
</html>