<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <title> Sơ đồ tổ chức </title>
    <link rel="stylesheet" href="{{asset('treant-js-master/Treant.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('treant-js-master/examples/connectors/connectors.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('treant-js-master/examples/connectors/connectors.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <link rel="stylesheet" href="../../perfect-scrollbar/perfect-scrollbar.css"> --}}
    
</head>
<body>
    <div class="chart" id="OrganiseChart-big-commpany"></div>
    <script src="{{asset('treant-js-master/vendor/raphael.js')}}"></script>
    <script src="{{asset('treant-js-master/Treant.js')}}"></script>
    
    {{-- <script src="{{asset('treant-js-master/examples/basic-example/basic-example.js')}}"></script> --}}

   <script>
     
        $(document).ready(function() {
            $.ajax({
                url: '{{route('vi-tri.getData3')}}', // Đường dẫn đến phương thức trong controller
                type: 'GET',
                dataType: 'json',
                success: function(data) {console.log(data);
                    var chart_config = data;
                    new Treant( chart_config );
                    let viTri = document.getElementsByClassName("big-commpany");
                    for (let i = 0; i < viTri.length; i++) {
                    let element = viTri[i];
                    // element.classList.add(element.id);
                    element.addEventListener("click", function(){
                        handleClick(element.id)
                    });
                }
                },
                error: function() {
                    console.log('Lỗi khi lấy dữ liệu từ controller.');
                }
            });
        });

       function handleClick(event){
        let id =  event.replace("nhan-vien-", "");
        let routeURL = "/front-vi-tri/" + id;
        window.open(routeURL,'_blank');

       }

   
        
        
    </script>
    
</body>
</html>