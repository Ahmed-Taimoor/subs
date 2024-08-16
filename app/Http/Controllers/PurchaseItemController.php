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
    // main logic behind the purchase it that selet the months of the payment from product and then divide the product price with the available months and set payment status 0 for all and there will a column which the give us the charge date means on which date specific transaction will run if transaction success the update the payment status if value 1 else update the date for charge in next 2 days.
    public function store(Request $request)
    {


        //double check for extra variable and extra unnessary code and use $request to get payload

        $product_id = $_POST['product_id'];
        $subscription_in_months = 6;
        // $subscription_in_months = $_POST['subscription'];

        if (!$product_id) {
            abort(404);
            die;
        }

        // add auth middle to authorize the routes
        $user = Auth::user();
        if (!$user) {
            return redirect('login');
        }


        //call helper functions using contructor and write all logic the helper functions not in controller
        $productsArr = UserPurchasedProduct::getProductByUserId($user->id);

        // use exists query and check if user_id and product_id exists
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
        // use a custom attribute in user object as balance or wallet_balance create a getter for it in user modal
        $walletAmount = $user->calculateTotalAmount();
        $product = Product::find($product_id);

        if ($walletAmount >= $product->price) {

            // use db transaction

            $payment_successful = Transaction::create([
                'user_id' => $user->id,
                //in migration make one value as default
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
