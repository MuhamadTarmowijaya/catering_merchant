<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;

class CateringController extends Controller
{
    public function search(Request $request)
    {
        $merchants = Merchant::where('address', 'LIKE', '%' . $request->location . '%')
                            ->whereHas('menus', function ($query) use ($request) {
                                $query->where('name', 'LIKE', '%' . $request->food_type . '%');
                            })
                            ->get();

        return view('customer.search', compact('merchants'));
    }

}
