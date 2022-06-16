<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public $table = "inventory";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'stock',
        'tax',
        'price',
    ];

    /**
     * Get the product that owns the inventory.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * Get the product that owns the inventory.
     */
    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'product_id');
    }
}
