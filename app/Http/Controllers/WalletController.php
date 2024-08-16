<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class WalletController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            return view('wallet')->with(['wallet' => $user->wallet]);
            // return $user->wallet;
        }
        return redirect()->back();
    }

    public function create(Request $request)
    {

        $validatedWallet = $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();

        $wallet = Wallet::create([
            'user_id' => $user->id,
            'amount' => $validatedWallet['amount'],
        ]);

        return response()->json(['message' => 'Wallet created successfully', 'wallet' => $wallet], 201);
    }

    public function resetAmount(Request $request)
    {

        $users = User::get();
        foreach ($users as $user) {
            $wallet = Wallet::where('user_id', $user->id)->first();
            if ($wallet) {
                $wallet->update([
                    'amount' => '5000',
                ]);

            } else {
                Wallet::create([
                    'user_id' => $user->id,
                    'amount' => '5000',
                ]);
            }
        }
        return response()->json(['message' => 'Wallet Updated successfully'], 200);
    }
}
