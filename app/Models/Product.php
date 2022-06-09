<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Get the blogs for the user.
     */
    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

}
