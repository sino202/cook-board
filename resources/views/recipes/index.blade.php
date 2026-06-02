@extends('layouts.app')

@section('content')

    {{-- ページ上部のバナー --}}
    <div class="page-banner">
        <div class="container">
            <h1 class="page-banner-title">レシピ一覧</h1>
            <p class="page-banner-desc">みんなの料理レシピを探してみよう</p>
        </div>
    </div>

    <div class="container">
        <div class="recipe-grid">

            @foreach($recipes as $recipe)
            <div class="recipe-card">

                {{-- 画像エリア --}}
                <div class="recipe-card-img">
                    @if($recipe->image)
                        {{-- 画像がある場合は表示する --}}
                        <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}">
                    @else
                        {{-- 画像がない場合はプレースホルダーを表示 --}}
                        <div class="recipe-no-img">🍳</div>
                    @endif
                </div>

                {{-- カードの本文 --}}
                <div class="recipe-card-body">
                    <h2 class="recipe-card-title">{{ $recipe->title }}</h2>
                    <p class="recipe-card-desc">{{ $recipe->description }}</p>

                    {{-- 投稿者アイコンと名前 --}}
                    <div class="recipe-card-author">
                        {{-- 名前の最初の1文字をアイコンとして表示 --}}
                        <div class="recipe-author-icon user-color-{{ ($recipe->user->id ?? 0) % 7 }}">
                            {{ mb_substr($recipe->user->name ?? '?', 0, 1) }}
                        </div>
                        <span>{{ $recipe->user->name ?? '不明' }}</span>
                    </div>

                    <a href="{{ route('recipes.show', $recipe->id) }}" class="recipe-card-link">
                        詳細を見る →
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>

@endsection