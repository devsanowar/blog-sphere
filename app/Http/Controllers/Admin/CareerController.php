<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::latest()->get();
        return view('admin.layouts.pages.career.index', compact('careers'));
    }

    public function create()
    {
        return view('admin.layouts.pages.career.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_title'                => 'required|string|max:255',
            'location'                 => 'required|string|max:255',
            'job_type'                 => 'required|string|max:255',
            'salary'                   => 'required|string|max:255',
            'description'              => 'required|string',
            'responsibilities'         => 'nullable|string',
            'others_requirements'      => 'nullable|string',
            'educational_requirements' => 'nullable|string',
            'experience_requirements'  => 'nullable|string',
        ]);

        Career::create([
            'job_title'                => $request->job_title,
            'location'                 => $request->location,
            'job_type'                 => $request->job_type,
            'salary'                   => $request->salary,
            'description'              => $request->description,
            'responsibilities'         => $request->responsibilities,
            'others_requirements'      => $request->others_requirements,
            'educational_requirements' => $request->educational_requirements,
            'experience_requirements'  => $request->experience_requirements,
            'is_active'                => $request->is_active,
        ]);

        Toastr::success('Career post created successfully.');
        return redirect()->back();
    }

    public function show(Career $career)
    {
        //
    }

    public function edit(Career $career)
    {
        return view('admin.layouts.pages.career.edit', compact('career'));
    }

    public function update(Request $request, Career $career)
    {
        $request->validate([
            'job_title'                => 'required|string|max:255',
            'location'                 => 'required|string|max:255',
            'job_type'                 => 'required|string|max:255',
            'salary'                   => 'required|string|max:255',
            'description'              => 'required|string',
            'responsibilities'         => 'nullable|string',
            'others_requirements'      => 'nullable|string',
            'educational_requirements' => 'nullable|string',
            'experience_requirements'  => 'nullable|string',
        ]);

        $career->update([
            'job_title'                => $request->job_title,
            'location'                 => $request->location,
            'job_type'                 => $request->job_type,
            'salary'                   => $request->salary,
            'description'              => $request->description,
            'responsibilities'         => $request->responsibilities,
            'others_requirements'      => $request->others_requirements,
            'educational_requirements' => $request->educational_requirements,
            'experience_requirements'  => $request->experience_requirements,
            'is_active'                => $request->is_active,
        ]);

        Toastr::success('Career post updated successfully.');
        return redirect()->route('career.index');
    }

    public function destroy(Career $career)
    {
        $career->delete();

        Toastr::success('Career post deleted successfully.');
        return redirect()->route('career.index');
    }
}
