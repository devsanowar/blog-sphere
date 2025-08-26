<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.layouts.pages.category.index', compact('categories'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id'   => 'required|integer',
            'name'      => 'required|string|max:255|unique:categories,name',
            'slug'      => 'nullable|string|max:255|unique:categories,slug',
            'is_active' => 'required|in:0,1',
        ]);

        Category::create([
            'menu_id'   => $request->menu_id,
            'name'      => $request->name,
            'slug'      => Str::slug($request->name),
            'is_active' => $request->is_active,
        ]);

        Toastr::success('Category added successfully.');
        return redirect()->back();
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        //
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'menu_id'   => 'required|integer',
            'name'      => 'required|string|max:255|unique:categories,name,' . $category->id,
            'slug'      => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
            'is_active' => 'required|in:0,1',
        ]);

        $category->update([
            'menu_id'   => $request->menu_id,
            'name'      => $request->name,
            'slug'      => $request->slug ? Str::slug($request->slug) : Str::slug($request->name),
            'is_active' => $request->is_active,
        ]);

        Toastr::success('Category updated successfully.');
        return redirect()->back();
    }

    public function destroy(Category $category)
    {
        if ($category->slug === 'default') {
            Toastr::error('Default category cannot be deleted.');
            return redirect()->back();
        }

        $defaultCategory = Category::firstOrCreate(
            ['slug' => 'default'],
            [
                'menu_id'   => $category->menu_id,
                'name'      => 'Default',
                'is_active' => 1
            ]
        );

        Blog::where('category_id', $category->id)->update([
            'category_id' => $defaultCategory->id,
            'menu_id'     => $defaultCategory->menu_id
        ]);

        $category->delete();

        Toastr::success('Category deleted successfully. Blogs moved to Default category.');
        return redirect()->back();
    }
}
