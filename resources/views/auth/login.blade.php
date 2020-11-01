@extends('layouts.login')
@section('style')
    <style>
        .grid{
            margin-top: 0!important;
        }
        .txt-blue {
            color:#2589DE !important;
        }

    </style>
@endsection
@section('content')

    <div data-page="login" class="ui middle aligned center aligned grid">
        <div class="column">
            <h2 class="ui  image header">
                <img src="images/main.svg" class="image">
                <div class="txt-blue header">ЖИВОТНЫЕ БЕЗ ВЛАДЕЛЬЦЕВ</div>
            </h2>
            <h2 class="ui header">
                Вход
            </h2>
            @if (count($errors) > 0)
                <div class="form-group has-error">
                    @foreach ($errors->all() as $error)
                        <span class="help-block">
                                <strong> {{ $error }}</strong><br>
                                </span>
                    @endforeach
                </div>
                <br>
            @endif
            <form class="ui large form" method="post" action="{{ url('/login') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="ui stacked segment">
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input required type="text" name="email" placeholder="E-mail">
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input required type="password" name="password" placeholder="Пароль">
                        </div>
                    </div>
                    <button type="submit" class="ui fluid large blue submit button">Войти</button>
                </div>

                <div class="ui error message"></div>

            </form>

            {{--        <div class="ui message">--}}
            {{--            New to us? <a href="#">Sign Up</a>--}}
            {{--        </div>--}}
        </div>
    </div>
@endsection
