<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article\Article;
use App\Models\Article\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')->paginate(15);
        return view('dashboard.articles.index', compact('articles'));
    }

    public function create()
    {
        $article = new Article();
        $categories = ArticleCategory::get();
        return view('dashboard.articles.create', compact('article', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'article_title' => 'required|min:8',
            'article_category' => 'required',
            'article_content' => 'required'
        ]);

        ArticleCategory::findOrFail($request->article_category);

        $articleContent = $request->article_content;
        $content = $this->assignArticleContent($articleContent);
        $slug = Str::slug($request->article_title . '-' . Str::random(6));

        Auth::user()->articles()->create([
            'title' => $request->article_title,
            'article_category_id' => $request->article_category,
            'slug' => $slug,
            'content' => $content,
            'is_publish' => 1,
        ]);

        return redirect()->route('article.index')->with("success", "Article has been created.");
    }

    public function edit(Article $article)
    {
        $categories = ArticleCategory::get();
        return view('dashboard.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'article_title' => 'required|min:8',
            'article_category' => 'required',
            'article_content' => 'required'
        ]);
        ArticleCategory::findOrFail($request->article_category);

        $articleContent = $request->article_content;
        $content = $this->assignArticleContent($articleContent);
        $slug = Str::slug($request->article_title . '-' . Str::random(6));

        $article->update([
            'title' => $request->article_title,
            'article_category_id' => $request->article_category,
            'slug' => $slug,
            'content' => $content,
            'is_publish' => 1,
        ]);

        return redirect()->route('article.index')->with("success", "Article has been updated.");
    }

    public function destroy(Article $article)
    {
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML($article->content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach ( $images as $key => $image ) {
            $path = asset('/storage');
            $src = $image->getAttribute('src');
            $image_name = str_replace($path, '', $src);
            Storage::delete($image_name);
        }
        $article->delete();

        return redirect()->back()->with("success", "Article has been deleted.");
    }

    public function assignArticleContent($content)
    {
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ( $images as $key => $image ) {
            $src = $image->getAttribute('src');
            if ( preg_match('/data:image/', $src) ) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimeType = $groups['mime'];
                $path = '/articles/content/' . uniqid('', true) . '.' . $mimeType;
                Storage::disk('public')->put($path, file_get_contents($src));
                $newSource = asset('/storage' . $path);
                $image->removeAttribute('src');
                $image->setAttribute('src', $newSource);
            }
        }

        $content = $dom->saveHTML();
        return $content;
    }

    public function deleteImageContent(Request $request)
    {
        $path = asset('/storage');
        $file_name = str_replace($path, '', $request->src);
        $result = Storage::delete($file_name);
        return $result;
    }
}
