<?php

namespace App\Http\Controllers\Admin;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('admin.layouts.pages.teacher.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.layouts.pages.teacher.create');
    }

    public function edit()
    {
        return view('admin.layouts.pages.teacher.edit');
    }

    public function show()
    {
        return view('admin.layouts.pages.teacher.show');
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'teacher_name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
        ]);

        // Create a new teacher
        Teacher::create($request->all());

        return redirect()->route('teacher.index')->with('success', 'Teacher created successfully.');
    }
}
