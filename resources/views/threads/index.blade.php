@extends('layouts.app')

@section('content')

    {{-- ページ上部のバナー --}}
    <div class="page-banner">
        <div class="container">
            <h1 class="page-banner-title">💬 掲示板</h1>
            <p class="page-banner-desc">みんなで料理についてトークしよう</p>
        </div>
    </div>

    <div class="container">
        <div class="thread-list">

            @foreach($threads as $thread)
            <a href="{{ route('threads.show', $thread->id) }}" class="thread-item">

                {{-- 左のアイコン --}}
                <div class="thread-icon">💬</div>

                {{-- スレッドのタイトルと本文 --}}
                <div class="thread-info">
                    <div class="thread-title">{{ $thread->title }}</div>
                    <div class="thread-meta">{{ $thread->body }}</div>
                    {{-- 投稿者名を表示 --}}
                    <div class="thread-meta">
                        👤 {{ $thread->user->name ?? '不明' }}
                    </div>
                </div>

            </a>
            @endforeach

        </div>
    </div>

@endsection