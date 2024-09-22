<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ['category_id','name','stock','price','description', 'product_show_status', 'product_status', 'descount_price'];


    use HasFactory;

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function order_details() {
        return $this->hasMany(Order_Detail::class);
    }
    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }
}
