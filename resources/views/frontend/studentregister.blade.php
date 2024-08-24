@extends('frontend.index')
@section('title','Student Registration')
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
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">CID#/Passport#/Any Document</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="cid" id="inputEmail3" placeholder="Document Number">
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Full Name <span><font color="red">*</font></span>
                        
                                    </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="fullname" id="inputEmail3" placeholder="Full Name" required>
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Email" required>
                                        </div>

                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="psw" id="psw" minlength="8" placeholder="Password" required>
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Confirm Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="cpsw" name="cpswd" placeholder="Confirm Password" required>
                                            <span  id="error_confirm"></span>
                                        </div>


                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck2" required>
                                    <label class="form-check-label" for="exampleCheck2">By registering I accept the terms of the YDF's Privacy Policy.</label>
                                </div>
                                <div class="text-right">
                                <button class="btn btn-sm btn-primary" id="submitbtn">Register</button>
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
