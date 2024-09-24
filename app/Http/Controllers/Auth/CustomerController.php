<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Merchant;

class CustomerController extends Controller
{
    public function search(Request $request)
    {
        $merchants = Merchant::where('address', 'like', '%'.$request->input('location').'%')
                            ->orWhereHas('menus', function ($query) use ($request) {
                                $query->where('name', 'like', '%'.$request->input('menu').'%');
                            })->get();

        return view('customer.search', compact('merchants'));
    }

}
