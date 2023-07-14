<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWalletRequest;

class WalletController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $wallet = $user->wallet;

        return view('wallets.index', [
            'user' => $user,
            'wallets' => $wallet,
//            'breadcrumbItems' => $breadcrumbsItems,
            'pageTitle' => 'Users'
        ]);
    }

    public function create()
    {
        return view('wallets.create', [
            'pageTitle' => __('Charge the account'),
        ]);
    }

    public function store(StoreWalletRequest $request)
    {
        auth()->user()
            ->deposit($request->input('amount'));
        return redirect()->route('wallets.index')->with('message', 'amount of wallet has increment.');

    }
}
