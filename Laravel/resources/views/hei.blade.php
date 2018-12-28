<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
        .form-input{
            text-align: center;
            margin-top: 30px;
        }
        .form_ground{
            margin-top: 20px;
        }
        .form_Btn{
            margin-top: 20px;
        }
    </style>
</head>
<body>
    {{--@if (Route::has('login'))--}}
    {{--<div class="top-right links">--}}
        {{--@if (Auth::check())--}}
        {{--<a href="{{ url('/home') }}">Home</a>--}}
        {{--@else--}}
        {{--<a href="{{ url('/login') }}">Login</a>--}}
        {{--<a href="{{ url('/register') }}">Register</a>--}}
        {{--@endif--}}
    {{--</div>--}}
    {{--@endif--}}

    <h1 style="text-align: center;margin: 0">登录系统</h1>
    <form action="#" class="form-input">
        <div class="form_ground_a">
            <label for="email">FOR  EMAIL</label>
            <input type="email" id="emails">
        </div>
        <div class="form_ground">
            <label for="password">PASSWORD</label>
            <input type="passwordq" id="passwords">
        </div>
        <div class="form_Btn">
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>