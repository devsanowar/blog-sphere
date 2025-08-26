<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Blog;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::latest()->get();
        return view('admin.layouts.pages.menu.index', compact('menus'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255|unique:menus,name',
            'slug'       => 'nullable|string|max:255|unique:menus,slug',
            'icon_class' => 'nullable|string|max:255',
            'is_active'  => 'required|in:0,1',
        ]);

        Menu::create([
            'name'       => $request->name,
            'slug'       => Str::slug($request->name),
            'icon_class' => $request->icon_class,
            'is_active'  => $request->is_active,
        ]);

        Toastr::success('Menu added successfully.');
        return redirect()->back();
    }

    public function show(Menu $menu)
    {
        //
    }

    public function edit(Menu $menu)
    {
        //
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name'       => 'required|string|max:255|unique:menus,name,' . $menu->id,
            'slug'       => 'nullable|string|max:255|unique:menus,slug,' . $menu->id,
            'icon_class' => 'nullable|string|max:255',
            'is_active'  => 'required|in:0,1',
        ]);

        $menu->update([
            'name'       => $request->name,
            'slug'       => Str::slug($request->name),
            'icon_class' => $request->icon_class,
            'is_active'  => $request->is_active,
        ]);

        Toastr::success('Menu updated successfully.');
        return redirect()->back();
    }

    public function destroy(Menu $menu)
    {
        if ($menu->slug === 'default') {
            Toastr::error('Default menu cannot be deleted.');
            return redirect()->back();
        }

        $defaultMenu = Menu::firstOrCreate(
            ['slug' => 'default'],
            [
                'name'       => 'Default',
                'icon_class' => 'fa fa-bars',
                'is_active'  => 1
            ]
        );

        Category::where('menu_id', $menu->id)->update([
            'menu_id' => $defaultMenu->id
        ]);

        $menu->delete();

        Toastr::success('Menu deleted successfully. Categories moved to Default menu.');
        return redirect()->back();
    }
}
