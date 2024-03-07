<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="{{ asset('images/fav.jpeg') }}">
        <link rel="stylesheet" href="{{ asset('/css/admin.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
	    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
       
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
          @include('partials.admin-message')
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('/images/ydf.png') }}" alt="" class="img-fluid">
                    </a>
                </div>
                <div class="card-body login-card-body">
                    <form method="POST" action="{{route('login.post')}}">
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
                        
                        <button type="submit" class="btn btn-primary btn-block btn-lg">LOGIN</button>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </body>
</html>
