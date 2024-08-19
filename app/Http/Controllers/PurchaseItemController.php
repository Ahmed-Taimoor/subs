<?php

namespace App\Http\Controllers;

use App\Helpers\UserPurchasedProduct;
use App\Models\PurchaseItem;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PurchaseItemController extends Controller
{
    private $user_purchased_product;
    // main logic behind the purchase it that selet the months of the payment from product and then divide the product price with the available months and set payment status 0 for all and there will a column which the give us the charge date means on which date specific transaction will run if transaction success the update the payment status if value 1 else update the date for charge in next 2 days.
    public function __construct(UserPurchasedProduct $user_purchased_product){
        $this->user_purchased_product = $user_purchased_product;
    }
    public function store(Request $request)
    {
        // dd(gettype(Carbon::today()->toDateString()));
        //double check for extra variable and extra unnessary code and use $request to get payload

        $product_id = $request->product_id;
        $subscription_in_months = 6;
        // $subscription_in_months = $_POST['subscription'];

        if (!$product_id) {
            abort(404);
            die;
        }

        // add auth middle to authorize the routes
        $user = Auth::user();
        $userId = $user->id;

        //call helper functions using contructor and write all logic the helper functions not in controller
        $productsArr = $this->user_purchased_product->getProductByUserId($user->id);
        // use exists query and check if user_id and product_id exists

        if(PurchaseItem::where('user_id',$userId)->where('product_id',$request->product_id)->exists())
        {
            return view('wallet')->with([
                'user' => $user,
                'products' => $productsArr
            ]);
        }
        $walletAmount = $user->wallet_balance;
        $product = Product::findOrFail($product_id);

        if ($walletAmount >= $product->price) {
            DB::beginTransaction();
            try {
                Transaction::create([
                    'user_id' => $userId,
                    'amount' => $product->price
                ]);

                $purchase = PurchaseItem::create([
                    'user_id' => $userId,
                    'product_id' => $product_id,
                ]);
                $this->user_purchased_product->createSlots($product,$purchase,6);
                DB::commit();
            } catch (\Exception $e) {

                DB::rollBack();
                return response()->json(['error' => 'Transaction failed'], 500);
            }

            return view('wallet')->with([
                'user' => $user,
                'products' => $productsArr
            ]);
        }

        return view('profile.edit', [
            'user' => $user,
        ]);

    }
}
