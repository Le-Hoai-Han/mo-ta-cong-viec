<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta property="og:image" content="http://drive.3d-smartsolutions.com/shared/users/103/folders-763/uuwcurQEpKeT.png" />
  <meta property="og:image:width" content="800" />
	<meta property="og:image:height" content="600" />
	<meta property="og:image:type" content="image/png"/>
	<meta property="og:image:alt" content="Hình ảnh"/>

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('argon/css/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('argon/css/img/favicon.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <link rel="stylesheet" href="{{url('css/master.css')}}">
  <!-- Bootstrap CSS -->
        <style>
          .breadcrumb-item+.breadcrumb-item:before{
            color:#fff !important;
          }
        </style>
        @stack('styles')
  <title>
    @if(isset($title))
      {{$title}}
    @else
     Sơ đồ tổ chức
    @endif
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href=" {{ asset('argon/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('argon/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('argon/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('argon/css/argon-dashboard.min.css')}}" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  @stack('styles')
  <style>
    .main-div{
      min-height:600px;
    }
    .table.table-bordered tbody tr:last-child td{
      border-bottom-width: 1px !important;
      border-right-width: 1px !important;
    }
  </style>
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <main class="main-content position-relative border-radius-lg ">

      @include('layouts.navbars.navs.main-nav')
    <!-- End Navbar -->
    <div class="container-fluid py-4" style="min-height:400px;">

      {{$slot}}

      @include('layouts.footers.main-footer')
    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="{{asset('argon/js/core/popper.min.js') }}"></script>
  <script src="{{asset('argon/js/core/bootstrap.min.js') }}"></script>
  <script src="{{asset('argon/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{asset('argon/js/plugins/smooth-scrollbar.min.js') }}"></script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('argon/js/argon-dashboard.min.js')}}?v=2.0.0"></script>


  <script src="{{ asset('js/jquery-3.5.1.min.js') }}" crossorigin="anonymous"></script>

  <script>
     var settings = {};
        new TomSelect('#tom-select-it',settings);

      var settings1 = {};
      new TomSelect('#tom-select-it1',settings);
      var settings2 = {};
      new TomSelect('#tom-select-it2',settings);




  </script>

<script>
    function hienThongBao(thongBao)
        {
            Swal.fire({
                title: thongBao,
                text: ``,
                icon: "success",
                confirmButtonColor: "#B52227",
                showConfirmButton: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    //
                }
            });
        }

        function hienLoi(thongBao)
        {
            Swal.fire({
                title: thongBao,
                text: ``,
                icon: "error",
            }).then((result) => {
                if (result.isConfirmed) {
                    //
                }
            });
        }
</script>

  @stack('scripts')
</body>

</html>
