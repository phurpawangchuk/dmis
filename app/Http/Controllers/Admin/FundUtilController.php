<?php

namespace App\Http\Controllers\Admin;

use File;
use App\Models\User;
use App\Models\Donor;
use App\Models\FundUtil;
use App\Models\UserProfile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProjectMaster;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FundUtilController extends Controller
{
   public $search;
   public $DONOR_ID = 3;
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('fundutil_panel_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $folderPath ='uploads/fundutils/';
        $perPage = 10;  $page = 1;

        if(Auth::user()->role_id < 3){
            $fundutils = DB::table("donors")
                        ->select(
                            'donors.*'
                            ,DB::raw("SUM(donors.amount) as totalAmt"))
                        ->where('is_verified',1)
                        ->groupBy('donors.donor_id','donors.project_id')
                        ->paginate(10);

        }else{
            $fundutils = DB::table("donors")
                        ->select(
                            'donors.*'
                            ,DB::raw("SUM(donors.amount) as totalAmt"))
                            ->where('is_verified',1)
                            ->where('donor_id',Auth::user()->id)
                            ->groupBy('donors.donor_id','donors.project_id')
                            ->paginate(10);
        }

        $currentpage = $request->get('page');
        if($currentpage > 1){
            $page = $perPage * ($currentpage - 1);
        }
        Session::put('pages',$page);

        return view('dashboard.fundutils.index',compact('fundutils','perPage','folderPath'));
    }

     /* Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('fundutil_create'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $title = "Add New Fund Utilization";

        $projects = ProjectMaster::all();
        $donorUsers = User::where('role_id',3)->get();

        return view('dashboard.fundutils.create', compact('title','projects','donorUsers'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('fundutil_create'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $folderPath ='uploads/fundutils/';
        if(!is_dir($folderPath)){
            mkdir($folderPath, 0755);
        }
        $file_tmp = $_FILES['file']['tmp_name'];
        $extension = $request->file->extension();

        $request->validate([
            'file' => 'required|mimes:pdf,PDF|max:2048',
        ]);
        $filename = uniqid() . '.'.$extension;

        $file = $folderPath. $filename;
        if(move_uploaded_file($file_tmp, $file)){
            $data['donor_id']   =  $request->donor_id;
            $data['project_id']   =  $request->project_id;
            $data['amount_collected']   =  $request->amount_collected;
            $data['amount_used']   =  $request->amount_used;
            $data['shortCode'] = $request->shortCode;
            $data['author'] = Auth()->id();
            $data['util_report'] = $filename;
            FundUtil::create($data);
        }

        return redirect()->route('dashboard.fundutils.index')->with(['success' => "Utilization added successfuly"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($donor_project_id)
    {
        abort_if(Gate::denies('fundutil_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $param = explode( '-', $donor_project_id );
        $donorId = $param[0];
        $projectId = $param[1];

        $fundutil = FundUtil::where('donor_id',$donorId)->where('project_id',$projectId)->get();

        if(count($fundutil) == 0)
        {
            $fundutil = collect();
        }else{
            $fundutil = $fundutil[0];
        }

        return view('dashboard.fundutils.edit',compact('fundutil','donorId','projectId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        abort_if(Gate::denies('fundutil_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $param = explode( '-', $request->id );
        $donorId = $param[0];
        $projectId = $param[1];

        $fundutil = FundUtil::where('donor_id',$donorId)->where('project_id',$projectId)->get();

        if(!empty($_FILES['file']['tmp_name']))
        {
            $folderPath ='uploads/fundutils/';
            if(!is_dir($folderPath)){
                mkdir($folderPath, 0755);
            }
            $file_tmp = $_FILES['file']['tmp_name'];
            $extension = $request->file->extension();

            $filename = uniqid() . '.'.$extension;

            $file = $folderPath. $filename;
            move_uploaded_file($file_tmp, $file);

            $data['donor_id']  = $donorId;
            $data['project_id']  = $projectId;
            $data['shortCode']  =  $request->shortCode;
            $data['amount_used']  =  $request->amount_used;
            if(!empty($_FILES['file']['tmp_name'])){
                $data['util_report']  = $filename;
            }
            $data['author']  = Auth::user()->id;
            if(count($fundutil) == 0)
            {
                FundUtil::create($data);
            }else{
                $updateUtil = FundUtil::where('donor_id',$donorId)->where('project_id',$projectId);
                $data['id']  = $request->fundId;
                $data['donor_id']  = $donorId;
                $data['project_id']  = $projectId;
                $data['shortCode']  =  $request->shortCode;
                $data['amount_used']  =  $request->amount_used;
                $data['author']  =   Auth::user()->id;
                if(!empty($_FILES['file']['tmp_name'])){
                    $data['util_report'] =  $filename;
                }
                $updateUtil->update($data);
            }
        }else{
            if(count($fundutil) == 0)
            {
                $data['donor_id']  = $donorId;
                $data['project_id']  = $projectId;
                $data['shortCode']  =  $request->shortCode;
                $data['amount_used']  =  $request->amount_used;
                $data['author']  = Auth::user()->id;
                FundUtil::create($data);
            }else{
                $updateUtil = FundUtil::where('donor_id',$donorId)->where('project_id',$projectId);
                $data['id']  = $request->fundId;
                $data['donor_id']  = $donorId;
                $data['project_id']  = $projectId;
                $data['shortCode']  =  $request->shortCode;
                $data['amount_used']  =  $request->amount_used;
                $data['author']  =   Auth::user()->id;
                $updateUtil->update($data);
            }
        }

        return redirect()->route('dashboard.fundutils.index')->with(['success' => "Utilization Updated successfully"]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FundUtil $fundutil)
    {
        abort_if(Gate::denies('fundutil_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $fundutil->delete();
        return redirect()->back()->with(['success' => "Utilization Deleted successfully"]);
    }


    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function getDocuemntID($userId)
    {
        $result = UserProfile::where('user_id',$userId)->get()->first();
        return $result->document_id;

    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function getDonorName($userId)
    {
        $result = User::where('id',$userId)->get()->first();
        return $result->name;

    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function getProjectName($projectId)
    {
        $result = ProjectMaster::where('id',$projectId)->get()->first();
        return $result->name;

    }

    public static function amountUsed($donorId, $projectId)
    {
        $result = FundUtil::where('project_id',$projectId)->where('donor_id',$donorId)->get()->first();
        return !empty($result->amount_used) ? $result->amount_used :'';
    }

    public static function shortCode($donorId, $projectId)
    {
        $result = FundUtil::where('project_id',$projectId)->where('donor_id',$donorId)->get()->first();
        return !empty($result->shortCode) ? $result->shortCode :'';
    }

    public static function reportFile($donorId, $projectId)
    {
        $result = FundUtil::where('project_id',$projectId)->where('donor_id',$donorId)->get()->first();
        return !empty($result->util_report) ? $result->util_report :'';
    }



}
