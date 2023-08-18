<x-front-layout>
    @push('styles')
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
        width: 300px;
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
        width: 800px;
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
@endpush
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
        @include('front.vitri.show._thong_tin_nhan_vien',[
            'nhanVien'=>$viTri->user
            ])

        @include('front.vitri.show._mo_ta_vi_tri',[
            'viTri'=>$viTri
            ])

        @include('front.vitri.show._so_do_vi_tri',[
            'viTri'=>$viTri
        ])

    

        
        <div id="xem-them">
            <a class="xem-them-text" onclick="showChiTiet()">Xem thêm...</a>
        </div>
        <div id="show-chi-tiet">
            @include('front.vitri.show._trach_nhiem',[
                'viTri'=>$viTri
            ])

            @include('front.vitri.show._quyen_han',[
                'viTri'=>$viTri
            ])

            @include('front.vitri.show._quan_he',[
                'viTri'=>$viTri
            ])
                
            @include('front.vitri.show._tieu_chi',[
                'viTri'=>$viTri
            ])
                
            
            
    
            
    
            
        </div>
    </div>
    @push('scripts')
    <script>
        function showChiTiet(){
            let showChiTiet = document.getElementById('show-chi-tiet');
            let xemThem = document.getElementById('xem-them');
            console.log(showChiTiet)
            showChiTiet.style.display = "block";
            xemThem.style.display = "none";
        }
    </script>
    @endpush
</x-front-layout>