<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    /**
     * レシピ一覧を表示する
     * Recipe::with('user') でレシピに紐づくユーザー情報も一緒に取得する
     */
    public function index()
    {
        $recipes = Recipe::with('user')->get();
        return view('recipes.index', compact('recipes'));
    }

    /**
     * レシピ投稿フォームを表示する
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * フォームの内容を受け取ってDBに保存する
     */
    public function store(Request $request)
    {
        // 入力内容のチェック（バリデーション）
        $request->validate([
            'title'       => 'required|max:100',        // タイトルは必須・最大100文字
            'description' => 'required|max:500',        // 説明は必須・最大500文字
            'ingredients' => 'required',                // 材料は必須
            'steps'       => 'required',                // 作り方は必須
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:51200', // 画像は任意・形式チェック
        ]);

        // 画像の保存処理（画像がなければnullのまま）
        $imageName = null;

        // 画像が送られてきたらサーバーに保存する
        // store('recipes', 'public') で storage/app/public/recipes/ に保存される
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('recipes', 'public');
        }

        // レシピをデータベースに保存する
        Recipe::create([
            'title'       => $request->title,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'steps'       => $request->steps,
            'user_id'     => auth()->id(), // ログイン中のユーザーIDを紐づける
            'image'       => $imageName,   // 画像のパスを保存（なければnull）
        ]);

        return redirect('/recipes');
    }

    /**
     * レシピ詳細を表示する
     */
    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    /**
     * レシピ編集フォームを表示する
     * 自分の投稿でなければ一覧ページに追い返す（認可）
     */
    public function edit(Recipe $recipe)
    {
        // 自分の投稿じゃなければ一覧に追い返す
        if ($recipe->user_id !== Auth::id()) {
            return redirect('/recipes');
        }
        return view('recipes.edit', compact('recipe'));
    }

    /**
     * 編集内容を受け取ってDBを更新する
     * 自分の投稿でなければ一覧ページに追い返す（認可）
     */
    public function update(Request $request, Recipe $recipe)
    {
        // 自分の投稿じゃなければ一覧に追い返す
        if ($recipe->user_id !== Auth::id()) {
            return redirect('/recipes');
        }

        // 画像が送られてきたら更新する（なければ既存の画像をそのまま使う）
        $imageName = $recipe->image;
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('recipes', 'public');
        }

        $recipe->update([
            'title'       => $request->title,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'steps'       => $request->steps,
            'image'       => $imageName,
        ]);

        return redirect('/recipes/' . $recipe->id);
    }

    /**
     * レシピを削除する
     * 自分の投稿でなければ一覧ページに追い返す（認可）
     */
    public function destroy(Recipe $recipe)
    {
        // 自分の投稿じゃなければ一覧に追い返す
        if ($recipe->user_id !== Auth::id()) {
            return redirect('/recipes');
        }
        $recipe->delete();
        return redirect('/recipes');
    }
}