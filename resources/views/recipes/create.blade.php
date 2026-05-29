@extends('layouts.app')

@section('content')

    {{-- ページ上部のバナー --}}
    <div class="page-banner">
        <div class="container">
            <h1 class="page-banner-title">✏️ レシピを投稿する</h1>
            <p class="page-banner-desc">あなたの料理レシピをみんなとシェアしよう</p>
        </div>
    </div>

    <div class="container">
        <div class="form-card">

            {{-- enctype="multipart/form-data"は画像を送るために必要！ --}}
            <form method="POST" action="/recipes" enctype="multipart/form-data">
                @csrf

                {{-- 画像 --}}
                <div class="form-group">
                    <label class="form-label">料理の写真</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <p class="form-hint">JPG / PNG（任意）</p>
                </div>

                {{-- タイトル --}}
                <div class="form-group">
                    <label class="form-label">
                        タイトル <span class="form-required">*</span>
                    </label>
                    <input type="text" name="title" class="form-control" placeholder="例）ふわふわ親子丼">
                </div>

                {{-- 説明 --}}
                <div class="form-group">
                    <label class="form-label">
                        説明 <span class="form-required">*</span>
                    </label>
                    <textarea name="description" class="form-control" rows="3" placeholder="このレシピの魅力を一言で！"></textarea>
                </div>

                {{-- 材料 --}}
                <div class="form-group">
                    <label class="form-label">
                        材料 <span class="form-required">*</span>
                    </label>
                    <textarea name="ingredients" class="form-control" rows="5" placeholder="例）卵 2個&#10;鶏もも肉 200g&#10;玉ねぎ 1/2個"></textarea>
                    <p class="form-hint">1行に1つずつ書くと見やすいです</p>
                </div>

                {{-- 作り方 --}}
                <div class="form-group">
                    <label class="form-label">
                        作り方 <span class="form-required">*</span>
                    </label>
                    <textarea name="steps" class="form-control" rows="8" placeholder="例）1. お湯を沸かす&#10;2. 材料を切る"></textarea>
                    <p class="form-hint">番号をつけて書くとわかりやすいです</p>
                </div>

                {{-- 送信ボタン --}}
                <div class="form-submit">
                    <button type="submit" class="btn btn-primary">
                        ✏️ 投稿する
                    </button>
                    <a href="/recipes" class="btn btn-cancel">キャンセル</a>
                </div>

            </form>
        </div>
    </div>

@endsection