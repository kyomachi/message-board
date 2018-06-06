@extends('layouts.app')

@section('content')

    <h1>メッセージ一覧</h1>

    @if (count($messages) > 0)
        <ul>
            @foreach ($messages as $message)
                <!-- 配列 messages の中の各データを変数 message として一つずつ取り出す -->
                <!-- <li>{{ $message->content }}</li> -->
               <li>{!! link_to_route('messages.show', $message->id, ['id' => $message->id]) !!} : {{ $message->title }} > {{ $message->content }}</li>
            @endforeach

                <!-- 作成するリンクの内容は
                        1．'messages.show'            詳細ページ（show.blade.php）
                        2．$message->id               その id は MessagesController で設定したものを
                           　　　                        URLパラメーターとして設定する
                        3．['id' => $message->id]     表示する文字列 id には、3 と同じものを表示させる
                                                      文字列 id は show.blade.php に <h1>id ... とされているもの
                        4．{{ $message->content }}    MessagesController で設定した $message は content を取り出して表示する
                -->
        </ul>
    @endif

     {!! link_to_route('messages.create', '新規メッセージの投稿') !!}
@endsection