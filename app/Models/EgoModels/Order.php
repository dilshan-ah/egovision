<?php

namespace App\Models\EgoModels;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class Order extends Model
{
    use HasFactory, Searchable;

    public function orderItems(){
        return $this->hasMany(OrderItems::class,'order_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
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
        'discount',
        'tax',
        'transaction_id',
    ];

    protected $casts = [
        'processing_time' => 'datetime',
        'shipping_time' => 'datetime',
        'completing_time' => 'datetime',
        'failing_time' => 'datetime',
        'cancelling_time' => 'datetime',
        'returning_time' => 'datetime',
    ];
}
