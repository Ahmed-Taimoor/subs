<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index($id)
    {
        $product = Product::find($id);
        
        if(!$product) {
            abort(404);
            die;
        }
        return view('checkout', compact('product'));
    }
}
