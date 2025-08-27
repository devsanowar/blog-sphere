<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class EmployeController extends Controller
{
    public function index()
    {
        $employes = Employe::all();
        return view('admin.layouts.pages.employe.index', compact('employes'));
    }

    public function create()
    {
        return view('admin.layouts.pages.employe.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'employe_name' => 'required|string|max:255',
            'employe_email' => 'required|email|unique:employes,employe_email',
            'employe_phone' => 'required|string|max:15',
        ]);

        Employe::create($request->all());

        Toastr::success("Data successfully added!");
        return redirect()->route('employe.index');
    }

    public function edit($id)
    {
        $employe = Employe::findOrFail($id);
        return view('admin.layouts.pages.employe.edit', compact('employe'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'employe_name' => 'required|string|max:255',
            'employe_phone' => 'required|numeric',
            'employe_email' => 'required|email|unique:employes,employe_email,' . $id,
        ]);

        $employe = Employe::findOrFail($id);
        $employe->update($request->all());

        Toastr::success('Data successfully updated!');

        return redirect()->route('employe.index');
    }

    public function destroy($id)
    {
        // $employe = Employe::findOrFail($id);
        // $employe->delete();

        return redirect()->route('employe.index')->with('success', 'Employe deleted successfully.');
    }


}
