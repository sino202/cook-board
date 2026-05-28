@extends('layouts.app')

@section('content')

    {{-- ページ上部のバナー --}}
    <div class="page-banner">
        <div class="container">
            <h1 class="page-banner-title">✏️ レシピを編集する</h1>
            <p class="page-banner-desc">{{ $recipe->title }}</p>
        </div>
    </div>

    <div class="container">

        {{-- 戻るリンク --}}
        <a href="/recipes/{{ $recipe->id }}" class="back-link">← 詳細に戻る</a>

        {{-- フォームカード --}}
        <div class="form-card">

            <form method="POST" action="/recipes/{{ $recipe->id }}">
                @csrf
                @method('PUT')

                {{-- タイトル --}}
                <div class="form-group">
                    <label class="form-label">
                        タイトル
                        <span class="form-required">*</span>
                    </label>
                    <input type="text" name="title" class="form-control" value="{{ $recipe->title }}">
                </div>

                {{-- 説明 --}}
                <div class="form-group">
                    <label class="form-label">
                        説明
                        <span class="form-required">*</span>
                    </label>
                    <textarea name="description" class="form-control" rows="3">{{ $recipe->description }}</textarea>
                </div>

                {{-- 材料 --}}
                <div class="form-group">
                    <label class="form-label">
                        材料
                        <span class="form-required">*</span>
                    </label>
                    <textarea name="ingredients" class="form-control" rows="5">{{ $recipe->ingredients }}</textarea>
                    <p class="form-hint">1行に1つずつ書くと見やすいです</p>
                </div>

                {{-- 作り方 --}}
                <div class="form-group">
                    <label class="form-label">
                        作り方
                        <span class="form-required">*</span>
                    </label>
                    <textarea name="steps" class="form-control" rows="8">{{ $recipe->steps }}</textarea>
                    <p class="form-hint">番号をつけて書くとわかりやすいです</p>
                </div>

                {{-- 送信ボタン --}}
                <div class="form-submit">
                    <button type="submit" class="btn btn-primary">
                        💾 保存する
                    </button>
                    <a href="/recipes/{{ $recipe->id }}" class="btn-cancel">キャンセル</a>
                </div>

            </form>
        </div>
    </div>

@endsection