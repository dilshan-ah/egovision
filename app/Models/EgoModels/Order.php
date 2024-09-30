<?php

namespace App\Models\EgoModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function orderItems(){
        return $this->hasMany(OrderItems::class,'order_id');
    }

    protected $fillable = [
        'user_id',
        'subtotal',
        'currency',
        'name',
        'email',
        'phone',
        'status',
        'address_one',
        'address_two',
        'city',
        'company',
        'state',
        'country',
        'zip_code',
        'delivery_charge',
        'payment_method',
        'amount',
        'transaction_id',
    ];
}
