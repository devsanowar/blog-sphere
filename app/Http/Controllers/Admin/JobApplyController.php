<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApply;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class JobApplyController extends Controller
{
    public function index()
    {
        $jobApplications = JobApply::latest()->get();
        return view('admin.layouts.pages.job-apply.index', compact('jobApplications'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'position'    => 'required|string|max:255',
            'resume'      => 'required|file|mimes:pdf,doc,docx|max:5120',
            'why_join_us' => 'required|string|max:1000',
        ]);

        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/resumes'), $filename);
            $resumePath = 'uploads/resumes/' . $filename;
        } else {
            $resumePath = null;
        }

        JobApply::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'position'    => $request->position,
            'resume'      => $resumePath,
            'why_join_us' => $request->why_join_us,
        ]);

        return back()->with('message', 'Application submitted successfully.');
    }

    public function show(JobApply $jobApply)
    {
        //
    }

    public function edit(JobApply $jobApply)
    {
        //
    }

    public function update(Request $request, JobApply $jobApply)
    {
        //
    }

    public function destroy(JobApply $jobApply)
    {
        $jobApply->delete();

        Toastr::success('Job application deleted successfully.');
        return redirect()->route('job-apply.index');
    }
}
