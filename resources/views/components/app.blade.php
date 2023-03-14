<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="biweb">

    <title>{{ $title }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.2/datatables.min.css"/>
    @isset($styles)
        {{ $styles }}
    @endisset
    <link href="{{ asset("css/app.css") }}" rel="stylesheet">

</head>
<body {{ $attributes }}>
{{ $slot }}
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.2/datatables.min.js"></script>
<script src="https://kit.fontawesome.com/9562824dba.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}"></script>
@isset($scripts)
    {{ $scripts }}
@endisset
</body>

</html>
