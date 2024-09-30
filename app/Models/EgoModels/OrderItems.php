<?php

namespace App\Models\EgoModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(Product::class);
    }

    protected $fillable = [
        'order_id',
        'product_id',
        'power',
        'pair',
        'price',
    ];
}
