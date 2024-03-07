@extends('frontend.index')
@section('title','Donor Registration')
@section('frontcontent')
<div class="content-wrapper">
    <div class="content-header text-center">

    </div>
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-md-5">
                    <h4>Donor Registration </h4>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                @include('partials.admin-message')
                    <div class="card card-info card-outline">
                        <div class="card-body">
                            <form action="{{route('registration.post')}}" class="form-horizontal" method="POST">
                            @csrf
                        @method('POST')
                                <div class="form-group row">
                                    <span for="aaa" class="col-sm-2 col-form-span">CID#/Passport#/Any Document</span>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="document_id" id="aaa" placeholder="Any Document Number">
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <span for="aaa" class="col-sm-2 col-form-span">Full Name <span><font color="red">*</font></span>
                                    </span>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="fullname" id="aaa" placeholder="Full Name" required>
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <span for="aaa" class="col-sm-2 col-form-span">Email<span><font color="red">*</font></span></span>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email" id="aaa" placeholder="Email" required>
                                        </div>
                                </div>


                                <div class="form-group row">
                                    <span for="aaa" class="col-sm-2 col-form-span">Country<span><font color="red">*</font></span></span>
                                    <div class="col-sm-10">
                                        <select id="country" class="form-control" name="country" required>
                                            <option value="" selected hidden>Please Select</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ ucfirst($country->countryName)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <span for="anationalityaa" class="col-sm-2 col-form-span">Nationality<span><font color="red">*</font></span></span>
                                    <div class="col-sm-10">
                                        <select id="nationality" class="form-control" name="nationality" required>
                                            <option value="" selected hidden>Please Select</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{$country->nationality}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <span for="religion" class="col-sm-2 col-form-span">Religion</span>
                                    <div class="col-sm-10">
                                        <select id="religion" class="form-control" name="religion" >
                                            <option value="" selected hidden>Please Select</option>
                                            @foreach ($religions as $religion)
                                                <option value="{{ $religion->id }}">{{$religion->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <span for="aaa" class="col-sm-2 col-form-span">Password<span><font color="red">*</font></span></span>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="psw" id="psw" minlength="8" placeholder="Password" required>
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <span for="aaa" class="col-sm-2 col-form-span">Confirm Password</span>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="cpsw" name="cpswd" placeholder="Confirm Password" required>
                                            <span  id="error_confirm"></span>
                                        </div>


                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck2" required><span><font color="red">*</font></span>
                                    <span class="form-check-span" for="exampleCheck2">By registering I accept the terms of the YDF's Privacy Policy.</span>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-sm bg-dark text-white " id="submitbtn">Register</button>
                                    <a href="../register" class="btn btn-sm btn-danger"> Cancel </a>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
$(document).ready(function(){

    $('#cpsw').on('keyup', function() {

      var password = $("#psw").val();
      var confirmPassword = $("#cpsw").val();
      if (password != confirmPassword)
      {
        $("#error_confirm").html("<small>Confirm  Password does not match the password</small>").css("color", "red");
        $("#submitbtn").prop('disabled', true);
      }

      else
      {
        $("#error_confirm").html("<small>Confirm  Password match</small>").css("color", "green");
        $("#submitbtn").prop('disabled', false);
      }

    });


});
</script>
@endpush
