<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'product_name',
        'product_description',
        'product_category',
        'product_brand',
        'product_sku',
        'barcode',
        'unit_of_measure',
        'stock_quantity',
        'minimum_stock_level',
        'reorder_quantity',
        'cost_price',
        'selling_price',
        'discount',
        'tax_rate',
        'product_status',
        'expiry_date',
        'added_by',
        'last_updated_by'
    ];
    // Define relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'last_updated_by');
    }

    public function category()
{
    return $this->belongsTo(Category::class, 'product_category');
}
public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    // Remove the Spatie Activitylog logic, as we're handling this via event listeners.
}
