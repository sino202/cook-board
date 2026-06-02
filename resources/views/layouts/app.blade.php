<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <!-- スマホでも正しい大きさで表示するための設定 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ページのタイトル（ブラウザのタブに表示される） -->
    <title>Meshi Navi</title>

    <!-- Googleフォントの読み込み（2種類のフォントを使う） -->
    <!-- Noto Sans JP → 日本語テキスト用のきれいなフォント -->
    <!-- Playfair Display → ロゴ用のオシャレな英字フォント -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

    <!-- 自分で書いたCSSファイルの読み込み（public/css/app.css） -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <!-- ======== ヘッダー（全ページ共通） ======== -->
    <header class="site-header">
        <div class="container header-inner">

            <!-- ロゴ部分（クリックするとトップへ戻る） -->
            <a href="/" class="logo">
            <img src="{{ asset('images/recipes/logo.png') }}" alt="Meshi Navi" style="height: 120px; width: 120px; object-fit: contain; display: block; flex-shrink: 0; max-width: none;">
            <span class="logo-text">Meshi Navi</span>
            </a>

            <!-- ハンバーガーボタン（スマホのときだけ表示） -->
            <button class="hamburger" id="hamburger-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <!-- ナビゲーションメニュー -->
            <nav class="nav-menu">
                <!-- ホームリンク -->
                <a href="/" class="nav-link">ホーム</a>
                <!-- レシピ一覧リンク -->
                <a href="/recipes" class="nav-link">レシピ</a>
                <!-- 掲示板リンク -->
                <a href="/threads" class="nav-link">掲示板</a>
                {{-- ログインしているときだけ「投稿する」を表示 --}}
                @auth
                    <a href="/recipes/create" class="nav-link nav-post">
                        投稿する
                    </a>
                    {{-- ログアウトボタン --}}
                    <form method="POST" action="/logout" style="display:inline;">
                        @csrf
                        <button type="submit" class="nav-link" style="background:none;border:none;cursor:pointer;">
                            ログアウト
                        </button>
                    </form>
                @else
                    {{-- ログインしていないときは登録・ログインを表示 --}}
                    <a href="/register" class="nav-link">
                        登録
                    </a>
                    <a href="/login" class="nav-link nav-post">
                        ログイン
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- ======== メインコンテンツ（各ページの中身がここに入る） ======== -->
    @yield('content')

    <!-- ======== フッター（全ページ共通） ======== -->
    <footer class="site-footer">
        <div class="footer-bottom">
            <div class="container">
                <p>© 2026 Meshi Navi. みんなの料理コミュニティ 🍳</p>
            </div>
        </div>
    </footer>

    <!-- ハンバーガーメニューの開閉 -->
    <script>
        // ハンバーガーボタンとナビメニューの要素を取得
        const btn = document.getElementById('hamburger-btn');
        const nav = document.querySelector('.nav-menu');

        // ボタンがクリックされたときの処理
        btn.addEventListener('click', function(){
            nav.classList.toggle('open');
        });
    </script>

</body>
</html>