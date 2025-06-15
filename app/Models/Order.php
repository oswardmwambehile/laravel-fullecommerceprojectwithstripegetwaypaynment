<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Mass assignable fields
    protected $fillable = [
        'user_id',
    'product_id',
    'quantity',
    'price',
    'status',
    'paynment_status',
    'delivery_status',
    ];

    // Relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
