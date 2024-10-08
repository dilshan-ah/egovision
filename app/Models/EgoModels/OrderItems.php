<?php

namespace App\Models\EgoModels;

use App\Models\ReturnProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function return(){
        return $this->hasOne(ReturnProduct::class,'order_item_id');
    }

    protected $fillable = [
        'order_id',
        'product_id',
        'power',
        'pair',
        'price',
    ];
}
