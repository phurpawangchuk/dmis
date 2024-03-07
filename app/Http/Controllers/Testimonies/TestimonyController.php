<?php

namespace App\Http\Controllers\Testimonies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimony;
use App\Models\Profile;
use Auth;

class TestimonyController extends Controller
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
    public function writeTestimony()
    {
        return view ('studentsdashboard.writetestimony');
    }

    public function manageTestimony(Request $request)
    {
        $type=[];
        $testimonies=Testimony::with('profile');
        if($request &&$request->query('type')!="")
        {
            $testimonies=$testimonies->where('is_approved',$request->query('type'));
            $type=$request->query('type');
        }
        
        $testimonies=$testimonies->orderBy('id','desc')->get();
        return view ('dashboard.testimonies',compact('testimonies','type'));
    }

    public function addTestimony(Request $request)
    {
        $user_id=Auth::user()->id;
        $profile_id=Profile::where('user_id',$user_id)->first();

        $testimony= new Testimony;
        $testimony->profile_id=$profile_id->id;
        $testimony->title=$request->title;
        $testimony->testimony=$request->message;
        $testimony->is_approved=0;
        $testimony->created_at=now();
        $testimony->updated_at=now();

        $testimony->save();

        return redirect()->back()->with('msg_success', 'Your testimony have been added successfully');

    }

    public function approveTestimony ($id)
    {
        $testimony=Testimony::findorfail($id);
        $testimony->is_approved=1;
        $testimony->save();
        return redirect("/Testimonies/manageTestimony")->with('msg_success', 'Testimony Approved successfully'); 
    }

    public function rejectTestimony ($id)
    {
        $testimony=Testimony::findorfail($id);
        $testimony->is_approved=0;
        $testimony->save();
        return redirect("/Testimonies/manageTestimony")->with('msg_success', 'Testimony Rejected successfully'); 
    }

    public function removeTestimony ($id)
    {
        $testimony=Testimony::findorfail($id);
        $testimony->delete();
        return redirect("/Testimonies/manageTestimony")->with('msg_success', 'Testimony Removed successfully'); 
    }
}

