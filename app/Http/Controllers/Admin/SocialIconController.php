<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\WebsiteSocialIcon;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\UpdateSocialIconRequest;

class SocialIconController extends Controller
{
    public function socialIcon(){
        $social_icon_setting = WebsiteSocialIcon::first();
        return view('admin.layouts.pages.website.website_social', compact('social_icon_setting'));
    }

    public function socialIconUpdate(UpdateSocialIconRequest $request){
        $social_icon = WebsiteSocialIcon::first();
        $social_icon->update([
            'facebook_url' => $request->facebook_url,
            'linkedin_url' => $request->linkedin_url,
            'instagram_url' => $request->instagram_url,
            'twitter_url' => $request->twitter_url,
            'youtube_url' => $request->youtube_url,
            'pinterest_url' => $request->pinterest_url,
            'googleplus_url' => $request->googleplus_url,
            'tiktok_url' => $request->tiktok_url,
        ]);

        Toastr::success('Website settings updated successfully.');
        return redirect()->back();
    }
}
