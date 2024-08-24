<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Config;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('permission_panel_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $perPage = 5;  $page = 1;
        Session::put('pages', $page);
        
        //$permissions = Permission::paginate(10)->appends($request->query());
        $permissions = Permission::orderBy('name','asc')->get();
        return view('dashboard.permissions.index',compact('permissions','perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies(Config::get('constants.PERMISSIONS.PERMISSION_CREATE')), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('dashboard.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionRequest $request)
    {
        Permission::create($request->validated());

        return redirect()->route('dashboard.permissions.index')->with('status-success','New Permission created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        abort_if(Gate::denies(Config::get('constants.PERMISSIONS.PERMISSION_EDIT')), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('dashboard.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(StorePermissionRequest $request, Permission $permission)
    {
        //$permission->update($request->validated());
        $permission->update($request->all());

        return redirect()->route('dashboard.permissions.index')->with('status-success','Permission Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        abort_if(Gate::denies(Config::get('constants.PERMISSIONS.PERMISSION_DELETE')), Response::HTTP_FORBIDDEN, 'Forbidden');

        $permission->delete();

        return redirect()->back()->with('status-success','Permission Deleted successfully');
    }
}
