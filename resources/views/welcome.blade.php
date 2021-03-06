<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Admin</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{url(link_html().'/dist/css/skins/_all-skins.min.css')}}">
        <link rel="stylesheet" href="{{url(link_html().'/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            }

                        body {
                            margin: 0;
                            padding: 0;
                            background: #fff;
                            color: #fff;
                            font-family: Arial;
                            font-size: 12px;
                        }

                        .body {
                            position: absolute;
                            top: -20px;
                            left: -20px;
                            right: -40px;
                            bottom: -40px;
                            width: auto;
                            height: auto;
                            background-image:url("");
                            background-size: cover;
                            z-index: 0;
                        }

                        .grad {
                            position: absolute;
                            top: -20px;
                            left: -20px;
                            right: -40px;
                            bottom: -40px;
                            width: auto;
                            height: auto;
                            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0)), color-stop(100%, rgba(0, 0, 0, 0.65)));
                            /* Chrome,Safari4+ */
                            z-index: 1;
                            opacity: 0.7;
                        }

                        .header {
                            position: absolute;
                            top: calc(50% - 35px);
                            left: calc(50% - 255px);
                            z-index: 2;
                        }

                        .header div {
                            float: left;
                            color: #fff;
                            font-family: 'Exo', sans-serif;
                            font-size: 35px;
                            font-weight: 200;
                        }

                        .header div span {
                            color: #5379fa !important;
                        }

                        .login {
                            position: absolute;
                            top: calc(50% - 75px);
                            left: calc(50% - 50px);
                            height: 150px;
                            width: 350px;
                            padding: 10px;
                            z-index: 2;
                        }

                        .login input[type=text] {
                            width: 250px;
                            height: 30px;
                            background: transparent;
                            border: 1px solid rgba(255, 255, 255, 0.6);
                            border-radius: 2px;
                            color: #fff;
                            font-family: 'Exo', sans-serif;
                            font-size: 16px;
                            font-weight: 400;
                            padding: 4px;
                        }

                        .login input[type=password] {
                            width: 250px;
                            height: 30px;
                            background: transparent;
                            border: 1px solid rgba(255, 255, 255, 0.6);
                            border-radius: 2px;
                            color: #fff;
                            font-family: 'Exo', sans-serif;
                            font-size: 16px;
                            font-weight: 400;
                            padding: 4px;
                            margin-top: 10px;
                        }

                        .login input[type=button] {
                            width: 260px;
                            height: 35px;
                            background: #fff;
                            border: 1px solid #fff;
                            cursor: pointer;
                            border-radius: 2px;
                            color: #a18d6c;
                            font-family: 'Exo', sans-serif;
                            font-size: 16px;
                            font-weight: 400;
                            padding: 6px;
                            margin-top: 10px;
                        }

                        .login input[type=button]:hover {
                            opacity: 0.8;
                        }

                        .login input[type=button]:active {
                            opacity: 0.6;
                        }

                        .login input[type=text]:focus {
                            outline: none;
                            border: 1px solid rgba(255, 255, 255, 0.9);
                        }

                        .login input[type=password]:focus {
                            outline: none;
                            border: 1px solid rgba(255, 255, 255, 0.9);
                        }

                        .login input[type=button]:focus {
                            outline: none;
                        }

                        ::-webkit-input-placeholder {
                            color: rgba(255, 255, 255, 0.6);
                        }

                        ::-moz-input-placeholder {
                            color: rgba(255, 255, 255, 0.6);
                        }
        </style>
    </head>
    <body>
    <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>Admin<br><span><b>WEB KPdP<b></span></br></div>
		</div>
		<br>
		<div class="login">
        <div>
            <form method="POST" action="{{ route('login') }}">
            @csrf
			<div>
                <input type="text" placeholder="email" input id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus><br>
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
			<div>
                <input id="password" placeholder="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required><br>
                @if ($errors->has('password'))<span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                @endif
            </div>
            <div>
                <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                @if (Route::has('password.request'))<a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                @endif
            </div>

            </form>
                
	    </div>
    </div>
    </body>
</html>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
