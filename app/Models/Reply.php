<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //$fillable dbのこの列だけ書き込んでいいよっていうルール
    protected $fillable = ['content', 'thread_id', 'user_id'];

    //thread()メソッド　「この返信がどのスレッドのものか」を調べられるようにする。コード上で $reply->thread->title みたいに使える！
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    //user()メソッド この返信を誰が書いたか」を調べられるようにするコード上で $reply->user->name みたいに使える！
    public function user()
    {
        //「この返信はどこか1人のユーザーに属している」という関係を定義。「この返信はBさんが書きました」という関係！
        return $this->belongsTo(User::class);
    }
}