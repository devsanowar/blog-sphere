<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Blog;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.layouts.pages.blog.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.layouts.pages.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id'      => 'nullable|string|max:100',
            'category_id'  => 'nullable|string|max:100',
            'title'        => 'required|string|max:255',
            'blog_content' => 'required|string|min:10',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active'    => 'required|integer|in:0,1',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/blogs/' . $imageName;
            $image->move(public_path('uploads/blogs'), $imageName);
        }

        Blog::create([
            'user_id'      => Auth::id(),
            'menu_id'      => $request->menu_id,
            'category_id'  => $request->category_id,
            'title'        => $request->title,
            'blog_content' => $request->blog_content,
            'image'        => $imagePath,
            'is_active'    => $request->is_active,
        ]);

        Toastr::success('Blog post created successfully.');
        return redirect()->back();
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = Category::all();

        return view('admin.layouts.pages.blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'menu_id'      => 'nullable|string|max:100',
            'category_id'  => 'nullable|string|max:100',
            'title'        => 'required|string|max:255',
            'blog_content' => 'required|string|min:10',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active'    => 'required|integer|in:0,1',
        ]);

        $blog = Blog::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($blog->image && File::exists(public_path($blog->image))) {
                File::delete(public_path($blog->image));
            }

            $image = $request->file('image');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/blogs/' . $imageName;
            $image->move(public_path('uploads/blogs'), $imageName);
        } else {
            $imagePath = $blog->image;
        }

        $blog->update([
            'user_id'      => $blog->user_id,
            'menu_id'      => $request->menu_id,
            'category_id'  => $request->category_id,
            'title'        => $request->title,
            'blog_content' => $request->blog_content,
            'image'        => $imagePath,
            'is_active'    => $request->is_active
        ]);

        Toastr::success('Blog post updated successfully.');
        return redirect()->route('blog.index');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->image && File::exists(public_path($blog->image))) {
            File::delete(public_path($blog->image));
        }

        $blog->delete();

        Toastr::success('Blog post deleted successfully.');
        return redirect()->route('blog.index');
    }

    public function copy(Blog $blog)
    {
        $newBlog = $blog->replicate();

        if ($blog->image && file_exists(public_path($blog->image))) {
            $originalPath = public_path($blog->image);
            $newFileName = uniqid('doctor_') . '.' . pathinfo($originalPath, PATHINFO_EXTENSION);
            $newPath = 'uploads/blogs/' . $newFileName;

            // Copy the file
            copy($originalPath, public_path($newPath));

            // Assign the new photo path
            $newBlog->image = $newPath;
        }

        $newBlog->save();

        Toastr::success('Blog copied successfully');
        return redirect()->route('blog.index');
    }

}
