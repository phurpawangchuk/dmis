<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')-Donor Management Information System</title>
  <link rel="shortcut icon" href="{{ asset('/images/fav.jpeg') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('/css/all.min.css')}}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light text-white" style="background-color:#f9c013">
    <div class="container">

    <a href="http://localhost/ydf/public/" class="navbar-brand ">
        <img src="{{asset('/images/fav.jpeg')}}" alt="ydf logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold text-dark">Donor Management Information System</span>
    </a>
    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <ul class="navbar-nav ml-auto">


            <li class="nav-item">
                <a href="https://www.bhutanyouth.org/about-us/" target="_blank" class="nav-link text-dark"><i class="fas fa-phone"></i> Contact</a>
            </li>
            <li class="nav-item">
                <a href="https://www.bhutanyouth.org/about-us/" target="_blank" class="nav-link text-dark"> About US</a>
            </li>

            <!-- <li class="nav-item"  >
                <a href="/login" class="nav-link text-dark" style="float: right;"><i class="fas fa-user-tie"></i></a>
            </li> -->

          </ul>

        </div>
</div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->

    <!-- Main content -->

    @yield('frontcontent')

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      DMiS v1.0
    </div>
    <!-- Default to the left -->
    <strong>© Bhutan Youth Development Fund </strong> - All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('/js/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/js/adminlte.min.js') }}"></script>
@stack('scripts')
@stack('styles')
</body>
</html>
