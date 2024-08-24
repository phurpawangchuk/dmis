<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProjectMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use File;

class ProjectMasterController extends Controller
{
   public $search;
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('project_panel_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $folderPath ='uploads/reports/';
        $perPage = 10;  $page = 1;
        $projects = ProjectMaster::with('user')->orderBy('created_at','asc')->paginate(10);

        $currentpage = $request->get('page');
        if($currentpage > 1){
            $page = $perPage * ($currentpage - 1);
        }
        Session::put('pages',$page);

        return view('dashboard.projects.index',compact('projects','perPage','folderPath'));
    }

     /* Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create New Project";
        abort_if(Gate::denies('project_create'), Response::HTTP_FORBIDDEN, 'Forbidden');
        return view('dashboard.projects.create', compact('title'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $folderPath ='uploads/reports/';
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
            $data['name']   =  $request->name;
            $data['shortCode'] = $request->shortCode;
            $data['description'] = $request->description;
            $data['author'] = Auth()->id();
            $data['projectreport'] = $request->filename;
            ProjectMaster::create($data);
        }

        return redirect()->route('dashboard.projects.index')->with(['success' => "Project added successfuly"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectMaster $project)
    {
        abort_if(Gate::denies('project_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');
        return view('dashboard.projects.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectMaster $project, Request $request)
    {
        abort_if(Gate::denies('project_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $folderPath ='uploads/reports/';
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
            $project->projectreport = $filename;
            $project->update($request->all());
        }
        return redirect()->route('dashboard.projects.index')->with(['success' => "Project Updated successfully"]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectMaster $project)
    {
        abort_if(Gate::denies('project_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $project->delete();
        return redirect()->back()->with(['success' => "Project Deleted successfully"]);
    }

}
