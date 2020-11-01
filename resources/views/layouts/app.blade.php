<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('htmlheader_title',config('app.name', 'Бездомные домашние животные>'))</title>

    <link href="/images/pet.png" rel="shortcut icon" type="image/png"/>


    <link href="{{ asset('css/semantic.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/noty/noty.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/js/semantic.min.js"></script>
    <script src="/assets/noty/noty.min.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="/js/app.js?<?=rand(1, 10000)?>"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic" rel="stylesheet">
    @yield('script')
    @yield('style')

</head>
<body style="min-height: 100vh;background-color: white;">
<div id="app" class="pusher">

    <div class="ui grid">
        <div class="row" style="padding: 20px 10px 10px 10px;">
            <div class="four wide column">

                <img src="/images/main.svg" style="height: 80px;float:left; margin: 7px 7px 7px 0;">
                <p style="margin-top:5px; font-size: 15px; font-weight: bold;color:#2185D0">{{ Auth::User()->user_name }}</p>
                {{ Auth::user()->organization->name }}<br>
                {{ Auth::user()->role->name }}
            </div>
            <div class="eight wide column" style="padding-top: 30px;">
                <h1 style="text-align: center;">ИС "Реестр животных без владельцев"</h1>
            </div>
            <div class="four wide column">
                <div style="margin-top:35px; text-align: right;">
                    <a class="btn_logout" href="/logout"><img width="30" src="/images/quit-btn.png"></a>
                </div>
            </div>
        </div>
    </div>
    <div style="text-align: center" class="ui blue secondary pointing menu main_menu">
        @php
            //dd($menu);
        @endphp
        @foreach($menu as $m)
            @if($m->parent && isset($m->items))
                <div class="ui dropdown item {{ $m->disable?'disabled':'' }} {{ $m->active }}">
                    {{$m->title}}
                    <div class="menu">
                        @foreach($m->items as $s)
                            <a {{ isset($s->url)&&!$m->disable?'href='.$s->url.'':'' }} class="item {{ $s->disable?'disabled':'' }} {{ $s->active }}">
                                <span class="lbl">{{$s->title}}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <a {{ isset($m->url)&&!$m->disable?'href='.$m->url:'' }} class="item {{ $m->disable?'disabled':'' }} {{ $m->active }}">
                    <span class="lbl">{{$m->title}}</span>
                </a>
            @endif
        @endforeach
    </div>


    <div class="row" id="main-body-content">
        @yield('content')
    </div>


</div>
</body>
</html>
