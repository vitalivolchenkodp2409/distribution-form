<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Project Oblio Airdrop</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ URL::asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ URL::asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ URL::asset('plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ URL::asset('css/themes/all-themes.css') }}" rel="stylesheet" />

    @yield('header-script')

</head>

<body class="theme-cyan">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Top Bar -->
    @include('layouts.partials.topbar')
    <!-- #Top Bar -->


    <!-- Top Bar -->
    @include('layouts.partials.navbar')
    <!-- #Top Bar -->

    {{-- Content section --}}
    @yield('content')
    {{--  --}}


    <!-- Jquery Core Js -->
    <script src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>





    <!-- Bootstrap Core Js -->
    <script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    {{-- <script src="{{ URL::asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script> --}}

    <!-- Slimscroll Plugin Js -->
    <script src="{{ URL::asset('plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ URL::asset('plugins/node-waves/waves.js') }}"></script>


 

    <!-- Custom Js -->
    <script src="{{ URL::asset('js/admin.js') }}"></script>
    <script src="{{ URL::asset('js/pages/index.js') }}"></script>

    <!-- Demo Js -->
    <script src="{{ URL::asset('js/demo.js') }}"></script>
    <script src="{{ URL::asset('js/script.js') }}"></script>

    {{-- date time picker--}}
    <script type="text/javascript" src="{{ URL::asset('datetime/bootstrap-datetimepicker.js') }}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{ URL::asset('datetime/bootstrap-datetimepicker.fr.js') }}" charset="UTF-8"></script>
    <link href="{{ URL::asset('datetime/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" media="screen">    

    {{-- date picker--}}
    <script type="text/javascript" src="{{ URL::asset('/datepicker/bootstrap-datepicker.min.js') }}" charset="UTF-8"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet" media="screen">


    {{-- jquery datatables --}}
    <script type="text/javascript" src="{{ URL::asset('datatable/jquery.dataTables.min.js') }}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{ URL::asset('datatable/datatables.bootstrap.js') }}" charset="UTF-8"></script>
    <link href="{{ URL::asset('datatable/datatables.bootstrap.css') }}" rel="stylesheet" media="screen">





    @yield('footer-script')

</body>

</html>