<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleCategoryRequest;
use App\Models\Article\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        $categories = ArticleCategory::get();
        $category = new ArticleCategory();
        return view('dashboard.articles.category.index', compact('categories', 'category'));
    }

    public function store(ArticleCategoryRequest $request)
    {
        ArticleCategory::create([
            'name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
            'description' => $request->category_description,
        ]);

        return redirect()->back()->with("success", "New category announcement has been created.");
    }

    public function edit(ArticleCategory $category)
    {
        return view('dashboard.articles.category.edit', compact('category'));
    }

    public function update(ArticleCategoryRequest $request, ArticleCategory $category)
    {
        $category->update([
            'name' => $request->category_name,
            'description' => $request->category_description,
        ]);

        return redirect()->route('article.category')->with("success", "Category announcement has been updated.");
    }

    public function destroy(ArticleCategory $category)
    {
        if ($category->articles()->exists()) {
            return redirect()->back()->with("error", "The action is denied. The category has relation to article.");
        } else {
            $category->delete();
            return redirect()->back()->with("success", "Category announcement has been deleted.");
        }
    }
}
