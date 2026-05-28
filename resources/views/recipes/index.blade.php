@extends('layouts.app')

@section('content')

    {{-- ページ上部のオレンジバナー --}}
    <div class="page-banner">
        <div class="container">
            <h1 class="page-banner-title">🍽️ レシピ一覧</h1>
            <p class="page-banner-desc">みんなの料理レシピを探してみよう</p>
        </div>
    </div>

    {{-- レシピカードの一覧 --}}
    <div class="container">
        <div class="recipe-grid">

            @foreach($recipes as $recipe)
            <div class="recipe-card">

                {{-- カード上部のオレンジのカラーバー --}}
                <div class="recipe-card-color"></div>

                {{-- カードの本文 --}}
                <div class="recipe-card-body">
                    <h2 class="recipe-card-title">{{ $recipe->title }}</h2>
                    <p class="recipe-card-desc">{{ $recipe->description }}</p>
                    {{-- 投稿者名を表示する --}}
                    <p style="font-size:0.85rem; color:#888; margin-bottom:12px;">
                        👤 {{ $recipe->user->name ?? '不明' }}
                    </p>

                    <a href="{{ route('recipes.show', $recipe->id) }}" class="recipe-card-link">
                        詳細を見る →
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>

@endsection