<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Scholarship;
use App\Models\Profile;
use App\Models\Application;
use App\Models\Withdraw;
use App\Models\ProfileQualification;
use App\Models\ProfileDocument;
use Auth;


class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function startApplication(Request $request)
    {
        $scholarid=[];
        $user_id=Auth::user()->id;
        $profile_id=Profile::where('user_id',$user_id)->first();
        $id=$profile_id->id;

        $scholarships=Scholarship::where('is_active',1)->wheredoesnthave('scholarshipapplication',function($q) use ($id){
            $q->where('profile_id',$id);
        })->orderBy('close_date','asc')->get();

        if($request && $request->query('scholarship')!="")
        {
            $scholarid=Scholarship::where('id',$request->query('scholarship'))->first();   
        }
       return view ('studentsdashboard.startapplication',compact('scholarships','scholarid'));
    }
    public function myApplication()
    {
        $user_id=Auth::user()->id;
        $profile_id=Profile::where('user_id',$user_id)->first();
        $id=$profile_id->id;

        $applications=Application::where('profile_id',$id)->with('profile','scholarship')->orderBy('created_at','desc')->get();
        
        return view ('studentsdashboard.myapplication',compact('applications'));
    }

    public function scholarshipApplicants(Request $request)
    {
        $scholars=Scholarship::where('is_active',1)->orderBy('id','desc')->get();
        
        $profiles=$scholarship=$ship=[];
        $sid=$request->query('scholarship');
        

        if($request && $request->query('scholarship')!="")
        {
            $profiles=Profile::wherehas('profileapplication',function($q) use ($sid){
                $q->where('scholarship_id',$sid)
                ->where('status','Submitted');
            })->get();

            $ship=$request->query('scholarship');

            $scholarship=Scholarship::where('id',$request->query('scholarship'))->first();

        }

        return view ('dashboard.applicants',compact('profiles','scholarship','scholars','ship'));
    }

    public function submitApplication(Request $request)
    {
        $user_id=Auth::user()->id;
        $profile_id=Profile::where('user_id',$user_id)->first();
        $id=$profile_id->id;

        $sid=$request->input('scholarshipid');

        $scholarship= new Application;

        $scholarship->profile_id=$id;
        $scholarship->scholarship_id=$sid;
        $scholarship->status="Submitted";
        $scholarship->updated_at=now();

        $scholarship->save();

        return redirect("/Applications/myApplication")->with('msg_success', 'You have successfully applied for a scholarship. Kindly check your email for more details');
    }

    public function withdrawApplication($id)
    {
        $application=Application::findorfail($id);

        $withdraw= new Withdraw;

        $withdraw->profile_id=$application->profile_id;
        $withdraw->scholarship_id=$application->scholarship_id;
        $withdraw->created_at=now();

        $withdraw->save();

        $application->delete();

        return redirect("/Applications/myApplication")->with('msg_success', 'You have successfully from the scholarship. If you wish, you can reapply before the scholarship closes');

    }

    public function applicationDetail (Request $request)
    {
        $profileid=$request->input('profile');
        $scholarid=$request->input('scholarship');

        $profile=Profile::with('dzongkhag','gewog','village','current_dzongkhag','current_gewog','current_village')
                        ->where('id',$profileid)    
                        ->first();
        $qualifications=ProfileQualification::with('qualification')->where('profile_id',$profile->id)->get();
        $documents=ProfileDocument::with('document')->where('profile_id',$profile->id)->get();

        $scholarship=Scholarship::where('id',$scholarid)->first();

        return view ('dashboard.applicationdetail',compact('profile','qualifications','documents','scholarship'));
    }

    public function applicationScrunity (Request $request)
    {
        $sid=$request->input('scholarship');
        $profile=$request->input('profile');

        $application=Application::where('profile_id',$profile)->where('scholarship_id',$sid)->first();
        $application->status=$request->input('status');
        $application->remarks=$request->input('remark');

        $application->save();

        $profiles=Profile::wherehas('profileapplication',function($q) use ($sid){
            $q->where('scholarship_id',$sid)
            ->where('status','Submitted');
        })->get();

        $ship=$sid;

        $scholarship=Scholarship::where('id',$sid)->first();
        $scholars=Scholarship::where('is_active',1)->orderBy('id','desc')->get();

        $msg_success="Scrunity done successfully";

        return view ('dashboard.applicants',compact('profiles','scholarship','scholars','ship','msg_success'));


    }


    public function scholarshipShortlist (Request $request)
    {
        $scholars=Scholarship::where('is_active',1)->orderBy('id','desc')->get();
        
        $profiles=$scholarship=$ship=[];

        $sid=$request->query('scholarship');
        

        if($request && $request->query('scholarship')!="")
        {
            $profiles=Profile::wherehas('profileapplication',function($q) use ($sid){
                $q->where('scholarship_id',$sid)
                ->where('status','Approved')
                ->where('is_shortlisted',0);
            })->get();

            $ship=$request->query('scholarship');

            $scholarship=Scholarship::where('id',$request->query('scholarship'))->first();

        }

        return view ('dashboard.shortlist',compact('profiles','scholarship','scholars','ship'));
    }

    public function scholarshipShortlistUpdate ($profile,$scholarship)
    {
        $application=Application::where('profile_id',$profile)->where('scholarship_id',$scholarship)->first();

        $application->is_shortlisted=1;

        $application->save();

        return redirect()->back()->with('msg_success', 'You have successfully shorted the candidate');

    }
    
}
