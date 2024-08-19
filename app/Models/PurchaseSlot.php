<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseSlot extends Model
{
    use HasFactory;

    protected $fillable = ['purchase_id','amount','charge_date','status'];

    public function purchaseItem()
    {
        return $this->belongsTo(PurchaseItem::class, 'purchase_id', 'id');
        // $purcahse = PurchaseItem::whereId($this->purchase_id)->first();
        // return $purcahse;
    }
}
