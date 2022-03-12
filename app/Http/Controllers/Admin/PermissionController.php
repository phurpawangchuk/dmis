<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('permissions_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $perPage = 10;  $page = 1;
        $permissions = Permission::paginate($perPage);

        $currentpage = $permissions->currentPage();
        
        if($currentpage > 1){ 
            $page = $perPage * ($currentpage - 1);
        }
        Session::put('pages',$page);

        //$permissions = Permission::paginate(10)->appends($request->query());
        return view('admin.permissions.index',compact('permissions','perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('admin.permissions.create');
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

        return redirect()->route('admin.permissions.index')->with('status-success','New Permission created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        abort_if(Gate::denies('permission_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('admin.permissions.edit', compact('permission'));
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

        return redirect()->route('admin.permissions.index')->with('status-success','Permission Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $permission->delete();

        return redirect()->back()->with('status-success','Permission Deleted successfully');
    }
}
