@extends('layouts.app')

@section('content')

    {{-- ページ上部のバナー --}}
    <div class="page-banner">
        <div class="container">
            <h1 class="page-banner-title">{{ $thread->title }}</h1>
            <p class="page-banner-desc"> 掲示板</p>
        </div>
    </div>

    <div class="container">

        {{-- 戻るリンク --}}
        <a href="{{ route('threads.index') }}" class="back-link">← 掲示板に戻る</a>

        {{-- 本文カード --}}
        <div class="detail-card">
            <div class="detail-section">
                <p class="detail-text">{{ $thread->body }}</p>
            </div>
        </div>

        {{-- 返信一覧 --}}
        <div class="detail-card">
            <h2 class="section-title">返信一覧</h2>
            {{-- このスレッドの返信を1つずつ取り出してループする。@forelse = 返信が0件のときは @empty の中を表示する！ --}}
            @forelse ($thread->replies as $reply)
                <div class="reply-card reply-border-{{ $reply->user->id % 7 }}">
                    <div class="reply-header">
                            <span class="recipe-author-icon user-color-{{ $reply->user->id % 7 }}">
                            {{ mb_substr($reply->user->name, 0, 1) }}
                        </span>
                        <span class="reply-user">{{ $reply->user->name }}</span>
                        {{-- created_at = この返信が投稿された日時。->format('Y/m/d H:i') = 日時の表示形式を指定する。例えば「2026/05/31 00:30」のように表示される --}}
                        <span class="reply-date">{{ $reply->created_at->format('Y/m/d H:i') }}</span>
                    </div>
                    <p class="reply-content">{{ $reply->content }}</p>

                    {{-- 返信削除ボタン（この返信を書いたユーザーと、スレッドの投稿者だけ見える） --}}
                    @if (Auth::id() === $reply->user_id)
                        <form action="{{ route('replies.destroy' , $reply) }}" method="POST">
                        @csrf                            
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline btn-lg">削除</button>
                        </form>
                    @endif
                </div>

            @empty
                <p class="empty-text">まだ返信がありません。最初の返信を書いてみましょう！</p>
            @endforelse
        </div>

        {{-- 返信フォーム(ログインしている人しか見れない) --}}
            @auth
                <div class="detail-card">
                    <h2 class="section-title">✏️ 返信する</h2>
                    {{-- actionでフォームの送信先URLを指定、宛先はreplies.store = web.php でつけた名前。？番スレッドの返信係。POSTでデータを送る。 --}}
                    {{-- 第一引数でweb.phpからurlの型を持ってくる、第二引数に入力した情報のIDを第一引数に入れてweb.phpにPOSTで送る --}}
                    <form action="{{ route('replies.store' , $thread)}}" method="POST">
                        @csrf
                        <textarea name="content" class="form-input" rows="4" placeholder="返信を入力してください" required></textarea>
                        <button type="submit" class="btn-primary">返信する</button>
                    </form>
                </div>
            @endauth   
    </div>

@endsection