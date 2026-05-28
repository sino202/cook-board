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

@endsection