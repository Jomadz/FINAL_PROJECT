<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\User;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'source',
        'product_id',
        'user_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Optional: if you're still associating with a purchase (e.g. via source logic)
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'product_id'); // if purchases table holds product_id
    }
}
