@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->

    <h1>id: {{ $message->id }} のメッセージ編集ページ</h1>

    <!--
        $message インスタンス（ MessagesController で設定したもの ）から id を表示
            この $message インスタンスは $message = Message::find($id); としてセットされている。
    -->

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

                {!! Form::submit('更新', ['class' => 'btn btn-default']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection

    <!--
        1．フォームの全体
            Form::model() でフォームを開始、 Form::close() でフォームを終了。
                ・<form> 開始タグ、</form> 終了タグに対応しており、実際にそれらが生成される
                ・Form::model() 
                        第一引数に対象となるModel のインスタンス

                        第二引数は連想配列。

                        'route' => ルーティング名 としてform タグの action 属性の設定を行っています。

                        action 属性を 'messages.update' としているのは、
                        この GET メソッド（edit）のフォームを受け取って処理するのは、
                        次に解説する MessagesController の update アクションだからです。
                        
                            連想配列に 'method' => 'put' を追加しているのはそのためです。

                        store と違って update のルーティングには$message->id を渡す必要があります。
                            'route' => ['messages.update', $message->id] と指定。
                                配列の2つ目に $message->id を入れることで
                                update の URL である/messages/{message} の {message} に id が入ります。 

    -->

    <!--
        2.フォームの中のinput要素
            Form::label() は第一引数に Form::model($message, ...) で指定されていた
            Message モデルのインスタンスである $message（ tinker で値をセットし、データベースに登録したインスタンス）の
            カラム（この場合 'content' カラム）に入力フォーム用の名前をつけています。
            第二引数にラベル名とすることで、具体的な入力フォーム用の名前をセットします。

            Form::text() の第一引数は Form::label() と同じく
            $message（ tinker で値をセットし、データベースに登録したインスタンス） の 'content' カラムを指定します。 
            
                Form::text() は <input type="text"> を生成するための関数です。
                    他にも input 要素を生成するための関数としては 
                    Form::password(), Form::email(), Form::select(), Form::checkbox(), Form::radio() などもあります。
                        参考ページ（https://laravelcollective.com/docs/5.4/html）を参照してください。

                edit 特有の補足
                    Controller の edit アクションで実行されている、 $message = Message::find($id) 
                    それによって取得される $message には content が最初から入っています。
                    （既存メッセージの編集なので）
                    
                        そのため、edit.blade.php のフォーム内にある {!! Form::text('content') !!} では、
                        最初からその値が入っています。

                            インスタンスに入力された値が自動的に入力されているということが 
                            Form::model() を使う大きな利点と言えるでしょう。

            Form::submit('更新') は更新ボタンを生成する関数。
                第一引数にボタンに書かれる表示を与えます。
                    送信すると、 Form::model($message, ['route'...]) の route で指定された
                    action 属性へフォームの入力内容が送られます。

    -->
