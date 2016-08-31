@extends('app')

@php($isEditMode = isset($client))
@php($methodText = $isEditMode ? '編輯' : '新增')

@section('title', $methodText . 'Client')

@section('content')
    <h2 class="ui teal header center aligned">
        {{ $methodText }}Client
    </h2>
    @if($isEditMode)
        {!! SemanticForm::open()->action(route('fcuapi.client.update', $client))->patch() !!}
        {!! SemanticForm::bind($client) !!}
    @else
        {!! SemanticForm::open()->action(route('fcuapi.client.store')) !!}
    @endif
    <div class="ui stacked segment">
        {!! SemanticForm::text('client_id')->label('Client ID')->placeholder('如：123456789、abcdef')->required() !!}
        <div style="text-align: center">
            <a href="{{ route('fcuapi.client.index') }}" class="ui blue inverted icon button">
                <i class="icon arrow left"></i> 返回列表
            </a>
            {!! SemanticForm::submit('<i class="checkmark icon"></i> 確認')->addClass('ui icon submit red inverted button') !!}
        </div>
    </div>
    @if($errors->count())
        <div class="ui error message" style="display: block">
            <ul class="list">
                @foreach($errors->all('<li>:message</li>') as $error)
                    {!! $error !!}
                @endforeach
            </ul>
        </div>
    @endif
    {!! SemanticForm::close() !!}
@endsection
