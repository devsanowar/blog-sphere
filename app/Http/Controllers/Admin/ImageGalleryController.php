<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImageGallery;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class ImageGalleryController extends Controller
{
    public function index()
    {
        $imageGalleries = ImageGallery::all();
        return view('admin.layouts.pages.image-gallery.index', compact('imageGalleries'));
    }

    public function create()
    {
        return view('admin.layouts.pages.image-gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $galleryImage = $this->galleryImage($image);

                ImageGallery::create([
                    'title' => $request->title,
                    'image' => $galleryImage,
                    'is_active' => $request->is_active,
                ]);
            }
        }

        Toastr::success('Gallery images added successfully.');
        return redirect()->back();
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $imageGallery = ImageGallery::find($id);
        return view('admin.layouts.pages.image-gallery.edit', compact('imageGallery'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageGallery = ImageGallery::find($id);
        $newImage = $this->galleryImage($request->file('image'));

        if ($newImage) {
            $oldImagePath = public_path($imageGallery->image);
            if ($imageGallery->image && file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $imageGallery->image = $newImage;
        }

        $imageGallery->update([
            'title' => $request->title,
            'image' => $imageGallery->image,
            'is_active' => $request->is_active,
        ]);

        Toastr::success('Gallery image updated successfully.');
        return redirect()->route('image-gallery.index');
    }

    public function destroy(string $id)
    {
        $imageGallery = ImageGallery::find($id);
        if ($imageGallery) {
            $oldImagePath = public_path($imageGallery->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $imageGallery->delete();
        }

        Toastr::success('Gallery image deleted successfully.');
        return redirect()->route('image-gallery.index');
    }

    private function galleryImage($image)
    {
        if ($image) {
            $img = Image::read($image);
            $imageName = time() . '-' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/image-gallery/');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $img->save($destinationPath . $imageName);
            return 'uploads/image-gallery/' . $imageName;
        }

        return null;
    }
}
