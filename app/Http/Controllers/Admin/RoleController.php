<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Config;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('role_panel_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        //$roles = Role::with('permissions')->paginate(5)->appends($request->query());;
        $perPage = 10;  $page = 1;
        $roles = Role::with('permissions')->paginate($perPage);

        $currentpage = $roles->currentPage();
        
        if($currentpage > 1){ 
            $page = $perPage * ($currentpage - 1);
        }
        Session::put('pages',$page);

        return view('dashboard.roles.index',compact('roles','perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $permissions = Permission::all()->pluck('name', 'id');

        return view('dashboard.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->all());
        $role->permissions()->sync($request->permissions);

        return redirect()->route('dashboard.roles.index')->with('status-success','New Role created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        abort_if(Gate::denies('role_show'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('dashboard.roles.show',compact('role'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        abort_if(Gate::denies(Config::get('constants.PERMISSIONS.ROLE_EDIT')), Response::HTTP_FORBIDDEN, 'Forbidden');

        $permissions = Permission::all()->pluck('name', 'id');

        return view('dashboard.roles.edit', compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRoleRequest $request, Role $role)
    {
        // $role->update($request->validated());
        $role->update($request->all());
        $role->permissions()->sync($request->permissions);
        //$role->permissions()->sync([1,2,6]);

        return redirect()->route('dashboard.roles.index')->with('status-success','Role Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        abort_if(Gate::denies(Config::get('constants.PERMISSIONS.ROLE_DELETE')), Response::HTTP_FORBIDDEN, 'Forbidden');

        $role->delete();

        return redirect()->back()->with(['status-success' => "Role Deleted successfully"]);
    }
}
