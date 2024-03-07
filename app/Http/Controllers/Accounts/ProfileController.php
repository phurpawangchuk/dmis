<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Dzongkhag;
use App\Models\Gewog;
use App\Models\Village;
use App\Models\ProfileQualification;
use App\Models\ProfileDocument;
use Auth;
use Storage;
use Image;

class ProfileController extends Controller
{
    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'sex' => 'required',
            'p_dzongkhag_id' => 'required',
            'p_gewog_id' => 'required',
            'p_village_id' => 'required',
            'c_dzongkhag_id' => 'required',
            'c_gewog_id' => 'required',
            'c_village_id' => 'required',
            'house_no' => 'required',
            'thram_no' => 'required',
            'contact' => 'required'
        ]);

        $profile=Profile::where('cid',$id)->first();

        if ($request->has('profile_pic') && $request->profile_pic != null) {

            $profilePictureExists = Storage::exists('profile/' . $id . '.jpg');

            if ($profilePictureExists) {
                Storage::delete('profile/' . $id . '.jpg');
               
            }

            $image = $request->file('profile_pic');
            $fileName = $id . '.jpg';
            $src = 'profile/' . $fileName;

            Storage::putFileAs('profile', $image, $fileName);

        } 
        else {
            $src = $profile->src;
            
        }
        

        
        $profile->sex=$request->sex;
        $profile->dob=$request->dob;
        $profile->p_dzongkhag_id=$request->p_dzongkhag_id;
        $profile->p_gewog_id=$request->p_gewog_id;
        $profile->p_village_id=$request->p_village_id;
        $profile->c_dzongkhag_id=$request->c_dzongkhag_id;
        $profile->c_gewog_id=$request->c_gewog_id;
        $profile->c_village_id=$request->c_village_id;

        $profile->house_no=$request->house_no;
        $profile->thram_no=$request->thram_no;
        $profile->contact=$request->contact;
        $profile->updated_at=now();

        $profile->src=$src;

        $profile->save();

        return redirect("/Accounts/myProfile")->with('msg_success', 'Your profile have been updated successfully');   

    }


    public function getProfile()
    {
        if(Auth::user()->isStudent())
        {
            $email=Auth::user()->email;
            $profile=Profile::with('dzongkhag','gewog','village','current_dzongkhag','current_gewog','current_village')->where('email',$email)->first();

           
            return view ('studentsdashboard.profile',compact('profile'));
        }
        
        
    }
    public function changePassword()
    {
        return view ('studentsdashboard.changepassword');
    }

    public function editProfile($cid)
    {
        

        $profile=Profile::where('cid',$cid)->first();

        $dzongkhags=Dzongkhag::orderBy('name')->get();
        $gewogs=Gewog::orderBy('name')->get();
        $villages=Village::orderBy('name')->get();

        
        return view ('studentsdashboard.editprofile',compact('profile','dzongkhags','gewogs','villages'));
    }


    public function searchProfilebyCID(Request $request)
    {
        $profilecheck=0;
        $documents=$qualifications=[];
        $cid=$request->cidsearch;

        $profile=Profile::with('dzongkhag','gewog','village','current_dzongkhag','current_gewog','current_village')->where('cid',$request->cidsearch)->first();
        if($profile)
        {
            $profilecheck=1;
            $qualifications=ProfileQualification::with('qualification')->where('profile_id',$profile->id)->get();
            $documents=ProfileDocument::with('document')->where('profile_id',$profile->id)->get();
        }
        return view ('dashboard.profilesearch',compact('profile','qualifications','documents','profilecheck','cid'));
    }
    public function searchProfilebyName(Request $request)
    {
        $profilecheck=0;
        $oldname=$request->namesearch;
        $profiles=Profile::where('name','LIKE','%'.$request->namesearch.'%')->get();

       

        if($profiles->count()>=1)
        {
            $profilecheck=1;
        }

        return view ('dashboard.profilesearchbyname',compact('profilecheck','profiles','oldname'));
    }

    
}
