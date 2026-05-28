@extends('layouts.app')

@section('content')

    {{-- ページ上部のバナー --}}
    <div class="page-banner">
        <div class="container">
            <h1 class="page-banner-title">{{ $thread->title }}</h1>
            <p class="page-banner-desc">💬 掲示板</p>
        </div>
    </div>

    <div class="container">

        {{-- 戻るリンク --}}
        <a href="{{ route('threads.index') }}" class="back-link">← 掲示板に戻る</a>

        {{-- 本文カード --}}
        <div class="detail-card">
            <div class="detail-section">
                <p class="detail-text">{{ $thread->body }}</p>
            </div>
        </div>

    </div>

@endsection