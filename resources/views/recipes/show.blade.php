@extends('layouts.app')

@section('content')

{{-- ページ上部のバナー --}}
<div class="page-banner">
    <div class="container">
        <h1 class="page-banner-title">{{ $recipe->title }}</h1>
        <p class="page-banner-desc">{{ $recipe->description }}</p>
    </div>
</div>

<div class="container">

    {{-- 戻るリンク --}}
    <a href="/recipes" class="back-link">← レシピ一覧に戻る</a>

    {{-- レシピカード --}}
    <div class="detail-card">

        {{-- 材料 --}}
        <div class="detail-section">
            <h2 class="detail-heading">🥕 材料</h2>
            <p class="detail-text">{{ $recipe->ingredients }}</p>
        </div>

        {{-- 作り方 --}}
        <div class="detail-section">
            <h2 class="detail-heading">📝 作り方</h2>
            <p class="detail-text">{{ $recipe->steps }}</p>
        </div>

        {{-- ボタンエリア --}}
        <hr class="detail-divider">
        <div class="button-area">

            {{--編集ボタン--}}
            <a href="/recipes/{{ $recipe->id}}/edit" class="btn btn-primary">✏️ 編集する</a>

            {{--削除ボタン--}}
            <form method="POST" action="/recipes/{{ $recipe->id}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">🗑️ 削除する</button>
            </form>
        </div>
    </div>
</div>
@endsection