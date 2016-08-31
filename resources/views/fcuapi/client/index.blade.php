@extends('app')

@section('title', 'Client')

@section('content')
    <h2 class="ui teal header center aligned">
        Client
    </h2>
    <a href="{{ route('fcuapi.client.create') }}" class="ui icon brown inverted button">
        <i class="plus icon" aria-hidden="true"></i> 新增Client
    </a>
    <table class="ui selectable celled padded unstackable table">
        <thead>
        <tr style="text-align: center">
            <th class="single line">Client ID</th>
            <th class="single line">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clients as $client)
            <tr>
                <td>
                    {{ $client->client_id }}
                </td>
                <td class="four wide">
                    <a href="{{ route('fcuapi.client.edit', $client) }}" class="ui icon brown inverted button">
                        <i class="edit icon"></i> 編輯Client
                    </a>
                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['fcuapi.client.destroy', $client],
                        'style' => 'display: inline',
                        'onSubmit' => "return confirm('確定要刪除此Client嗎？');"
                    ]) !!}
                    <button type="submit" class="ui icon red inverted button">
                        <i class="trash icon"></i> 刪除Client
                    </button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
