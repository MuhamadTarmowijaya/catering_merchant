<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::where('merchant_id', auth()->user()->id)->get();
        return view('merchant.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('merchant.menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
        ]);

        $menu = new Menu();
        $menu->merchant_id = auth()->user()->id;
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;

        if ($request->hasFile('image')) {
            $menu->image = $request->file('image')->store('menus');
        }

        $menu->save();

        return redirect()->route('merchant.menus.index')->with('success', 'Menu created successfully');
    }

}
