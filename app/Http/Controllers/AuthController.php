<?php

namespace App\Http\Controllers; // このファイルは App\Http\Controllers というフォルダにありますよ、という宣言。

use App\Models\User; //Userモデル（さっき確認したファイル）を使いますよ、という宣言。現実に例えると「会員名簿を持ってきて」という命令。
use Illuminate\Http\Request; // フォームから送られてきたデータを受け取るための道具を使いますよ、という宣言
use Illuminate\Support\Facades\Auth; //Authファサード（Laravelの認証機能を使うためのクラス）を使いますよ、という宣言。現実に例えると「会員証を確認するための機械を持ってきて」という命令。
use Illuminate\Support\Facades\Hash; //Hashファサード（パスワードを安全に保存するためのクラス）を使いますよ、という宣言。現実に例えると「パスワードを暗号化するための機械を持ってきて」という命令。

class AuthController extends Controller
{
    //新規登録フォームを表示する
    public function showRegister()
    {
        return view('auth.register');
    }

    // フォームの内容を受け取ってユーザーを登録する
    public function register(Request $request)
    {
        //入力内容のチェック（バリデーション）。| で区切って複数のルールを書ける。
        $request->validate([
            //nameは必須・最大255文字
            'name' => 'required|max:255',
            // email は必須・メール形式・他とのメールアドレス重複NG
            'email' => 'required|email|unique:users',
            // password は必須・最低8文字。confirmed = password_confirmation 欄と一致しているか確認
            'password' => 'required|min:8|confirmed',
        ]);

        //ユーザーをデータベースに保存する
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            // Hash::make でパスワードを暗号化して保存
            'password' => Hash::make($request->password),
        ]);
        
         // トップページへリダイレクト
        Auth::login($user);
        return redirect('/');
    }



    // /login にアクセスしたとき、ログインフォームを表示する。
    public function showLogin()
    {
        return view('auth.login');
    }
    
    //メールとパスワードを確認してログインさせる
    public function login(Request $request)
    {
        //入力内容のチェック
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //メール・パスワードが合っているか確認してログイン
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // セッションを新しく作る（セキュリティ対策）
            $request->session()->regenerate();
            // トップページへ
            return redirect('/');
        }
        
        //ログイン失敗のときエラーを返す。 照合NG！エラーメッセージを持ってフォームに戻る
        return back()->withErrors([
            'email' => 'メールアドレスかパスワードが間違っています',
        ]);
    }

        public function logout(Request $request)
        {
            //ログアウト管理
            Auth::logout();

            //セッションを削除する
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            //ログインページへ戻す
            return redirect('/login');
        }
    
}
