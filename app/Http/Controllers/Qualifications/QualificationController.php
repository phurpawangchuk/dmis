<?php

namespace App\Http\Controllers\Qualifications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Qualification;
use App\Models\Profile;
use App\Models\ProfileQualification;
use Auth;

class QualificationController extends Controller
{
    public function myQualification ()
    {
        $user_id=Auth::user()->id;
        $profile_id=Profile::where('user_id',$user_id)->first();
        $id=$profile_id->id;

        $qualifications=Qualification::with(['profilequalification'=>function($q) use ($id){
            $q->where('profile_id',$id);
        }])
        ->get();

        $qualificationcheck=Qualification::wheredoesnthave('profilequalification',function($q) use ($id){
            $q->where('profile_id',$id);
        })->count();

       return view ('studentsdashboard.myqualification',compact('qualifications','qualificationcheck'));
    }

    public function editMyQualification ($id)
    {
        
        $qualifications=ProfileQualification::with('qualification')->findOrfail($id);

        
        return view ('studentsdashboard.editmyqualification',compact('qualifications'));

    }

    public function qualificationUpdate ($id, Request $request)
    {
        $request->validate([
            'school_name' => 'required',
            'year' => 'required',
            'score' => 'required'
        ]);

        $pqupdate=ProfileQualification::findOrFail($id);

        $pqupdate->school_name=$request->school_name;
        $pqupdate->year=$request->year;
        $pqupdate->score=$request->score;

        $pqupdate->save();

        return redirect("/Qualifications/myQualifications")->with('msg_success', 'Your qualification is updated successfully');
    }

    public function addProfileQualification ()
    {
        $user_id=Auth::user()->id;
        $profile_id=Profile::where('user_id',$user_id)->first();
        $id=$profile_id->id;

        $qualifications=Qualification::wheredoesnthave('profilequalification',function($q) use ($id){
            $q->where('profile_id',$id);
        })->get();

        
        return view ('studentsdashboard.addprofilequalification',compact('qualifications','profile_id'));
    }

    public function qualificationAdd (Request $request)
    {
        $pq= new ProfileQualification;

        $pq->profile_id=$request->profile_id;
        $pq->qualification_id=$request->qualification_id;
        $pq->school_name=$request->school_name;
        $pq->year=$request->year;
        $pq->score=$request->score;
        $pq->updated_at=now();

        $pq->save();
        return redirect("/Qualifications/myQualifications")->with('msg_success', 'Your qualification is added successfully');

    }

    public function removeProfileQualification($id)
    {
        ProfileQualification::findOrFail($id)->delete();
        return redirect("/Qualifications/myQualifications")->with('msg_error', 'Your qualification is removed, Please make sure its not a required qualification in the checklist');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getqualifications=Qualification::with(['profilequalification'])->get();
        

        

        return view ('masters.qualifications.qualifications')->with("getqualifications",$getqualifications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('masters.qualifications.addqualifications');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
           
            
        ]);
        //echo $request->input('dname');

        try { 
                       $qualification=new Qualification;
                       $qualification->name=$request->input('name');
                      
                       $qualification->is_required=$request->input('optradio');
                       $qualification->updated_by=Auth::user()->id;
                       $qualification->save();
           
              
               
                       return redirect('Qualifications/index')->with('msg_success', 'Succesfully Inserted');
                  
           
              } catch(\Illuminate\Database\QueryException $ex){ 
                return redirect('Qualifications/index')->with('msg_error', 'Sorry Something is Worrog11');
              //dd($ex);
            
           }

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
        $qualification=Qualification::where('id',$id)->first();
        return view ('masters.qualifications.editqualifications')->with('qualification',$qualification);
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
        try{
            // echo $request->input('dat');
               $qualification=Qualification::find($id);
               $qualification->name=$request->input('name');
                      
               $qualification->is_required=$request->input('optradio');
               $qualification->save();
               return redirect('Qualifications/index')->with('msg_success', 'Succesfully update');
               
                       
               
              } catch(\Illuminate\Database\QueryException $ex){ 
                return redirect('Qualifications/index')->with('msg_error', 'Cant update');
               
             }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $qualification = Qualification::find($id);
            $qualification->delete();
            return redirect('Qualifications/index')->with('msg_success', 'Succesfully Deleted');
        
        }
        catch(\Illuminate\Database\QueryException $ex){ 
            return redirect('Qualifications/index')->with('msg_error', 'Cant delete');
         
       }

    }
}
