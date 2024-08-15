<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItemDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'purchase_item',
        'payment_successful'
    ];
}