<?php

namespace App\Http\Controllers\Scholarship;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sponser;
use App\Models\Scholarship;
use App\Models\ScholarshipSponser;
use App\Models\Application;

class ScholarshipController extends Controller
{
    public function addScholarships()
    {
        $sponsers=Sponser::all();
        
        return view ('dashboard.addscholarships',compact('sponsers'));
    }

    public function removeScholarship($id)
    {
        $scholars=Scholarship::findorfail($id);
        $scholars->delete();
        return redirect("/Scholarships/manageScholarships")->with('msg_success', 'Scholarship Removed Successfully'); 
        
    }

    public function scholarshipAdd (Request $request)
    {
        
        $title=$request->input('title');
        $description=$request->input('description');
        $eligibility=$request->input('eligibility');
        $selection=$request->input('selection');
        $opendate=$request->input('opendate');
        $closedate=$request->input('closedate');
        $slots=$request->input('slots');
        $type=$request->input('type');
        $is_active=$request->input('is_active');

       

        $scholarship = new Scholarship;
        $scholarship->name=$title;
        $scholarship->description=$description;
        $scholarship->eligibility=$eligibility;
        $scholarship->selection=$selection;
        $scholarship->open_date=$opendate;
        $scholarship->close_date=$closedate;
        $scholarship->slot=$slots;
        $scholarship->type=$type;
        $scholarship->is_active=$is_active;
        $scholarship->updated_at=now();

        $scholarship->save();

        //selecting latest scholarship

        $latestscholarship=Scholarship::orderBy('id','desc')->first();



        $sponserfund= $request->input('sponserfund');
        foreach ($sponserfund as $key => $sf) {
            $sfe=explode('-',$sf);

            $scholarsponser=new ScholarshipSponser;
            $scholarsponser->scholarship_id=$latestscholarship->id;
            $scholarsponser->sponser_id=$sfe[0];
            $scholarsponser->fund=$sfe[1];
            $scholarsponser->updated_at=now();

            $scholarsponser->save();
           
            
        }

       return redirect("/Scholarships/manageScholarships")->with('msg_success', 'Scholarship Added Successfully');
    }

    public function manageScholarships (Request $request)
    {

        $scholarships=Scholarship::with(['scholarshipsponser'])->with(['scholarshipapplication']);

        
        $type=$status=[];

        if($request && $request->query('type')!="")
        {
            $scholarships=$scholarships->where('type',$request->query('type'));
            $type=$request->query('type');
        }

        if($request && $request->query('status')!="")
        {
            $scholarships=$scholarships->where('is_active',$request->query('status'));
            $status=$request->query('status');
        }
        
        
        $scholarships=$scholarships->orderBy('id','desc')->get();
        
        return view ('dashboard.managescholarship',compact('scholarships','type','status'));
    }

    public function detailScholarships($id)
    {
        $scholarship=Scholarship::with(['scholarshipsponser'])->with(['scholarshipapplication'])->where('id',$id)->first();
       return view ('dashboard.detailscholarship',compact('scholarship'));
    }

    public function editScholarship($id)
    {
        $sponsers=Sponser::all();
        $scholarship=Scholarship::with('scholarshipsponser')->where('id',$id)->first();
        return view ('dashboard.editscholarship',compact('sponsers','scholarship'));
    }

    public function updateScholarship($id, Request $request)
    {
        $scholarship=Scholarship::findorfail($id);

        $title=$request->input('title');
        $description=$request->input('description');
        $eligibility=$request->input('eligibility');
        $selection=$request->input('selection');
        $opendate=$request->input('opendate');
        $closedate=$request->input('closedate');
        $slots=$request->input('slots');
        $type=$request->input('type');
        $is_active=$request->input('is_active');

       
        $scholarship->name=$title;
        $scholarship->description=$description;
        $scholarship->eligibility=$eligibility;
        $scholarship->selection=$selection;
        $scholarship->open_date=$opendate;
        $scholarship->close_date=$closedate;
        $scholarship->slot=$slots;
        $scholarship->type=$type;
        $scholarship->is_active=$is_active;
        $scholarship->updated_at=now();

        $scholarship->save();

       ScholarshipSponser::where('scholarship_id',$id)->delete();

        $sponserfund= $request->input('sponserfund');
        foreach ($sponserfund as $key => $sf) {
            $sfe=explode('-',$sf);

            $scholarsponser=new ScholarshipSponser;
            $scholarsponser->scholarship_id=$id;
            $scholarsponser->sponser_id=$sfe[0];
            $scholarsponser->fund=$sfe[1];
            $scholarsponser->updated_at=now();

            $scholarsponser->save();
           
            
        }

        return redirect("/Scholarships/manageScholarships")->with('msg_success', 'Scholarship Updated Successfully');


    }
}
