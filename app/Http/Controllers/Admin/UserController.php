<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Unique;
use Intervention\Image\Laravel\Facades\Image;

class UserController extends Controller
{
    public function userCreate()
    {
        $users = User::all();
        return view('admin.layouts.profile.create_user', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', new Unique('users', 'name')],
            'email' => ['required', new Unique('users', 'email')],
            'phone' => ['required', new Unique('users', 'phone')],
            'system_admin' => 'nullable|in:1,2,3', // 1 = Admin, 2 = Editor, 3 = User
            'password' => 'required|string|min:6|confirmed',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'system_admin' => $request->system_admin,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'User created successfully.');
    }

    public function profile()
    {
        return view('admin.layouts.profile.profile');
    }

    public function profileImageUpdate(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:200',
        ]);

        $user = User::find($id);

        if ($user) {
            if ($request->hasFile('image')) {
                $image = Image::read($request->file('image'));

                $imagePath = public_path($user->image);

                if ($user->image && file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
                $destinationPath = public_path('uploads/profile_image/');
                // $image->resize(100, 100);
                $image->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $image->save($destinationPath . $imageName);

                $user->image = 'uploads/profile_image/' . $imageName;
                $user->save();
            }

            Toastr::success('Profile image updated successfully.');
            return redirect()->route('user.profile');
        }

        Toastr::error('User Not Found !');
        return redirect()->route('user.profile');
    }

    public function passwordUpdate(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        //Match The Old Password
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->with('error', "Old Password Doesn't match!");
        }

        //Update the new Password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        Session::flush();

        return redirect()->route('login')->with('success', 'Password Change Successfully.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.layouts.profile.edit_user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);

        //Update the new Password
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'system_admin' => $request->system_admin,
        ]);

        return redirect()->route('user.create')->with('success', 'User updated successfully');
    }

    public function destroyUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('user.create')->with('success', 'User deleted successfully');
    }
}
