@extends('app')

@section('title', '錯誤')

@section('content')
    <div class="ui large aligned center aligned grid">
        <div class="six wide column">
            <h2 class="ui teal header">
                OAuth Login
            </h2>
            <div class="ui stacked segment">
                {{ $message }}
            </div>
        </div>
    </div>
@endsection
