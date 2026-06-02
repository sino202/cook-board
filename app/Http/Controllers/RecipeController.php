<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::with('user')->get();
        return view ('recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'title'       => 'required|max:100',
        'description' => 'required|max:500',
        'ingredients' => 'required',
        'steps'       => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:51200',
        ]);

        //画像の保存処理
        //$imageNameの最初はnull(画像なし)
        $imageName = null;

        //画像が送られてきたら保存する
        if($request->hasFile('image')){
            // Cloudinaryに画像をアップロードする
            $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath());
            // アップロードした画像のURLを取得する
            $imageName = $uploadedFile->getSecurePath();
}

        Recipe::create([
            'title' => $request ->title,
            'description' => $request ->description,
            'ingredients' => $request ->ingredients,
            'steps' => $request ->steps,
            'user_id' => auth()->id(),
            'image' => $imageName, //画像ファイル名を保存する

        ]);
        return redirect('/recipes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        //自分の投稿じゃなければ一覧に追い返す
        if($recipe->user_id !== Auth::id()){
            return redirect('/recipes');
        }
        return view('recipes.edit', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
    //自分の投稿じゃなければ一覧に追い返す
    if($recipe->user_id !== Auth::id()){
        return redirect('/recipes');
    }

    // 画像が送られてきたら更新する
    $imageName = $recipe->image;
    if($request->hasFile('image')){
        $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath());
        $imageName = $uploadedFile->getSecurePath();
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
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        //自分の投稿じゃなければ一覧に追い返す
        if($recipe->user_id !== Auth::id()){
            return redirect('/recipes');
        }
        $recipe->delete();
        return redirect('/recipes');
    }
}
