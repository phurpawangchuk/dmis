<?php

namespace App\Http\Controllers\Results;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\Scholarship;
use App\Models\Profile;

class ResultController extends Controller
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

    public function addResults(Request $request)
    {
        $scholars=Scholarship::where('is_active',1)->orderBy('id','desc')->get();
        
        $profiles=$scholarship=$ship=[];
        $sid=$request->query('scholarship');
        

        if($request && $request->query('scholarship')!="")
        {
            $profiles=Profile::wherehas('profileapplication',function($q) use ($sid){
                $q->where('scholarship_id',$sid)
                ->where('is_shortlisted',1);
            })
            ->wheredoesnthave('profileresult',function($q) use ($sid){
                $q->where('scholarship_id',$sid);
            })
            ->get();

            $ship=$request->query('scholarship');

            $scholarship=Scholarship::where('id',$request->query('scholarship'))->first();

        }

        return view ('dashboard.addresult',compact('profiles','scholarship','scholars','ship'));
        
    }

    public function addResultUpdate ($profile,$scholarship)
    {
        $result=new Result;
        $result->profile_id=$profile;
        $result->scholarship_id=$scholarship;
        $result->updated_at=now();

        $result->save();

        return redirect()->back()->with('msg_success', 'You have successfully added the applicant to result list');
    }

    public function finalizeResults(Request $request)
    {
        $scholars=Scholarship::where('is_active',1)->orderBy('id','desc')->get();
        
        $profiles=$scholarship=$ship=[];

        $sid=$request->query('scholarship');
        

        if($request && $request->query('scholarship')!="")
        {
            $profiles=Profile::wherehas('profileresult',function($q) use ($sid){
                $q->where('scholarship_id',$sid)
                ->where('is_finalized',0);
            })
            ->get();

            $ship=$request->query('scholarship');

            $scholarship=Scholarship::where('id',$request->query('scholarship'))->first();

        }

        return view ('dashboard.finalizeresult',compact('profiles','scholarship','scholars','ship'));
    }
    public function finalizeResultUpdate($id)
    {
        $results=Result::where('scholarship_id',$id)->where('is_finalized',0)->get();
        $scholarship=Scholarship::findorfail($id);
        
        $scholarship->is_active=0;
       $scholarship->save();

        foreach($results as $result)
        {
            $re=Result::where('id',$result['id'])->first();
            $re->is_finalized=1;
            $re->save();
        }

        return redirect()->back()->with('msg_success', 'Result for -'. $scholarship['name'] .' have been finalized successfully' );
    }
}
