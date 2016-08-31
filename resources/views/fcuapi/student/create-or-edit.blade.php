@extends('app')

@php($isEditMode = isset($student))
@php($methodText = $isEditMode ? '編輯' : '新增')

@section('title', $methodText . '學生')

@section('content')
    <h2 class="ui teal header center aligned">
        {{ $methodText }}學生
    </h2>
    @if($isEditMode)
        {!! SemanticForm::open()->action(route('fcuapi.student.update', $student))->patch() !!}
        {!! SemanticForm::bind($student) !!}
    @else
        {!! SemanticForm::open()->action(route('fcuapi.student.store')) !!}
    @endif
    <div class="ui stacked segment">
        {!! SemanticForm::text('stu_id')->label('NID')->required() !!}
        {!! SemanticForm::text('stu_name')->label('姓名')->required() !!}
        {!! SemanticForm::text('stu_class')->label('班級') !!}
        {!! SemanticForm::text('unit_name')->label('科系') !!}
        {!! SemanticForm::text('dept_name')->label('學院') !!}
        {!! SemanticForm::text('in_year')->label('入學年度') !!}
        {!! SemanticForm::select('stu_sex')->label('性別')->options([null=>'-','M'=>'M','F'=>'F']) !!}
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
