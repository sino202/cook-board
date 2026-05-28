<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['title', 'body','user_id'];

    //ThreadはひとりのUserに属している
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}