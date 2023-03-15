<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="biweb">

    <title>My CMS - Login</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset("css/app.css") }}" rel="stylesheet">

</head>
<body>
<div class="form-login-container">
    <form class="form-login" method="POST" action="{{ route('admin.doLogin') }}">
        @csrf

        <img class="mb-4" src="" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
            <x-input id="email" type="email" name="email" value="superadmin@my-cms.local" required autofocus/>
            <label for="email">{{__('Email')}}</label>
        </div>
        <div class="form-floating">
            <x-input id="password"
                     type="password"
                     name="password"
                     value="superadmin123"
                     required autocomplete="current-password"/>
            <label for="password">{{__('Password')}}</label>
        </div>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> {{ __('Remember me') }}
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">{{ __('Log in') }}</button>
    </form>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors"/>

</div>
<script src="https://kit.fontawesome.com/9562824dba.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

