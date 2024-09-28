<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Auth::user()->merchant->menus;
        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        return view('menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|max:2048',
        ]);

        $menu = new Menu();
        $menu->merchant_id = Auth::user()->merchant->id;
        $menu->fill($request->all());

        if ($request->hasFile('photo')) {
            $menu->photo = $request->file('photo')->store('menus');
        }

        $menu->save();

        return redirect()->route('menus.index')->with('success', 'Menu created successfully!');
    }

    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|max:2048',
        ]);

        $menu->fill($request->all());

        if ($request->hasFile('photo')) {
            $menu->photo = $request->file('photo')->store('menus');
        }

        $menu->save();

        return redirect()->route('menus.index')->with('success', 'Menu updated successfully!');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully!');
    }
}
