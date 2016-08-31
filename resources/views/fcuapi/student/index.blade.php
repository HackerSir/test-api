@extends('app')

@section('title', '學生')

@section('content')
    <h2 class="ui teal header center aligned">
        學生
    </h2>
    <a href="{{ route('fcuapi.student.create') }}" class="ui icon brown inverted button">
        <i class="plus icon" aria-hidden="true"></i> 新增學生
    </a>
    <table class="ui selectable celled padded unstackable table">
        <thead>
        <tr style="text-align: center">
            <th class="single line">NID</th>
            <th class="single line">姓名</th>
            <th class="single line">班級</th>
            <th class="single line">入學年度</th>
            <th class="single line">性別</th>
            <th class="single line">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{ $student->stu_id }}</td>
                <td>{{ $student->stu_name }}</td>
                <td>
                    {{ $student->stu_class }}<br/>
                    （{{ $student->unit_name }} / {{ $student->dept_name }}）
                </td>
                <td>{{ $student->in_year }}</td>
                <td>{{ $student->stu_sex }}</td>
                <td class="four wide">
                    <a href="{{ route('fcuapi.student.edit', $student) }}" class="ui icon brown inverted button">
                        <i class="edit icon"></i> 編輯
                    </a>
                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['fcuapi.student.destroy', $student],
                        'style' => 'display: inline',
                        'onSubmit' => "return confirm('確定要刪除此學生嗎？');"
                    ]) !!}
                    <button type="submit" class="ui icon red inverted button">
                        <i class="trash icon"></i> 刪除
                    </button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('components.pagination-bar', ['models' => $students])
@endsection
