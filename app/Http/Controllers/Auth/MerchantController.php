<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class MerchantController extends Controller
{
    public function orders()
    {
        $orders = Order::whereHas('menu', function ($query) {
            $query->where('merchant_id', auth()->user()->id);
        })->get();

        return view('merchant.orders.index', compact('orders'));
    }

}
