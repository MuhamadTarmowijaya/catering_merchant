<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MerchantController extends Controller
{
    public function dashboard()
    {
        return view('merchant.dashboard');
    }

    public function profile()
    {
        $merchant = Auth::user()->merchant;
        return view('merchant.profile', compact('merchant'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
        ]);

        $merchant = Auth::user()->merchant;
        if (!$merchant) {
            $merchant = new Merchant();
            $merchant->user_id = Auth::id();
        }

        $merchant->fill($request->all());
        $merchant->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
