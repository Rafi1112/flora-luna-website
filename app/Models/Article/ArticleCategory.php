<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function articles()
    {
        return $this->hasMany(Article::class, 'article_category_id');
    }
}
