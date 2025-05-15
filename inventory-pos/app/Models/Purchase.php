<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchases';
    protected $fillable = ['product_id', 'quantity', 'cost_price'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
