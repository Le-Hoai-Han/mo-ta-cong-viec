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
    }
    .container{
        margin: 0px auto;
        max-width: 1000px;
        width: 1000px;
        display: flex;
        justify-content: center;
        flex-direction: column;
        font-size: 20px;
        margin: 20px auto;
    }
    .mo-ta-nhiem-vu{

    }
    .nhiem-vu{
        border: solid 2px #000;
        min-height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .ten-nhiem-vu{
        text-align: center;
    }
    .nhiem-vu-cu-the{
        margin: 30px 0px;
    }
    
    .tieu-de-nhiem-vu-cu-the{
        margin: 15px 0px;
    }
    .item-nhiem-vu-cu-the{
        margin: 5px 0px;
    }
    
</style>
<body>
    <div class="container">
        <div class="mo-ta-nhiem-vu">
           <div class="nhiem-vu">
            <p class="ten-nhiem-vu">
                <b>{{$nhiemVu->ten_nhiem_vu}}</b>
            </p>
           </div>
           <div class="nhiem-vu-cu-the">
            <h4 class="tieu-de-nhiem-vu-cu-the">Nhiệm vụ chính</h4>
            <?php $i = 1; ?>
            @foreach($nhiemVu->moTaNhiemVu as $moTa)
                <p class="item-nhiem-vu-cu-the">{{$i++ }}.  {{$moTa->chi_tiet}}</p>
            @endforeach
           </div>
        </div>
    </div>
</body>
</html>