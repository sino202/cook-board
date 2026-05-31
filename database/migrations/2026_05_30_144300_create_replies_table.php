<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('replies', function (Blueprint $table) {
            //「どのスレッドへの返信か」 を記録する列。foreignId = 他のテーブル（threadsテーブル）と紐付ける番号。
            //constrained() = 「存在するスレッドにしか返信できない」というルール。
            //cascadeOnDelete() = スレッドが削除されたら返信も一緒に消す。
            $table->id();
            $table->foreignId('thread_id')->constrained()->cascadeOnDelete();
            //「誰が書いた返信か」 を記録する列。thread_idと同じ仕組みで、今度はusersテーブルと紐付けている。ユーザーが削除されたら返信も一緒に消える。
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            //返信の本文を保存する列。text = 長い文章を保存できる型。（stringより長い文章OK）
            $table->text('content');
            //投稿した日時・更新した日時を自動で記録する列を2つ作る。（created_at と updated_at という列が自動でできる）
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
