<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Intervention\Image\Laravel\Facades\Image;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->get();
        return view('admin.layouts.pages.review.index', compact('reviews'));
    }

//    public function index()
//    {
//        $reviews = Review::latest()->get();
//        $chunks = $reviews->chunk(3);
//        return view('admin.layouts.pages.review.index', compact('chunks'));
//    }

    public function create()
    {
        return view('admin.layouts.pages.review.create');
    }

    public function store(StoreReviewRequest $request)
    {
        $addReviewImage = $this->reviewImage($request);
        Review::create([
            'name'          => $request->name,
            'profession'    => $request->profession,
            'address'       => $request->address,
            'rating'        => $request->rating,
            'review'        => $request->review,
            'image'         => $addReviewImage,
        ]);

        Toastr::success('Review added successfully.');
        return redirect()->back();

    }
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $review = Review::findOrFail($id);
        return view('admin.layouts.pages.review.edit', compact('review'));
    }

    public function update(UpdateReviewRequest $request, string $id)
    {
        $review = Review::find($id);
        $reviewNewImage = $this->reviewImage($request);
        if($reviewNewImage){
            if (!empty($review->image)) {
                $oldImagePath = public_path($review->image);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $review->image = $reviewNewImage;
        }
        $review->update([
            'name'      => $request->name,
            'profession'=> $request->profession,
            'address'   => $request->address,
            'rating'    => $request->rating,
            'review'    => $request->review,
            'image'     => $review->image,
        ]);

        Toastr::success('Review updated successfully.');
        return redirect()->route('review.index');
    }

    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);

        if($review){
            $oldImagePath = public_path($review->image);
            if(file_exists($oldImagePath)){
                unlink($oldImagePath);
            }
        }
        $review->delete();
        Toastr::success('Review deleted successfully.');
        return redirect()->route('review.index');
    }

    private function reviewImage(Request $request){
        if ($request->hasFile('image')) {
            $image = Image::read($request->file('image'));
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('uploads/review_images/');
            $image->save($destinationPath . $imageName);
            return 'uploads/review_images/' . $imageName;
        }
        return null;
    }

}
