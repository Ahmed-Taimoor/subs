<?php

namespace App\Http\Controllers;

use App\Helpers\UserPurchasedProduct;
use App\Models\PurchaseItem;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseItemController extends Controller
{
    public function store(Request $request)
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

        $productsArr = UserPurchasedProduct::getProductByUserId($user->id);

        if (isset($productsArr) && !empty($productsArr)) {
            foreach ($productsArr as $item) {
                if ($item['id'] == $product_id) {
                    return view('wallet')->with([
                        'user' => $user,
                        'products'=> $productsArr
                    ]);
                }
            }
        }

        $walletAmount = $user->calculateTotalAmount();
        $product = Product::find($product_id);

        if ($walletAmount >= $product->price) {
            $payment_successful = Transaction::create([
                'user_id' => $user->id,
                'transaction_type' => 'debit',
                'amount' => $product->price
            ]);
            PurchaseItem::create([
                'user_id' => $user->id,
                'product_id' => $product_id,
                'payment_successful' => $payment_successful ? '1' : '0'
            ]);
            return view('wallet')->with([
                'user' => $user,
                'products'=> $productsArr
            ]);
        }

        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
}
