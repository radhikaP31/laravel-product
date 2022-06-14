<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    public $table = "orders";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_no',
        'status',
    ];

    /**
     * Get the order item that owns the order.
     */
    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the invoice that owns the order.
     */
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
