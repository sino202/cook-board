<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    //スレッドに保存していい列はタイトルと本文と誰が書いたかの3つだけ。
    protected $fillable = ['title', 'body','user_id'];

    //ThreadはひとりのUserに属している
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        // このスレッドに紐づく返信を全部取得できる
        return $this->hasMany(Reply::class);
    }
}