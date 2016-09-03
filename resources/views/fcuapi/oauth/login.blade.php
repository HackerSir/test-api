@extends('app')

@section('title', '登入')

@section('content')
    <div class="ui large aligned center aligned relaxed stackable grid">
        <div class="six wide column">
            <h2 class="ui teal header">
                OAuth Login
            </h2>
            {!! SemanticForm::open()->action(route('fcuapi.login'))->addClass('large') !!}
            <div class="ui stacked segment">
                <div class="field{{ $errors->has('nid') ? ' error' : '' }}">
                    <div class="ui left icon input">
                        <i class="mail icon"></i>
                        {!! SemanticForm::text('nid')->placeholder('NID')->required() !!}
                    </div>
                </div>
                <div class="field{{ $errors->has('password') ? ' error' : '' }}">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        {!! SemanticForm::password('password')->placeholder('Password')->required() !!}
                    </div>
                </div>
                {!! SemanticForm::submit('Login')->addClass('fluid large teal submit') !!}
            </div>

            @if($errors->count())
                <div class="ui error message" style="display: block">
                    <ul class="list">
                        <li>使用者帳號或密碼有誤</li>
                    </ul>
                </div>
            @endif
            {!! SemanticForm::close() !!}
        </div>
    </div>
@endsection
