<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\UpdateAboutRequest;
use Intervention\Image\Laravel\Facades\Image;

class AboutController extends Controller
{
    public function index(){
        $about = About::first();
        return view('admin.layouts.pages.about.index', compact('about'));
    }

    public function update(UpdateAboutRequest $request)
    {
        $about = About::first();

        // Handle Image
        if ($request->hasFile('image')) {
            if ($about->image && file_exists(public_path($about->image))) {
                unlink(public_path($about->image));
            }
            $about->image = $this->uploadImage($request->file('image'));
        }

        // Handle Image Two
        if ($request->hasFile('image_two')) {
            if ($about->image_two && file_exists(public_path($about->image_two))) {
                unlink(public_path($about->image_two));
            }
            $about->image_two = $this->uploadImage($request->file('image_two'));
        }

        $about->about_title     = $request->about_title;
        $about->about_sub_title = $request->about_sub_title;
        $about->description     = $request->description;
        $about->save();

        Toastr::success('About updated successfully.');
        return redirect()->back();
    }

    private function uploadImage($file)
    {
        $image = Image::read($file);
        $imageName = time() . '-' . $file->getClientOriginalName();
        $destinationPath = public_path('uploads/about_image/');
        $image->save($destinationPath . $imageName);

        return 'uploads/about_image/' . $imageName;
    }

    private function aboutImage(Request $request){
        if ($request->hasFile('image')) {
            $image = Image::read($request->file('image'));
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('uploads/about_image/');
            $image->save($destinationPath . $imageName);

            return 'uploads/about_image/' . $imageName;

        }
        return null;
    }

}
