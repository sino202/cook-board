{{-- layouts/app.blade.php を土台として使う --}}
@extends('layouts.app')

{{-- ブラウザのタブに表示されるタイトル --}}
@section('title', 'ログイン')

{{-- ここからページの中身 --}}
@section('content')

{{-- オレンジのバナー部分 --}}
<div class="page-banner">
    <div class="container">
        <h1 class="page-banner-title">🔑 ログイン</h1>
        <p class="page-banner-desc">アカウントにログインしよう</p>
    </div>
</div>

{{-- フォーム全体を囲む白いカード --}}
<div class="auth-page">
    <div class="auth-card">

        {{-- エラーメッセージ（メール・パスワードが違うときに表示） --}}
        @if ($errors->any())
            <div style="background:#F8D7DA;color:#721C24;padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:0.88rem;">
                ❌ {{ $errors->first() }}
            </div>
        @endif

        {{-- ログインフォーム --}}
        <form method="POST" action="/login">

            {{-- Laravelのセキュリティ用おまじない（必須！） --}}
            @csrf

            {{-- メールアドレス入力欄 --}}
            <div class="form-group">
                <label class="form-label" for="email">メールアドレス</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    placeholder="your@email.com"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                >
            </div>

            {{-- パスワード入力欄（👁️ボタン付き） --}}
            <div class="form-group">
                <label class="form-label" for="password">パスワード</label>
                <div style="position:relative;">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="パスワードを入力"
                        required
                        autocomplete="current-password"
                        style="padding-right:44px;"
                    >
                    {{-- 👁️ボタン：クリックするとパスワードの表示・非表示が切り替わる --}}
                    <button
                        type="button"
                        onclick="togglePassword('password', this)"
                        style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;font-size:1.1rem;"
                    >👁️</button>
                </div>
            </div>

            {{-- ログインボタン --}}
            <button type="submit" class="btn btn-primary btn-full btn-lg">
                🔑 ログインする
            </button>

        </form>

        {{-- 区切り線 --}}
        <div class="auth-divider">または</div>

        {{-- 新規登録へのリンク --}}
        <div class="auth-switch">
            アカウントをお持ちでない方は
            <a href="/register">新規登録はこちら</a>
        </div>

    </div>
</div>

{{-- 👁️ボタンのJavaScript --}}
<script>
function togglePassword(id, btn) {
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
    btn.textContent = input.type === 'password' ? '👁️' : '🙈';
}
</script>


@endsection