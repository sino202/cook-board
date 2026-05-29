<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable =[
        'title',
        'description',
        'ingredients',
        'steps',
        'user_id',
        'image', //画像ファイル名を保存する
    ];

    // Recipeは1人のUserに属している
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
