@extends('layouts.app')

@section('content')

    {{-- ヒーローセクション --}}
    <section class="hero">
        <div class="container">

            {{-- 左側：テキスト --}}
            <div class="hero-content">
                <div class="hero-tag">🍳 みんなの料理コミュニティ</div>
                <h1 class="hero-title">料理を<span>楽しく</span><br>シェアしよう</h1>
                <p class="hero-desc">レシピを投稿して、みんなと料理の喜びを共有しよう。<br>掲示板でコミュニケーションを楽しもう！</p>
                <div class="hero-actions">
                    <a href="/recipes" class="btn btn-primary btn-lg">🍽️ レシピを見る</a>
                    <a href="/threads" class="btn btn-outline btn-lg">💬 掲示板へ</a>
                </div>
            </div>

            {{-- 右側：絵文字グリッド --}}
            <div class="hero-visual">
                <div class="hero-emoji-grid">
                    <div class="hero-emoji">🍱</div>
                    <div class="hero-emoji">🍝</div>
                    <div class="hero-emoji">🍰</div>
                    <div class="hero-emoji">🥗</div>
                    <div class="hero-emoji">🍳</div>
                    <div class="hero-emoji">🥟</div>
                    <div class="hero-emoji">🍜</div>
                    <div class="hero-emoji">🍣</div>
                    <div class="hero-emoji">🥘</div>
                </div>
            </div>

        </div>
    </section>

    {{-- 新着レシピセクション --}}
    <section class="home-section">
        <div class="container">
            {{-- セクションのタイトル --}}
            <div class="home-section-header">
                <h2 class="home-section-title">🍽️ 新着レシピ</h2>
                <a href="/recipes" class="home-section-link">すべて見る →</a>
            </div>

            {{-- レシピを３件並べて表示する --}}
            <div class="recipe-grid">
                @forelse ($recipes as $recipe)
                    <a href="{{ route('recipes.show', $recipe) }}" class="recipe-card">
                        <div class="recipe-card-color"></div>
                        <div class="recipe-card-body">
                            <div class="recipe-card-author">
                                <span class="recipe-author-icon">{{ mb_substr($recipe->user->name, 0, 1) }}</span>
                                {{ $recipe->user->name }}
                            </div>
                            <h3 class="recipe-card-title">{{ $recipe->title }}</h3>
                            <p class="recipe-card-desc">{{ $recipe->description }}</p>
                            <span class="recipe-card-link">レシピを見る →</span>
                        </div>                     
                    </a>
                @empty
                    <p>まだレシピがありません。</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- 新着スレッドセクション --}}
    <section class="home-section">
        <div class="container">

            {{-- セクションのタイトル --}}
            <div class="home-section-header">
                <h2 class="home-section-title">💬 新着スレッド</h2>
                <a href="/threads" class="home-section-link">すべて見る →</a>
            </div>

            {{-- スレッドを3件並べて表示する --}}
            <div class="thread-list">
                @forelse ($threads as $thread)
                    <a href="{{ route('threads.show', $thread) }}" class="thread-item">
                        <div class="thread-icon">💬</div>
                        <div class="thread-info">
                            <p class="thread-title">{{ $thread->title }}</p>
                            <p class="thread-meta">{{ $thread->body }}</p>
                        </div>
                    </a>
                @empty
                    <p>まだスレッドがありません。</p>
                @endforelse
            </div>

        </div>
    </section>

@endsection