<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Laravel 9 | Roles and Permissions Manager</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monster-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="{{ asset('admin_assets/css/style.min.css') }}" rel="stylesheet">

    <!-- Theme style -->
   <!-- <link rel="stylesheet" href="{{asset('assets/css/adminlte.min.css')}}"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
        <style>
            .btn{
                margin: 2.5px;
            }
        </style>
    @yield('styles')
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div>
        @if(Session::has('status-success'))
            <div class="alert alert-success">
                {{Session::get('status-success')}}
            </div>
        @endif

        @if(Session::has('status-info'))
            <div class="alert alert-info">
                {{Session::get('status-info')}}
            </div>
        @endif

        @if(Session::has('status-warning'))
            <div class="alert alert-warning">
                {{Session::get('status-warning')}}
            </div>
        @endif

        @if(Session::has('status-danger'))
            <div class="alert alert-danger">
                {{Session::get('status-danger')}}
            </div>
        @endif

        @yield('content')

    </div>
    <script src="{{ asset('admin_assets/js/custom.js') }}"></script>
    @yield('scripts')
</body>

</html>
