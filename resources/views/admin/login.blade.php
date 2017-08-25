<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Maduka ya Dawa - Code for Tanzania</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhaina" rel="stylesheet"> 

    <link href="{{ asset('css/maduka.custom.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="login">
    <div class="container">
        <div class="row">   
            <div class="col-md-6 col-md-offset-3 login-box">
                <div class="brand">
                    <img src="{{ asset('images/pharmacy.png') }}" />
                    <h1>Maduka ya Dawa</h1>
                </div>

                <div class="login-form">
                    @if(Session::has('message'))
                        <div class="alert alert-{{Session::get('class')}}" role="alert">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <form method="post" action="{{ route('admin.auth') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="email" class="form-control no-radius" value="{{ old('email') }}" placeholder="Email" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control no-radius" value="" placeholder="Password" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-lg btn-block btn-pink no-radius" value="LOGIN" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- close div .container -->

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/maduka.js') }}" type="text/javascript"></script>
</body>
</html>