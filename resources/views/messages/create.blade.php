@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->

    <h1>メッセージ新規作成ページ</h1>

    <div class="row">
        <div class="col-xs-6">
            {!! Form::model($message, ['route' => ['messages.update', $message->id], 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('title', 'タイトル:') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('content', 'メッセージ:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('投稿', ['class' => 'btn btn-default']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection

<!-- フォームのコーディング方法と説明

1．フォームの全体
    Form::model() でフォームを開始、 Form::close() でフォームを終了。
    ・<form> 開始タグ、</form> 終了タグに対応しており、実際にそれらが生成される
    ・Form::model() 
        第一引数に対象となるModel のインスタンス

        第二引数は連想配列。

            連想配列にある、 'route' => 'messages.store' 
            'route' => ルーティング名 としてform タグの action 属性の設定を行っています。

                action 属性を 'messages.store' としているのは、
                この POST メソッドのフォームを受け取って処理するのは、
                次に解説する MessagesController の store アクションだからです。

                また、第二引数の連想配列に 'method' => 'post' を追加しても良いですが、
                フォームを作成するときはデフォルトで POST メソッドになるので今回は不要です。 

                    PUT メソッド（update）や DELETE メソッド（destroy）の場合には
                    'method' => 'put' や 'method' => 'delete' を付与することになります。

2．フォームの中のinput要素
    Form::label() は第一引数に Form::model($message, ...) で指定されていた
    Message モデルのインスタンスである $message（ MessagesController で設定した空のインスタンス ）に
    カラム（この場合 'content' カラム）を与え、第二引数にラベル名を与えます。

    Form::text() の第一引数は Form::label() と同じく $message の 'content' カラムを指定します。 
        Form::text() は <input type="text"> を生成するための関数です。
            他にも input 要素を生成するための関数としては 
            Form::password(), Form::email(), Form::select(), Form::checkbox(), Form::radio() などその他にもあります。
            参考ページ（https://laravelcollective.com/docs/5.4/html）を参照してください。

    Form::submit('投稿') は送信ボタンを生成する関数。
        第一引数にボタンに書かれる表示を与えます。
            送信すると、 Form::model($message, ['route' => 'messages.store']) の route で指定された
            action 属性へフォームの入力内容が送られます。

-->

