<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::all();
        return view('admin.layouts.pages.feature.index', compact('features'));
    }
    public function create()
    {
        return view('admin.layouts.pages.feature.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'feature_title' => 'required|string|max:255',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:200',
        ]);
        $featureImage  = $this->featureImage($request);
        Feature::create([
            'feature_title' => $request->feature_title,
            'image'         => $featureImage,
            'is_active'     => $request->is_active,
        ]);
        Toastr::success('Feature added successfully.');
        return redirect()->back();
    }
    public function edit(string $id)
    {
        $feature = Feature::find($id);
        return view('admin.layouts.pages.feature.edit', compact('feature'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'feature_title' => 'required|string|max:255',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:200',
        ]);

        $feature  = Feature::find($id);
        $newImage = $this->featureImage($request);
        if ($newImage) {
            $oldImagePath = public_path($feature->image);
            if ($feature->image && file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $feature->image = $newImage;
        }
        $feature->update([
            'feature_title' => $request->feature_title,
            'image'         => $feature->image,
            'is_active' => $request->is_active,
        ]);
        Toastr::success('Feature updated successfully.');
        return redirect()->route('feature.index');
    }
    public function destroy(string $id)
    {
        $feature = Feature::find($id);
        if ($feature && $feature->image) {
            $oldImagePath = public_path($feature->image);
            if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $feature->delete();
        Toastr::success('Feature deleted successfully.');
        return redirect()->route('feature.index');
    }
    private function featureImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = Image::read($request->file('image'));
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('uploads/feature_image/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->save($destinationPath . $imageName);
            return 'uploads/feature_image/' . $imageName;
        }
        return null;
    }

}
