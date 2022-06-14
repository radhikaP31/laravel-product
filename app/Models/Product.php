<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name', 
        'description', 
        'image', 
    ];

    /**
     * Get the inventory for the product.
     */
    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    /**
     * Get the cart for the product.
     */
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Get the product for the order_item.
     */
    public function orderItem()
    {
        return $this->hasOne(OrderItem::class);
    }

}
