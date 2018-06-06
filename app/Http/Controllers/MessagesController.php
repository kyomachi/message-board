<?php

namespace App\Http\Controllers;
// 名前空間の宣言
// App の中の Http の中の Controllers を示す

use Illuminate\Http\Request;

// Illuminate\Http\ などを Laravel API という
// Reruest はクラスを表す
// 以降のコードで、この階層にある Request クラスを指定したい場合に、
// Illuminate\Http\Request と長々と指定する必要がないようにする役割を持つ
// Request とだけ指定すればよくなる。

use App\Message;
/*
Controller は App\Message の Model 操作が主な役割なので、use App\Message; しておきます。
これでわざわざ App の名前空間を書かなくてよくなります。
*/

class MessagesController extends Controller

// class Messagescontroller はコントローラー名※ L9-8.1 参照
// extend はクラスの継承
// Controller クラスは Controller.php に定義されている

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // getでmessages/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        $messages = Message::all();
        /*変数 messages には、
          Message モデル（namespace、use がなければ App\Message）
          がデータベースで参照したレコードの一覧（::all()）が代入される*/
        
        /*基本的にモデルのためのクラス名（Message）は頭文字が大文字で単数形というのがセオリー*/

        return view('messages.index', [
        /* view()は、Controller から特定の Viewファイルを呼び出す
          （コントローラに選択された適切な Model が埋め込まれる）
          （ここでの viewファイルは index.blade.php）
          
           messages.index となっているのは、
           index.blade.php が resouces/views/messages/index.blade.php に配置されているため。
           resources/views 以下にフォルダがある場合には フォルダ名.ファイル名 という形で指定する。
           
           return view で返された値がどうなるかなど、Laravel の仕組みを読み取ることは、
           講座内ではしない
        */
            'messages' => $messages,
            /* 連想配列
               左側の 'messages' は
               viewファイル（index.blade.php）で
               データの呼び出しに使うための変数名をここで指定している。
               
               'messages'という名前には特に命名規則はなく、例えば
               'test' として、view ファイル（index.blade.php）内で'test'を使えば、
               $messages という変数の中身が呼び出されて、
               viewファイル（index.blade.php）に表示される
               
               $messages = Message::all(); としただけでは、Viewファイル（index.blade.php）
               にはデータが渡らないので、ここで指定しています*/
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     // getでmessages/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        $message = new Message;
        /*
            Message モデルのためのフォームなので、
            フォームの入力項目のために $message = new Message; でインスタンスを作成
        */
        
        /*
            Message モデルの空のインスタンスを作成
                データベースには登録しておらず、インスタンスの作成のみ。
                    このファイルはコントローラー側。
                        create.blade.php（ビュー側）でモデルの値を表示するので、
                        create.blade.php（ビュー側）にモデルのインスタンスを渡す必要がある。
        */
 
        /*5-5 の tinker でのモデルのインスタンス作成は、
          作成後、値をセットし、データベースに登録まで行われております。*/

        return view('messages.create', [
        /* view()は、Controller から特定の Viewファイルを呼び出す
          （コントローラに選択された適切な Model が埋め込まれる）
          （ここでの viewファイルは create.blade.php）
          
           messages.create となっているのは、
           create.blade.php が resouces/views/messages/create.blade.php に配置されているため。
           resources/views 以下にフォルダがある場合には フォルダ名.ファイル名 という形で指定する。
           
           return view で返された値がどうなるかなど、Laravel の仕組みを読み取ることは、
           講座内ではしない
        */
            'message' => $message,
            /* 連想配列
               'message'は
               viewファイル（create.blade.php）で
               データの呼び出しに使うための変数名をここで指定している。
               
               'message'という名前には特に命名規則はなく、例えば
               'test' として、view ファイル（create.blade.php）内で'test'を使えば、
               $message というインスタンスが呼び出されて、
               viewファイル（create.blade.php）に表示される*/
               
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
     // postでmessages/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
     // 保存するのはリクエストクラスから生成されたリクエストインスタンス
    {
        $this->validate($request, [
            'title' => 'required|max:191',
            'content' => 'required|max:191',
        ]);

        $message = new Message;
        /*
            Message モデルの空のインスタンスを作成
                データベースには登録しておらず、インスタンスの作成のみ。
                    このファイルはコントローラー側。
                        store.blade.php（ビュー側）でモデルの値を表示するので、
                        store.blade.php（ビュー側）にモデルのインスタンスを渡す必要がある。
        */

        $message->title = $request->title;
        $message->content = $request->content;

        /*
            $messeage インスタンスが呼び出したメッセージ（content カラム）には
            $repuest インスタンスが呼び出したメッセージ（content カラム）が代入される
        */

        $message->save();

        /*
            $message インスタンスを保存する
        */

        return redirect('/');

        /*
            View を返さずに / へリダイレクト（自動でページを移動）させています。
            View を作成しても良いですが、わざわざ作成する必要もないでしょう。
        */

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     // getでmessages/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        $message = Message::find($id);

         /*変数 message には、
          Message モデル（namespace、use がなければ App\Message）
          がデータベースで参照したレコードの一覧（::all()）が代入される*/
        
        /*基本的にモデルのためのクラス名（Message）は頭文字が大文字で単数形というのがセオリー*/
        
        /*$id が指定されているので、 Message::find($id) によって1つだけ取得します。
          そのため、 $message 変数も単数形の命名にしています。*/
          
        return view('messages.show', [
         /* view()は、Controller から特定の Viewファイルを呼び出す
          （コントローラに選択された適切な Model が埋め込まれる）
          （ここでの viewファイルは show.blade.php）
          
           messages.show となっているのは、
           show.blade.php が resouces/views/messages/show.blade.php に配置されているため。
           resources/views 以下にフォルダがある場合には フォルダ名.ファイル名 という形で指定する。
           
           return view で返された値がどうなるかなど、Laravel の仕組みを読み取ることは、
           講座内ではしない
        */
            'message' => $message,
        ]);
            /* 連想配列
               'message'は
               viewファイル（show.blade.php）で
               データの呼び出しに使うための変数名をここで指定している。
               
               'message'という名前には特に命名規則はなく、例えば
               'test' として、view ファイル（show.blade.php）内で'test'を使えば、
               $message という変数の中身が呼び出されて、
               viewファイル（show.blade.php）に表示される
               
               $messages = Message::find($id); としただけでは、Viewファイル（show.blade.php）
               にはデータが渡らないので、ここで指定しています*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     // getでmessages/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        $message = Message::find($id);

         /*変数 message には、
          Message モデル（namespace、use がなければ App\Message）
          がデータベースで参照したレコードの一覧（::all()）が代入される*/
        
        /*基本的にモデルのためのクラス名（Message）は頭文字が大文字で単数形というのがセオリー*/
        
        /*$id が指定されているので、 Message::find($id) によって1つだけ取得します。
          そのため、 $message 変数も単数形の命名にしています。*/

        return view('messages.edit', [
            /* view()は、Controller から特定の Viewファイルを呼び出す
          （コントローラに選択された適切な Model が埋め込まれる）
          （ここでの viewファイルは edit.blade.php）
          
           messages.edit となっているのは、
           edit.blade.php が resouces/views/messages/edit.blade.php に配置されているため。
           resources/views 以下にフォルダがある場合には フォルダ名.ファイル名 という形で指定する。
           
           return view で返された値がどうなるかなど、Laravel の仕組みを読み取ることは、
           講座内ではしない
        */
            'message' => $message,
            /* 連想配列
               'message'は
               viewファイル（edit.blade.php）で
               データの呼び出しに使うための変数名をここで指定している。
               
               'message'という名前には特に命名規則はなく、例えば
               'test' として、view ファイル（show.blade.php）内で'test'を使えば、
               $message という変数の中身が呼び出されて、
               viewファイル（edit.blade.php）に表示される
               
               $messages = Message::find($id); としただけでは、Viewファイル（edit.blade.php）
               にはデータが渡らないので、ここで指定しています*/
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     // putまたはpatchでmessages/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    
    /* 更新するのは、あるidを持っている、リクエストクラスから生成されたリクエストインスタンス */
    {
        $this->validate($request, [
            'title' => 'required|max:191',
            'content' => 'required|max:191',
        ]);

        $message = Message::find($id);
        /*変数 message には、
          Message モデル（namespace、use がなければ App\Message）
          がデータベースで参照したレコードの一覧（::all()）が代入される*/
        
        /*基本的にモデルのためのクラス名（Message）は頭文字が大文字で単数形というのがセオリー*/
        
        /*$id が指定されているので、 Message::find($id) によって1つだけ取得します。
          そのため、 $message 変数も単数形の命名にしています。*/

        $message->title = $request->title;
        $message->content = $request->content;
        /*
            $messeage インスタンスが呼び出したメッセージ（content カラム）には
            $repuest インスタンスが呼び出したメッセージ（content カラム）が代入される
        */
        $message->save();
        /*
            $message インスタンスを保存する
        */
        return redirect('/');
        /*
            View を返さずに / へリダイレクト（自動でページを移動）させています。
            View を作成しても良いですが、わざわざ作成する必要もないでしょう。
        */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     // deleteでmessages/idにアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        $message = Message::find($id);
        /*
        'message'は
            viewファイル（update.blade.php）でデータの呼び出しに使うための変数名をここで指定している。
               
               'message'という名前には特に命名規則はなく、例えば
               'test' として、view ファイル（update.blade.php）内で'test'を使えば、
               $message という変数の中身が呼び出されて、viewファイル（update.blade.php）に表示される

                    $messages = Message::find($id); としただけでは、
                    Viewファイル（update.blade.php）にはデータが渡らないので、ここで指定しています
        */
        $message->delete();
        /*
        Message モデルから抽出された id を持つ $message を削除する
        delete は モデルで使用する CRUD 関数
        */

        return redirect('/');
        /*
            View を返さずに / へリダイレクト（自動でページを移動）させています。
            View を作成しても良いですが、わざわざ作成する必要もないでしょう。
        */
    }
}
