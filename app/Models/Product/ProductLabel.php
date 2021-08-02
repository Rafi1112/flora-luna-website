<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLabel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_label_id');
    }

    public function getLabelImageAttribute()
    {
        return "/storage/" . $this->image;
    }
}
