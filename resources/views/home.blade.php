@extends('layouts.app')

@section('content')
    {{-- ヒーローセクション --}}
    <section class="hero">
        <div class="container">

            {{-- 上段：テキスト＋食材カード --}}
            <div class="hero-top">

                {{-- 左側：テキスト --}}
                <div class="hero-content">
                    <div class="hero-tag">料理初めての方に向けたコミュニティーサイト</div>
                    <h1 class="hero-title">料理を<span>楽しく</span><br>シェアしよう</h1>
                    <p class="hero-desc">レシピを投稿して、みんなと料理の喜びを共有しよう。<br>掲示板でコミュニケーションを楽しもう！</p>
                    <div class="hero-actions">
                        <a href="/recipes" class="btn btn-primary btn-lg">レシピを見る</a>
                        <a href="/threads" class="btn btn-outline btn-lg">掲示板へ</a>
                    </div>
                </div>

                {{-- 右側：今日の食材カード --}}
                <div class="hero-visual">
                    <div class="food-tip-card" id="foodTipCard">
                        <div class="food-tip-emoji" id="foodTipEmoji"></div>
                        <div class="food-tip-body">
                            <p class="food-tip-date" id="foodTipDate"></p>
                            <h3 class="food-tip-name" id="foodTipName"></h3>
                            <p class="food-tip-desc" id="foodTipDesc"></p>
                            <div class="food-tip-tags" id="foodTipTags"></div>
                            <p class="food-tip-tomorrow" id="foodTipTomorrow"></p>
                        </div>
                    </div>
                </div>

            </div>{{-- hero-top ここまで --}}

            {{-- 下段：紹介動画 --}}
            <div class="hero-video-box">
                <video class="hero-video" autoplay muted loop playsinline>
                    <source src="{{ asset('videos/hero.mp4') }}" type="video/mp4">
                </video>
            </div>

        </div>{{-- container ここまで --}}
    </section>

    {{-- 新着レシピセクション --}}
    <section class="home-section">
        <div class="container">
            {{-- セクションのタイトル --}}
            <div class="home-section-header">
                <h2 class="home-section-title"> 新着レシピ</h2>
                <a href="/recipes" class="home-section-link">すべて見る →</a>
            </div>

            {{-- レシピを３件並べて表示する --}}
            <div class="recipe-grid">
                @forelse ($recipes as $recipe)
                    <a href="{{ route('recipes.show', $recipe) }}" class="recipe-card">
                        @if($recipe->image)
                            <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="recipe-card-img-thumb">
                        @else
                            <div class="recipe-card-color card-border-{{ $recipe->user->id % 7 }}"></div>
                        @endif
                        <div class="recipe-card-body">
                            <div class="recipe-card-author">
                                <span class="recipe-author-icon user-color-{{ $recipe->user->id % 7 }}">{{ mb_substr($recipe->user->name, 0, 1) }}</span>
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
                <h2 class="home-section-title">新着スレッド</h2>
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


    {{-- 今日の食材豆知識のJavaScript --}}
    <script>
        // 食材データ（12個）
        const foods = [
            { name: 'トマト',     emoji: '🍅', desc: 'リコピンが豊富で、加熱すると栄養の吸収率がアップします！イタリア料理との相性が抜群。', tags: ['夏野菜', '栄養満点'] },
            { name: 'ブロッコリー', emoji: '🥦', desc: 'ビタミンCが豊富で免疫力アップに効果的。茎の部分も栄養たっぷりです！', tags: ['緑黄色野菜', '栄養満点'] },
            { name: 'にんじん',   emoji: '🥕', desc: 'βカロテンが豊富で油と一緒に食べると吸収率アップ。甘みが強く子どもにも人気。', tags: ['根菜', '彩り野菜'] },
            { name: 'たまご',     emoji: '🥚', desc: '完全栄養食とも呼ばれる万能食材。毎日食べても問題なし！', tags: ['タンパク質', '万能食材'] },
            { name: 'じゃがいも', emoji: '🥔', desc: 'ビタミンCが豊富で加熱しても壊れにくい。腹持ちが良くエネルギー源になります。', tags: ['根菜', '主食系'] },
            { name: 'キャベツ',   emoji: '🥬', desc: 'ビタミンUが胃腸を守ります。生でも加熱しても美味しい万能野菜。', tags: ['葉野菜', '胃に優しい'] },
            { name: 'さけ',       emoji: '🐟', desc: 'アスタキサンチンが抗酸化作用を発揮。オメガ3脂肪酸も豊富です。', tags: ['魚介類', '栄養満点'] },
            { name: 'たまねぎ',   emoji: '🧅', desc: '硫化アリルが血液をサラサラに。加熱すると甘みが増して料理の旨みになります。', tags: ['根菜', '万能食材'] },
            { name: 'ほうれん草', emoji: '🌿', desc: '鉄分・葉酸が豊富で貧血予防に効果的。ビタミンKも含まれています。', tags: ['葉野菜', '鉄分豊富'] },
            { name: 'もやし',     emoji: '🌱', desc: '低カロリーで食物繊維が豊富。ビタミンCも含まれてコスパ最強食材！', tags: ['低カロリー', 'コスパ最強'] },
            { name: 'とうふ',     emoji: '🫙', desc: '植物性タンパク質が豊富。消化が良く胃腸に優しい和食の定番食材。', tags: ['タンパク質', '和食'] },
            { name: 'きのこ',     emoji: '🍄', desc: '食物繊維とビタミンDが豊富。カロリーが低くダイエットにもおすすめ！', tags: ['低カロリー', '食物繊維'] },
        ];

        // 今日の日付から何番目の食材を表示するか計算する
        const today = new Date();
        const index = today.getDate() % foods.length;
        const food = foods[index];

        // 明日の食材
        const tomorrowIndex = (index + 1) % foods.length;
        const tomorrow = foods[tomorrowIndex];

        // 日付の表示（例：5月31日）
        const month = today.getMonth() + 1;
        const day = today.getDate();

        // HTMLに書き込む
        document.getElementById('foodTipEmoji').textContent = food.emoji;
        document.getElementById('foodTipDate').textContent = `今日の気になる食材 - ${month}月${day}日`;
        document.getElementById('foodTipName').textContent = food.name;
        document.getElementById('foodTipDesc').textContent = food.desc;
        document.getElementById('foodTipTomorrow').textContent = `明日は → ${tomorrow.emoji} ${tomorrow.name}`;

        // タグを作る
        const tagsEl = document.getElementById('foodTipTags');
        food.tags.forEach(tag => {
            const span = document.createElement('span');
            span.className = 'food-tip-tag';
            span.textContent = tag;
            tagsEl.appendChild(span);
        });
    </script>
@endsection