<?php

namespace App\Models;

use App\Models\Article\Article;
use App\Models\Order\PurchasedItem;
use App\Models\Product\Item;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'balance',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'user_id');
    }

    public function purchasedItem()
    {
        return $this->hasMany(PurchasedItem::class, 'user_id');
    }

    public function purchasingItem(Item $item)
    {
        $invoice = 'INV/ITEM/' . time() . '/' . Str::upper(Str::random(6));
        $response = $this->purchasedItem()->create([
            'item_id' => $item->id,
            'invoice' => $invoice,
            'amount' => 1,
            'price' => $item->price,
            'status' => 'Success',
        ]);
        $this->update([
            'balance' => $this->balance - $item->price
        ]);
        $item->update([
            'stock' => $item->stock - 1,
        ]);

        return $response;
    }
}
