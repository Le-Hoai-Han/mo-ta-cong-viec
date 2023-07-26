<!--
=========================================================
* Argon Dashboard 2 - v2.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
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
  <meta property="og:site_name" content="https://etraining.com.vn/" />
  <meta property="og:description" content="eTraining giúp bạn bổ sung các kiến thức nền tảng và các ứng dụng thực tế của các công nghệ 3D tiên tiến." />
  <meta property="og:title" content="Tiêu đề etraining" />
  <meta property="og:url" content="kinhdoanh.com" />
  <meta property="og:type" content="website" />        
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('argon/css/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('argon/css/img/favicon.png') }}">
  <link rel="stylesheet" href="{{url('css/danh-muc-san-pham.css')}}">
  <link rel="stylesheet" href="{{url('css/master.css')}}">
  <!-- Bootstrap CSS -->
        <style>
          .breadcrumb-item+.breadcrumb-item:before{
            color:#fff !important;
          }
        </style>
        {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"> --}}
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
  @include('layouts.navbars.sidenav')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    
    @include('layouts.navbars.navs.main-nav',[
      'list'=>$list,
      'current'=>$current
    ])
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

  @stack('scripts')
  <script src={{asset('js/congthuc.js')}} async> </script>
</body>

</html>