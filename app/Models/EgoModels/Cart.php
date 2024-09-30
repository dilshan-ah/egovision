<?php

namespace App\Models\EgoModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id', // Ensure this line is included
        'product_id',
        'power_status',
        'power',
        'pair',
        'user_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
