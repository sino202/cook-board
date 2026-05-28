@extends('layouts.app')

@section('content')

{{-- オレンジのバナー --}}
<div class="page-banner">
    <div class="container">
        <h1 class="page-banner-title">✏️ スレッド投稿</h1>
        <p class="page-banner-desc">みんなに話しかけてみよう！</p>
    </div>
</div>

{{-- 投稿フォーム --}}
<div class="container" style="max-width:600px; margin-top:40px;">
    <div class="recipe-card" style="padding:32px;">

        {{-- エラーメッセージ --}}
        @if ($errors->any())
            <div style="background:#F8D7DA;color:#721C24;padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:0.88rem;">
                ❌ {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/threads">
            @csrf

            {{-- タイトル入力欄 --}}
            <div class="form-group">
                <label class="form-label" for="title">タイトル</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    class="form-control"
                    placeholder="例：パスタの茹で方のコツを教えてください"
                    value="{{ old('title') }}"
                    required
                >
            </div>

            {{-- 本文入力欄 --}}
            <div class="form-group">
                <label class="form-label" for="body">本文</label>
                <textarea
                    id="body"
                    name="body"
                    class="form-control"
                    rows="6"
                    placeholder="詳しく書くとみんなから返信がもらいやすいですよ！"
                    required
                >{{ old('body') }}</textarea>
            </div>

            {{-- 送信ボタン --}}
            <button type="submit" class="btn btn-primary btn-full btn-lg">
                💬 投稿する
            </button>

        </form>

    </div>
</div>

@endsection