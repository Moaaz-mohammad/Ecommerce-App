<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_status', 'product_of_category_status'];

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }
}
