<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            // id列 → 会員番号（自動で1・2・3と増える）
            $table->id();

            // name列 → ユーザー名（表示名）
            $table->string('name');

            // email列 → メールアドレス（unique = 同じメールは登録できない）
            $table->string('email')->unique();

            // メール認証用（nullable = 空でもOK）
            $table->timestamp('email_verified_at')->nullable();

            // password列 → パスワード（暗号化して保存される）
            $table->string('password');

            // ログイン維持用トークン（「次回から自動ログイン」機能に使う）
            $table->rememberToken();

            // created_at・updated_at列 → 作成日時・更新日時（Laravelが自動管理）
            $table->timestamps();

        });
    }

    public function down(): void
    {
        // usersテーブルを消す（やり直し用）
        Schema::dropIfExists('users');
    }
};
