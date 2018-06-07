@extends('layouts.app')

@section('content')

    <h1>メッセージ一覧</h1>

    @if (count($messages) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>タイトル</th>
                    <th>メッセージ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <!-- 配列 messages の中の各データを変数 message として一つずつ取り出す -->
                <tr>
                    <td>{!! link_to_route('messages.show', $message->id, ['id' => $message->id]) !!}</td>
                    <td>{{ $message->title }}</td>
                    <td>{{ $message->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
                <!-- 作成するリンクの内容は
                        1．'messages.show'            詳細ページ（show.blade.php）
                        2．$message->id               その id は MessagesController で設定したものを
                           　　　                        URLパラメーターとして設定する
                        3．['id' => $message->id]     表示する文字列 id には、3 と同じものを表示させる
                                                      文字列 id は show.blade.php に <h1>id ... とされているもの
                        4．{{ $message->content }}    MessagesController で設定した $message は content を取り出して表示する
                -->
    @endif

         {!! link_to_route('messages.create', '新規メッセージの投稿', null, ['class' => 'btn btn-primary']) !!}
            <!-- 第三引数には、 ['id' => 1] のようなリンクを作るためのパラメータが入る
                 第四引数には、 ['class' => 'btn btn-primary'] のような HTML タグの属性が入る -->

@endsection