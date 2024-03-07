@extends('frontend.index')
@section('title','Register/Login')
@section('frontcontent')
<div class="content-wrapper">
    <div class="content-fluid">
        <div class="container col-8">
       
            <div class="row">
                <div class="col-8 mt-5">
                    <h4>Please provide your email to reset password</h4>
                </div> 
            </div>  
            <div class="row">
                <div class="col-8">
                @include('partials.admin-message')
                    <div class="card card-info card-outline">
                        <div class="card-body text-justify">
                        <form method="POST" action="{{route('donors.forgotpassword')}}">
                        @csrf
                        @method('POST')
                        <div class="form-group has-feedback">
                            <span for="">Email</span>
                            <div class="input-group">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Provide your email" autocomplete="off" required autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm float-right">Send Mail</button>
                      </form>
                        
                        </div>
                        
                    </div>
                </div> 
                
                
            </div>        
        </div>
    </div>
</div>


@endsection