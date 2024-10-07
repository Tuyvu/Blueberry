<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">


<!-- Mirrored from mannatthemes.com/rizz/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Aug 2024 06:02:59 GMT -->
<head>
    

    <meta charset="utf-8" />
            <title>@yield('title')</title>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
            <meta content="" name="author" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />

            <!-- App favicon -->
            <link rel="shortcut icon" href="{{asset('admin-asset')}}/assets/images/favicon.ico">

       

    <link rel="stylesheet" href="{{asset('admin-asset')}}/assets/libs/jsvectormap/css/jsvectormap.min.css">

     <!-- App css -->
     <link href="{{asset('admin-asset')}}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
     <link href="{{asset('admin-asset')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
     <link href="{{asset('admin-asset')}}/assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- Top Bar Start -->
  @include('admin.layouts.topbar')
    <!-- Top Bar End -->
    <!-- leftbar-tab-menu -->
  @include('admin.layouts.startbar')

    <!--end startbar-->
    <div class="startbar-overlay d-print-none"></div>
    <!-- end leftbar-tab-menu-->

    @yield('mainad-content')
    <!-- end page-wrapper -->

    <!-- Javascript  -->
    <!-- vendor js -->
    
    <script src="{{asset('admin-asset')}}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('admin-asset')}}/assets/libs/simplebar/simplebar.min.js"></script>

    <script src="{{asset('admin-asset')}}/assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="{{asset('admin-asset')}}/assets/data/stock-prices.js"></script>
    <script src="{{asset('admin-asset')}}/assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="{{asset('admin-asset')}}/assets/libs/jsvectormap/maps/world.js"></script>
    <script src="{{asset('admin-asset')}}/assets/js/pages/index.init.js"></script>
    <script src="{{asset('admin-asset')}}/assets/js/app.js"></script>
</body>
<!--end body-->


<!-- Mirrored from mannatthemes.com/rizz/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Aug 2024 06:03:02 GMT -->
</html>