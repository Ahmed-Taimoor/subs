<?php


namespace App\Helpers;


use App\Models\Product;
use App\Models\User;

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

}
