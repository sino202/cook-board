<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    // スレッド一覧を表示する
    public function index()
    {
        $threads = Thread::with('user')->get();
        return view('threads.index', compact('threads'));
    }

    // 投稿フォームの画面を表示する
    public function create()
    {
        return view('threads.create');
    }

    // フォームの内容を受け取ってDBに保存する
    public function store(Request $request)
    {
        Thread::create([
            'title'   => $request->title,
            'body'    => $request->body,
            'user_id' => Auth::id(),
        ]);
        return redirect('/threads');
    }

    // スレッド詳細を表示する
    public function show(Thread $thread)
    {
        return view('threads.show', compact('thread'));
    }

    //返信を保存する。引数が$request = フォームから送られてきたデータ。$thread = URLの {thread} の部分。どのスレッドか自動で取得してくれる！
    public function storeReply(Request $request , Thread $thread)
    {
        //このスレッドの返信として保存してっていう命令。php artisan migrate を実行したときに作られた replies という引き出しに、返信のデータが保存される
        //$thread->replies()->create() と書くと自動でthread_idを入れてくれる
        $thread->replies()->create([
            //フォームから送られてきた返信の文章を content カラムに保存する。
            'content' => $request->content,
            //今ログインしているユーザーのIDを user_id カラムに保存する。誰が書いたかを自動で記録！
            'user_id' => Auth::id(),
        ]);
        //保存が終わったらそのスレッドの詳細ページに戻る。例えばスレッド3番なら /threads/3 に戻る
        return redirect()->route('threads.show', $thread);
    }
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}