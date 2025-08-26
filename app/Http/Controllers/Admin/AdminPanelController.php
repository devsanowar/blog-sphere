<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Laravel\Facades\Image;

class AdminPanelController extends Controller
{
    public function adminPanelSetting(){
        $admin_panel = WebsiteSetting::first();
        return view('admin.layouts.pages.website.addmin_panel_setting', compact('admin_panel'));
    }

    public function adminPanelSettingUpdate(Request $request){
        $request->validate([
            'login_page_bg' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:1000',
        ]);

        $adminPanelSetting = WebsiteSetting::first();

        $loginBgImage = $this->serviceImage($request);
        if($loginBgImage){
            if (!empty($adminPanelSetting->login_page_bg)) {
                $oldImagePath = public_path($adminPanelSetting->login_page_bg);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $adminPanelSetting->login_page_bg = $loginBgImage;
        }

        $adminPanelSetting->update([
            'login_page_bg' => $adminPanelSetting->login_page_bg,
            'login_page_bg_color' => $request->login_page_bg_color,
        ]);

        Toastr::success('Login Page Background updated successfully.');
        return redirect()->back();

    }

    private function serviceImage(Request $request){
        if ($request->hasFile('login_page_bg')) {
            $image = Image::read($request->file('login_page_bg'));
            $imageName = time() . '-' . $request->file('login_page_bg')->getClientOriginalName();
            $destinationPath = public_path('uploads/website_settings/');
            $image->save($destinationPath . $imageName);
            return 'uploads/website_settings/' . $imageName;

        }
        return null;
    }
}
