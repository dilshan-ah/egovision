<?php

namespace App\Models\EgoModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'balance',
        'initial_balance',
        'expiry_date',
        'is_active',
        'cutoff_percentage'
    ];
}
