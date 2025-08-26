<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\VideoGallery;
use Illuminate\Support\Facades\File;

class VideoGalleryController extends Controller
{
    public function index()
    {
        $videoGalleries = VideoGallery::latest()->get();
        return view('admin.layouts.pages.video-gallery.index', compact('videoGalleries'));
    }

    public function create()
    {
        return view('admin.layouts.pages.video-gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'video_url' => 'required|url',
            'is_active' => 'nullable|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/video_thumbnails'), $imageName);
            $imagePath = 'uploads/video_thumbnails/' . $imageName;
        }

        VideoGallery::create([
            'image' => $imagePath,
            'video_url' => $request->video_url,
            'is_active' => $request->is_active,

        ]);

        Toastr::success('Video added successfully.');
        return redirect()->back();
    }

    public function edit(string $id)
    {
        $videoGallery = VideoGallery::find($id);
        return view('admin.layouts.pages.video-gallery.edit', compact('videoGallery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'video_url' => 'required|url',
            'is_active' => 'nullable|boolean',
        ]);

        $video = VideoGallery::findOrFail($id);

        if ($request->hasFile('image')) {

            if ($video->image && File::exists(public_path($video->image))) {
                File::delete(public_path($video->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/video_thumbnails'), $imageName);
            $video->image = 'uploads/video_thumbnails/' . $imageName;
        }

        $video->video_url = $request->video_url;
        $video->is_active = $request->is_active;
        $video->save();

        Toastr::success('Video updated successfully.');
        return redirect()->route('video-gallery.index');
    }

    public function destroy($id)
    {
        $video = VideoGallery::findOrFail($id);

        if ($video->image && File::exists(public_path($video->image))) {
            File::delete(public_path($video->image));
        }

        $video->delete();

        Toastr::success('Video deleted successfully.');
        return redirect()->route('video-gallery.index');
    }
}
