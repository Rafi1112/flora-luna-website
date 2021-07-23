<?php

namespace App\Http\Controllers;

use App\Models\Article\Article;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $articles = Article::with('category')->latest()->get();
        return view('index', compact('articles'));
    }
}
