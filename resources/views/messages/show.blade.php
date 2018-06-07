@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->

    <h1>id = {{ $message->id }} のメッセージ詳細ページ</h1>

<table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $message->id }}</td>
        </tr>
        <tr>
            <th>タイトル</th>
            <td>{{ $message->title }}</td>
        </tr>
        <tr>
            <th>メッセージ</th>
            <td>{{ $message->content }}</td>
        </tr>
    </table>


    {!! link_to_route('messages.edit', 'このメッセージを編集', ['id' => $message->id], ['class' => 'btn btn-default']) !!}
        <!--
            URL の直入力以外でも edit ビューにアクセスできるように設置
        -->
    {!! Form::model($message, ['route' => ['messages.destroy', $message->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection