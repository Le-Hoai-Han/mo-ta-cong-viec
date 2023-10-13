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
        border: solid 1px #ccc;
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
        /* max-height: 185px; */
        height: 185px;
        width: 185px;
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
     display: flex;
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
    .list-nhiem-vu{
        margin-bottom: 0px;
    }
    
    .list-nhiem-vu,.list-quan-he, .list-tham-quyen{
        padding-left: 35px;
    }
    .list-nhiem-vu li,.list-tham-quyen li,.list-quan-he li{
        margin: 5px 0px;
        font-size: 16px;
        text-align: justify;
        padding-right: 5px;
    }
    .tieu-chuan-tuyen-chon td {
        font-size: 16px;
    }
    /*  */
    
    body {font-family: Arial, Helvetica, sans-serif;}
    
    /* The Modal (background) */
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 5; /* Sit on top */
      padding-top: 100px; /* Location of the box */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }
    
    /* Modal Content */
    .modal-content {
      background-color: #fefefe;
      margin: auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
    }
    
    /* The Close Button */
    .close {
      color: #aaaaaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }
    
    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }

    .show{
        display: block !important;
    }

    #thong-bao-trang-thai{
        position: fixed;
        top: 15%;
        left: 70%;
        /* width: 100%; */
        height: 70px;
        color: white;
        text-align: center;
        background: rgba(40, 159, 4, 0.6);
        overflow: hidden;
        box-sizing: border-box;
        transition: height .2s;
        z-index: 9999;
    }
    .border-top-bottom-none{
        border-top: #000 solid 1px;
        border-bottom:  #ff000000 solid 1px;
    }
    .border-bottom-none{
        border-bottom:  #ff000000 solid 1px;
    }
    .tbody_mo_ta > tr:nth-last-child(2) >.border-bottom-none,
    .tbody_mo_ta:last-child >tr  >.border-bottom-none{
        border-bottom:  #000 solid 1px;
    }
   

    </style>
@endpush
<div class="container">
    <div id='thong-bao-trang-thai' class="alert" style="display: none">

    </div>
        <table style="border: none">
            <tr style="border: none">
                <td style="width: 50%;border: none">
                    <h2><center>{{$viTri->ten_vi_tri}}</center></h2>
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

    
        <div id="">
            @include('front.vitri.show._trach_nhiem',[
                'viTri'=>$viTri,
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
</x-front-layout>