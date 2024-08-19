<?php


namespace App\Helpers;


use App\Models\Product;
use App\Models\PurchaseSlot;
use App\Models\User;
use Carbon\Carbon;

class UserPurchasedProduct {

    public static function getProductByUserId($user_Id)
    {
        $user = User::find($user_Id);

        if (isset($user->purchaseItem)) {
            $productArr = [];
            foreach ($user->purchaseItem as $item) {
                $productArr[] = Product::find($item->product_id);
            }
            return $productArr;
        }
        return [];
    }

    public function createSlots($product,$purchase,$slots)
    {
        $single_slot_price = $product->price/$slots;
        for($i= 1;$i <= $slots;$i++){
            PurchaseSlot::create([
                'purchase_id' => $purchase->id,
                'amount' => $single_slot_price,
                'charge_date' => $i == 1 ? Carbon::today()->toDateString() : Carbon::today()->addMonths($i - 1)->toDateString(),
                'status' => $i == 1 ? true : false
            ]);

        }
    }

}
