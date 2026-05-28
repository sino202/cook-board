@extends('layouts.app')

@section('content')

    {{-- ページ上部のバナー --}}
    <div class="page-banner">
        <div class="container">
            <h1 class="page-banner-title">📝 新規登録</h1>
            <p class="page-banner-desc">アカウントを作成して料理を楽しもう！</p>
        </div>
    </div>

    {{-- 登録フォームカード --}}
    <div class="auth-container">
        <div class="form-card">

            {{-- エラーメッセージ（入力が間違っていたとき表示） --}}
            @if ($errors->any())
                <div class="auth-errors">
                    @foreach ($errors->all() as $error)
                        <p>❌ {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="/register">
                {{-- セキュリティのおまじない（必須） --}}
                @csrf

                {{-- 名前 --}}
                <div class="form-group">
                    <label class="form-label">
                        名前 <span class="form-required">*</span>
                    </label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        placeholder="例）料理太郎"
                        value="{{ old('name') }}"
                    >
                </div>

                {{-- メールアドレス --}}
                <div class="form-group">
                    <label class="form-label">
                        メールアドレス <span class="form-required">*</span>
                    </label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="例）taro@example.com"
                        value="{{ old('email') }}"
                    >
                </div>

                {{-- パスワード --}}
                <div class="form-group">
                    <label class="form-label">
                        パスワード <span class="form-required">*</span>
                    </label>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="8文字以上"
                    >
                </div>

                {{-- パスワード確認 --}}
                <div class="form-group">
                    <label class="form-label">
                        パスワード（確認） <span class="form-required">*</span>
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="もう一度入力"
                    >
                </div>

                {{-- 登録ボタン --}}
                <div class="form-submit">
                    <button type="submit" class="btn btn-primary btn-full">
                        🚀 アカウント作成
                    </button>
                </div>

            </form>

            {{-- ログインページへのリンク --}}
            <p class="auth-switch">
                すでにアカウントをお持ちの方は
                <a href="/login">ログインはこちら</a>
            </p>

        </div>
    </div>

@endsection
