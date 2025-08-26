<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use Intervention\Image\Laravel\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\StoreTeamRequest;

class TeamController extends Controller
{
    public function index(){
        $teams = Team::latest()->get();
        return view('admin.layouts.pages.team.index', compact('teams'));
    }

    public function store(StoreTeamRequest $request){

        $teamImage = $this->teamImage($request);
        Team::create([
            'name'      => $request->name,
            'position'  => $request->position,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'adjective' => $request->adjective,
            'facebook_url'  => $request->facebook_url,
            'linkedin_url'  => $request->linkedin_url,
            'instagram_url' => $request->instagram_url,
            'twitter_url'   => $request->twitter_url,
            'pinterest_url' => $request->pinterest_url,
            'image'     => $teamImage,
            'is_active' => $request->is_active,
        ]);

        Toastr::success('Team member added successfully.');
        return redirect()->route('team.index');
    }

    public function edit($id){
        $team = Team::find($id);
        return view('admin.layouts.pages.team.edit', compact('team'));
    }

    public function update(Request $request, $id){

        $team = Team::findOrFail($id);

        $request->validate([
            'name'      => 'required',
            'position'  => 'required',
            'email'     => 'required|email|unique:teams,email,' . $team->id,
            'adjective' => 'required|string|max:255',
            'facebook_url'  => 'required|url|max:255',
            'linkedin_url'  => 'required|url|max:255',
            'instagram_url' => 'required|url|max:255',
            'twitter_url'   => 'required|url|max:255',
            'pinterest_url' => 'required|url|max:255',
            'phone'     => 'required|regex:/^[0-9+\s()-]+$/|min:10|max:20',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:300',
            'is_active' => 'required|in:0,1',
        ]);

        $team = Team::find($id);
        $newTeamImage = $this->teamImage($request);
        if($newTeamImage){
            if(!empty($team->image)){
                $oldImagePath = public_path($team->image);
                if(file_exists($oldImagePath) && is_file($oldImagePath)){
                    unlink($oldImagePath);
                }
            }
            $team->image = $newTeamImage;
        }

        $team->update([
            'name'      => $request->name,
            'position'  => $request->position,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'adjective' => $request->adjective,
            'facebook_url'  => $request->facebook_url,
            'linkedin_url'  => $request->linkedin_url,
            'instagram_url' => $request->instagram_url,
            'twitter_url'   => $request->twitter_url,
            'pinterest_url' => $request->pinterest_url,
            'image'     => $team->image,
            'is_active' => $request->is_active,
        ]);

        Toastr::success('Team member info updated successfully.');
        return redirect()->route('team.index');

    }

    public function destroy($id){
        $team = Team::find($id);

        if($team){
            $oldImagePath = public_path($team->image);
            if(file_exists($oldImagePath)){
                unlink($oldImagePath);
            }
        }
        $team->delete();
        Toastr::success('Team deleted successfully.');
        return redirect()->route('team.index');
    }

    private function teamImage(Request $request){
        if ($request->hasFile('image')) {
            $image = Image::read($request->file('image'));
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('uploads/team_image/');

            // Ensure the directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true); // Create directory with appropriate permissions
            }

            $image->save($destinationPath . $imageName);
            return 'uploads/team_image/' . $imageName;
        }
        return null;
    }
    public function contact()
    {
        $teams = Team::all();
        return view('admin.layouts.pages.team.contact', compact('teams'));
    }
}
