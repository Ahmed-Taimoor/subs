<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PurchaseItemController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    $products = Product::all();
    if (!$products) {
        return view('dashboard');

    }
    return view('dashboard', compact('products'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/credit', [ProfileController::class, 'creditAmount'])->name('account.credit');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/checkout/{id}', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/purchase', [PurchaseItemController::class, 'store'])->name('checkout.store');
});

require __DIR__ . '/auth.php';
