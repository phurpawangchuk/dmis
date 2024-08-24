@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'home'
])

@section('content')
<h1>I donate to our future, our hope, our children and a better planet!</h1>

    <div class="row ">
        <div class="col-md-10">
         <div class="card card-info card-outline">
             <div class="card-body">

                 <form >
                    @csrf

                    <div class="form-group row">
                    <select class="browser-default custom-select" name="category" id="category">
                        <option selected>Select project</option>

                        <option value="Institute of WellBeing">Institute of WellBeing</option>
                        <option value="Institute of WellBeing">Education</option>
                        <option value="Institute of WellBeing">Education</option>
                        <option value="Institute of WellBeing">General</option>

                    </select>

                        </div>

                        <div class="form-group row">

                                        <div class="col-sm-10">
                                        <div class="text-center">
                          <a href="/studentDashboard/payment" style="border:5px">  <i class="fa fa-paper-plane" aria-hidden="true"></i> Donate Fund  </a>
                                </div>
                                        </div>

                        </div>



                    </form>
    </div>
</div>





@endsection
