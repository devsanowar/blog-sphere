<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('admin.layouts.pages.location.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.layouts.pages.location.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_url'  => 'required|url',
            'is_active'     => 'nullable|boolean',
        ]);

        Location::create([
            'location_url'  => $request->location_url,
            'is_active'     => $request->is_active,

        ]);

        Toastr::success('Location url added successfully.');
        return redirect()->back();
    }

    public function edit(string $id)
    {
        $location = Location::find($id);
        return view('admin.layouts.pages.location.edit', compact('location'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'location_url'  => 'required|url',
            'is_active'     => 'nullable|boolean',
        ]);

        $location = Location::findOrFail($id);

        $location->location_url = $request->location_url;
        $location->is_active    = $request->is_active;
        $location->save();

        Toastr::success('Location url updated successfully.');
        return redirect()->route('location.index');
    }

    public function destroy($id)
    {
        $location = Location::findOrFail($id);

        $location->delete();

        Toastr::success('location_url deleted successfully.');
        return redirect()->route('location.index');
    }
}
