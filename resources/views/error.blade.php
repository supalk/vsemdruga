@extends('layouts.app')
@section('htmlheader_title')
    Ошибка!
@endsection

@section('content')
    <div class="ui red segment">
        <p>{{ $error }}</p>
    </div>
@endsection