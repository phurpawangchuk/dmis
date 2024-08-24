@extends('frontend.index')
@section('title','Home')
@section('frontcontent')
<div class="content-wrapper">

     <div class="content-header text-center ">

     </div>

         <div class="content">
             <div class="container">
                 <div class="row">
                    <div class="col-md-6">
                         <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                             <ol class="carousel-indicators">
                                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                  <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>

                             </ol>
                                 <div class="carousel-inner">
                                     <div class="carousel-item active">
                                        <img class="d-block sliderhight" src="{{asset('/images/ydf1.jpg')}}" alt="First slide" >
                                     </div>
                                         <div class="carousel-item">
                                            <img class="d-block sliderhight" src="{{asset('/images/ydf2.jpg')}}" alt="Second slide">
                                         </div>
                                         <div class="carousel-item">
                                             <img class="d-block sliderhight" src="{{asset('/images/ydf3.jpg')}}" alt="Thrid slide">
                                         </div>
                                         <div class="carousel-item">
                                            <img class="d-block sliderhight" src="{{asset('/images/ydf.jpg')}}" alt="Fourth slide">
                                         </div>

                                     </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                 <span class="sr-only">Next</span>
                                        </a>
                                     </div>
                                 </div>


                             @include('frontend.callforaction')
                         </div>

                         <div class="content-header text-center ">
                         </div>
                         <div class="content-header text-center ">
                         </div>

                         <div class="row">
                             <div class="text-center col-md-12">
                                 <strong class="text-primary">YDF PROJECTS</strong>
                             </div>
                             <div class="col-md-12" >
                                 @include('frontend.ydfprojects')
                             </div>
                         </div>

                         <div class="row">
                         <div class="text-center col-md-12">
                                 <strong class="text-primary">YDF EVENTS</strong>
                             </div>
                             <div class="col-md-12" >
                                 @include('frontend.ydfevents')
                             </div>
                         </div>
                         <div class="row">
                            <div class="col-md-12" >
                                @include ('frontend.clients')
                            </div>
                         </div>
        <!-- /.row -->
                </div><!-- /.container-fluid -->
             </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@push('styles')
<style>
    .c2a1 {
  font-family: "Montserrat", sans-serif;
	color: #8d97ad;
  font-weight: 300;
	background-position: center top;
    background-size: cover;
    background-attachment: fixed;
}

.c2a1 h1, .c2a1 h2, .c2a1 h3, .c2a1 h4, .c2a1 h5, .c2a1 h6 {
  color: #3e4555;
}

.c2a1 .op-8 {
	opacity: 0.8;
}

.c2a1 .font-weight-medium {
	font-weight: 500;
}

.c2a1 .btn-danger-gradiant {
  background: #ff4d7e;
  background: -webkit-linear-gradient(legacy-direction(to right), #ff4d7e 0%, #ff6a5b 100%);
  background: -webkit-gradient(linear, left top, right top, from(#ff4d7e), to(#ff6a5b));
  background: -webkit-linear-gradient(left, #ff4d7e 0%, #ff6a5b 100%);
  background: -o-linear-gradient(left, #ff4d7e 0%, #ff6a5b 100%);
  background: linear-gradient(to right, #ff4d7e 0%, #ff6a5b 100%);
}

 .c2a1 .btn-danger-gradiant:hover {
  background: #ff6a5b;
  background: -webkit-linear-gradient(legacy-direction(to right), #ff6a5b 0%, #ff4d7e 100%);
  background: -webkit-gradient(linear, left top, right top, from(#ff6a5b), to(#ff4d7e));
  background: -webkit-linear-gradient(left, #ff6a5b 0%, #ff4d7e 100%);
  background: -o-linear-gradient(left, #ff6a5b 0%, #ff4d7e 100%);
  background: linear-gradient(to right, #ff6a5b 0%, #ff4d7e 100%);
}

.c2a1 .btn-md {
    padding: 15px 45px;
    font-size: 16px;
}
.sliderhight{
    width: 100%!important;
    height: 320px;
}

</style>
@endpush
