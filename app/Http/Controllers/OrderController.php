<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $menu = Menu::find($request->input('menu_id'));
        $order = new Order();
        $order->customer_id = auth()->user()->id;
        $order->menu_id = $menu->id;
        $order->quantity = $request->input('quantity');
        $order->delivery_date = $request->input('delivery_date');
        $order->total_price = $menu->price * $request->input('quantity');
        $order->save();

        // Generate Invoice
        return view('customer.invoice', compact('order'));
    }


}
