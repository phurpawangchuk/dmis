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
  <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">


  <!-- slim select roles. permission etc -->
  <link rel="stylesheet" href="{{ asset('css/slimselect.min.css') }}">

  <style>
    /* Style the sidenav links and the dropdown button */
    .dropdown-btn {
      padding: 6px 8px 6px 16px;
      text-decoration: none;
      color: #c0c0c0;
      display: block;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
      cursor: pointer;
      outline: none;
    }

    /* On mouse-over */
    .dropdown-btn:hover {
      color: #c0c0c0;
    }

    /* Add an active class to the active dropdown button */
    .dropdown-container .active {
       background-color: #262626;
      /* color: white; */
    }

    /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
    .dropdown-container {
      display: none;
      padding-left: 8px;
    }

    /* Optional: Style the caret down icon */
    .fa-caret-down {
      /* float: right; */
    }
    .model-bg-header {
      background: #c0c0c0;
    }

    /* Some media queries for responsiveness */
    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
      .sidenav a {font-size: 18px;}
    }
</style>

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('partials.header')

  @include('partials.sidebar')
  <div class="content-wrapper">
    @include('partials.breadcrumb')
    <section class="content">
      @yield('content')
    </section>
  </div>
  @include('partials.footer')

</div>

<!-- jQuery -->
<script src="{{ asset('/js/jquery.min.js')}}"></script>
<script src="{{ asset('/js/jquery-ui.min.js')}}"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('/js/adminlte.min.js') }}"></script>
<script src="{{ asset('/js/bootbox.js') }}"></script>
<script src="{{ asset('/js/datatable.js') }}"></script>
<script src="{{ asset('/js/confirm-delete.js') }}"></script>


@stack('scripts')

@stack('styles')
<script type="text/javascript">
		var appUrl = "{{ url('/') }}/";
	</script>

<!--role select-->
<script src="{{ asset('js/slimselect.min.js') }}"></script>

<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>

<!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('#description').summernote({
        height: 400
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
       var table = $('#example').DataTable( {
        lengthChange: false,
      
        buttons: [ { extend: 'copy', text: 'Copy Data' }, { extend: 'excel', text: 'Export as Excel' }, { extend: 'pdf', text: 'Export as Pdf' } ]
    } );
 
    
   } );

</script>
<script type="text/javascript">
        $(document).ready(function() {
       var table = $('#example1').DataTable( {
        lengthChange: false,
      
        buttons: [ { extend: 'copy', text: 'Copy Data' }, { extend: 'excel', text: 'Export as Excel' }, { extend: 'pdf', text: 'Export as Pdf' } ]
    } );
 
   
   } );

</script>


</body>
</html>
