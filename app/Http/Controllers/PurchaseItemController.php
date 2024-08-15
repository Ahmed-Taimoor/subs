<?php

namespace App\Http\Controllers;

use App\Models\PurchaseItem;
use App\Models\Wallet;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseItemController extends Controller
{
    public function store()
    {
        $product_id = $_POST['product_id'];
        $subscription_in_months = 6;
        // $subscription_in_months = $_POST['subscription'];

        if (!$product_id) {
            abort(404);
            die;
        }

        $user = Auth::user();
        if (!$user) {
            return redirect('login');
        }
        if (isset($user->purchaseItem->product_id)) {
            if ($user->purchaseItem->product_id == $product_id) {
                return "Already bought this item";

                return view('wallet')->with([
                    'wallet' => $user->wallet,
                    'purchase_item' => "",
                    'payment_unsccessful' => ""
                ]);

            }
        }


        $wallet = $user->wallet;
        $walletAmount = $wallet->amount;
        $product = Product::find($product_id);

        if ($walletAmount >= $product->price) {
            $wallet->update([
                'amount' => ($walletAmount - $product->price)
            ]);

            for ($i = 1; $i <= $subscription_in_months; $i++) {
                PurchaseItem::create([
                    'user_id' => $user->id,
                    'product_id' => $product_id,
                    'payment_successful' => $i === 1 ? '1' : '0'
                ]);
            }
            return "done";
            // return view('wallet')->with([
            //     'wallet' => $user->wallet,
            //     'purchase_item' => "",
            //     'payment_unsccessful' => ""
            // ]);

        }

        return view('checkout', compact('product'));
    }
}