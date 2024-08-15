<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PurchaseItemController;
use App\Http\Controllers\WalletController;
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
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/checkout/{id}', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [PurchaseItemController::class, 'store'])->name('checkout.store');

    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
    Route::get('/resetamount', [WalletController::class, 'resetAmount'])->name('wallet.reset');
});
require __DIR__ . '/auth.php';
