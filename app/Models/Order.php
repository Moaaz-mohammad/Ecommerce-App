<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'address_id', 'total_quantity', 'total'];
    use HasFactory;

    public function order_details() {
        return $this->hasMany(Order_Detail::class);
    }

    public function address() {
        return $this->belongsTo(Address::class);
    }

    public function order() {
        return $this->belongsTo(User::class);
    }
}
