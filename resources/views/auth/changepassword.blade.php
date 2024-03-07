@extends('layouts.primary', [
    'class' => '',
    'elementActive' => 'spassword'
])
@section('title','Change password')
@section('content')
@section('heading','Change Password')

  <div class="row">
    <div class="col-md-6">
    @include('partials.admin-message')
      <div class="card card-outline card-primary">

        <div class="card-body table-responsive">
            <form method="post" action="{{route('profile.post-password')}}">
                    @csrf
                   
                <div class="form-group has-feedback">
                <label for="">Old Password</label>
                <div class="input-group">
                    
                    <input id="password" type="password" class="form-control" name="password" placeholder="Old Password" autocomplete="off" required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-key"></span>
                        </div>
                    </div>

                </div>
               
            </div>
            <div class="form-group has-feedback">
                <label for="">Password</label>
                <div class="input-group">
                    <input id="psw" type="password" class="form-control" name="npassword" placeholder="New Password" autocomplete="off" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
    
                </div>
            </div>

            <div class="form-group has-feedback">
                <label for="">Confirm Password</label>
                <div class="input-group">
                    <input id="cpsw" type="password" class="form-control" name="cpassword" placeholder="New Password" autocomplete="off" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                   
    
                </div>
                <span  id="error_confirm"></span>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block btn-sm">Change Password</button>
        </form>
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