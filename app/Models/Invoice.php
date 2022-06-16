<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public $table = "invoice";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'user_id',
        'invoice_no',
        'amount',
        'tax',
        'total_amount',
        'status',
    ];

    /**
     * Get the invoice that owns the orders.
     */
    public function orders()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'id');
    }

    /**
     * Get the invoice that owns the user.
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
