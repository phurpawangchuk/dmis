@extends('layouts.primary')

@section('content')
<div class="card">
    <div class="card-header btn-default">
        <h4 class="modal-title">{{ __('Change Password') }}</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('dashboard.users.changepwd') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group has-feedback">
                <span for="">New Password</span>
                <div class="input-group">
                    <input id="npassword" type="password" class="form-control" name="npassword" minlength="8" placeholder="New Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
    
                </div>
            </div>

            <div class="form-group has-feedback">
                <span for="">Confirm Password</span>
                <div class="input-group">
                    <input id="cpassword" type="password" class="form-control" name="cpassword" placeholder="Confirm Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <span  id="error_confirm"></span>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button id="submitbtn" type="submit" class="btn bg-dark text-white">
                        {{ __('Update') }}
                    </button>

                    <a href="{{ route('dashboard.users.index') }}" class="btn btn-danger" data-dismiss="modal" aria-span="Close">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{asset('/js/jquery.min.js')}}"></script>

<script>
$(document).ready(function(){
    
    $('#cpassword').on('keyup', function() {
      var password = $("#npassword").val();
      var confirmPassword = $("#cpassword").val();
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

@endsection
