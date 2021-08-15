<?php

namespace App\Models\Product;

use App\Models\Order\PurchasedItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getItemIconAttribute()
    {
        return "/storage/" . $this->icon;
    }

    public function purchasedItems()
    {
        return $this->hasMany(PurchasedItem::class, 'item_id');
    }
}
