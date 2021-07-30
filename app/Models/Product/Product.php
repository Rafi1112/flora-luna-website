<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function items()
    {
        return $this->hasMany(Item::class, 'product_id');
    }

    public function label()
    {
        return $this->belongsTo(ProductLabel::class, 'product_label_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}
