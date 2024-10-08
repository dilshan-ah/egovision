<?php

namespace App\Models;

use App\Models\EgoModels\OrderItems;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnProduct extends Model
{
    use HasFactory;

    public function item(){
        return $this->belongsTo(OrderItems::class,'order_item_id');
    }
}
