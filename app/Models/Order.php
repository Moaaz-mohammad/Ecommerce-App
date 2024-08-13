<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
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
