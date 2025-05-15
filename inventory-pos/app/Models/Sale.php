<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'total_price',
        'payment_method',
        'seller_name',
        'sale_time',
    ];

    public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}


}
