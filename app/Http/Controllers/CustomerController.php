<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Merchant; // Import model merchant
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Menampilkan daftar menu
    public function index()
    {
        $menus = Menu::all();
        return view('customer.menus.index', compact('menus'));
    }

    // Menambahkan menu ke keranjang
    public function addToCart($id)
    {
        $menu = Menu::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $menu->name,
                "quantity" => 1,
                "price" => $menu->price,
                "photo" => $menu->photo
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Menu ditambahkan ke keranjang!');
    }

    // Menampilkan keranjang
    public function cart()
    {
        return view('customer.cart');
    }

    // Menghapus item dari keranjang
    public function removeFromCart($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Menu dihapus dari keranjang!');
    }

    public function checkout()
    {
        $cart = session()->get('cart');

        if ($cart) {
            foreach ($cart as $id => $details) {
                Order::create([
                    'user_id' => auth()->id(),
                    'menu_id' => $id,
                    'quantity' => $details['quantity'],
                    'total_price' => $details['quantity'] * $details['price'],
                    'status' => 'pending', // status default
                ]);
            }

            // Kosongkan keranjang setelah checkout
            session()->forget('cart');

            return redirect()->route('customer.orders')->with('success', 'Pemesanan berhasil dilakukan!');
        }

        return redirect()->back()->with('error', 'Keranjang kosong.');
    }

    // Menampilkan semua order
    public function orders()
    {
        $orders = Order::with('menu')->where('user_id', auth()->id())->get();
        return view('customer.orders.index', compact('orders'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        // Cari berdasarkan nama menu atau nama merchant (katering)
        $menus = Menu::where('name', 'LIKE', "%{$query}%")
                    ->orWhereHas('merchant', function($q) use ($query) {
                        $q->where('name', 'LIKE', "%{$query}%");
                    })
                    ->get();

        return view('customer.menus.index', compact('menus'));
    }



}

