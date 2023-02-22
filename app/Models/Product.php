<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $fillable = ["name", "brand_id", "price", "image"];

    public function brand()
    {
        return $this->hasOne(Brand::class, "id", "brand_id");
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, "category_details");
    }
}
