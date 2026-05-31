<?php

namespace App\Http\Controllers;

// Recipeモデルを使えるようにする
use App\Models\Recipe;
// Threadモデルを使えるようにする
use App\Models\Thread;

class HomeController extends Controller
{
    public function index()
    {
        //レシピを新しい順に３件だけ取得する
        $recipes = Recipe::latest()->take(3)->get();

        //スレッドを新しい順に３件だけ取得する
        $threads = Thread::latest()->take(3)->get();

        // home.blade.phpにデータを渡して表示する
        return view('home', compact('recipes', 'threads'));
    }
}
