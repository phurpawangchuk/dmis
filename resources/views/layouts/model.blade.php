<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DMiS - @yield('title')</title>
  <link rel="shortcut icon" href="{{ asset('/images/fav.jpeg') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('/css/jqueryui.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css')}}">
     <!-- slim select roles. permission etc -->
  <link rel="stylesheet" href="{{ asset('css/slimselect.min.css') }}">
</head>
<body>
  <section class="content">
    @yield('content')
  </section>
  <!--role select-->
  <script src="{{ asset('/js/slimselect.min.js') }}"></script>

  <!-- Editor summernote css/js -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
  <script type="text/javascript">
      $('#description').summernote({
          height: 400
      });
  </script>
</body>
</html>
