@extends('frontend.index')
@section('title','Register/Login')
@section('frontcontent')
<div class="content-wrapper">
    <div class="content-header text-center">
        
    </div>
    <div class="content">
        <div class="container">
       
            <div class="row">
                <div class="col-md-5">
                    <h4>Forgot Password</h4>
                </div> 
            </div>  
            <div class="row">
                <div class="col-md-8">
                @include('partials.admin-message')
                    <div class="card card-info card-outline">
                        <div class="card-body text-justify">
                        <form method="POST" action="{{route('student.forgotpost')}}">
                       @csrf
                        @method('POST')
                        <div class="form-group has-feedback">
                            <label for="">Email</label>
                            <div class="input-group">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Username" autocomplete="off" required autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>

                            </div>
                            
                        </div>
                        
                        
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Sent Mail</button>
                      </form>
                        
                        </div>
                        
                    </div>
                </div> 
                
                
            </div>        
        </div>
    </div>
</div>


@endsection