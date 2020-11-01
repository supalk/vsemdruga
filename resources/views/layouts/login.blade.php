<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="min-height: 100vh;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Бездомные домашние животные') }}</title>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('js/semantic.min.js') }}" defer></script>

<!-- Fonts -->
    {{--<link rel="dns-prefetch" href="https://fonts.gstatic.com">--}}
    {{--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">--}}
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/semantic.min.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body > .grid {
            height: 100%;
        }

        body {
            color: #222;
            font-family: "Open Sans","Helvetica Neue",Arial,sans-serif !important;
            font-size: 14px;
            line-height: 1.42857;
            height: auto;
        }
        .column {
            max-width: 450px;
        }

        button, input, select, textarea {
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
        }

        a:hover{
            text-decoration: none;
        }
    </style>
    @yield('style')

</head>


<body>
@yield('content')
</html>
