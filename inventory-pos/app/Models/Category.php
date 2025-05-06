<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   
    use HasFactory;

    protected $fillable = ['name']; // Add this line

    public function products()
    {
        return $this->hasMany(Product::class, 'product_category');
    }
}
//class Product extends Model 
//{ 
  //  public function categories() 
  //  { 
     //   return $this->belongsToMany(Category::class); 
    //} 
//}