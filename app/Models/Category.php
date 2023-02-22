<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $fillable = ["name", "parent_id"];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_details');
    }

    public function child()
    {
        return $this->hasOne($this, 'parent_id');
    }
}
