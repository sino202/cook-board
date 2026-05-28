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