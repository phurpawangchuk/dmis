@extends('frontend.index')
@section('title','Register/Login')
@section('frontcontent')
<div class="content-wrapper">
    <div class="content-header text-center">

    </div>
    <div class="content">
        <div class="container">
        @include('partials.admin-message')
            <div class="row">
                <div class="col-md-5">
                    <h4>Donation Management Information System</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-warning card-outline">
                        <div class="card-body text-justify">
                        <h2>Welcome to the Online Donation Management Information of Bhutan Youth Development Fund.</h2>
                        <p>Registered users can directly login and use this portal to donate in YDF.</p>
                        <p>However, if you haven’t registered before, please click on the Register button below to register yourself as a YDF Donor.</p>
                        <p>Once registered with this Online Donation Portal, you can use the same username and password repeatedly to donate in any of the YDF projects.</p>

                        </div>
                        <div class="card-footer">
                        <a href="donorregistration" class="btn bg-dark text-white btn-flat"> <i class="fa fa-user-plus"></i> Register </a>

                        <a href="/" class="btn btn-danger btn-flat"> <i class="fa fa-arrow-left"></i> Back </a>
                       </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-warning card-outline">
                        <div class="card-header">Adready Registered?</div>
                        <div class="card-body">


                        <form method="POST" action="{{ route('login') }}">
                    @csrf
                    @method('POST')
                        <div class="form-group has-feedback">
                            <label for="">Username</label>
                            <div class="input-group">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Username" autocomplete="off" required autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="form-group has-feedback">
                            <label for="">Password</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" autocomplete="off" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <button type="submit" class="btn bg-dark text-white btn-block btn-lg">LOGIN</button>
                    </form>
                            <a href="{{route('donors.forgotpassword')}}">Forgot Password</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


@endsection
