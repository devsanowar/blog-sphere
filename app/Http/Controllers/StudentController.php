<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->get();
        return view('admin.layouts.pages.student.index', compact('students'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'roll_number' => 'required|string'
        ]);
        Student::create([
            'name' => $request->name,
            'roll_number' => $request->roll_number,
        ]);

        Toastr::success('Student added successfully.');
        return redirect()->route('student.index');
    }

    public function show(Student $student)
    {
        //
    }

    public function edit(Student $student)
    {
        //
    }

    public function update(Request $request, Student $student)
    {
        //
    }

    public function destroy(Student $student)
    {
        //
    }
}