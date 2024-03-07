<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\AgencyMaster;
use App\Models\DepartmentMaster;
use App\Models\DivisionMaster;
use App\Models\ProjectMaster;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserPhotoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Config;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //abort_if(Gate::denies('user_panel_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $perPage = 10;  $page = 1;
        $users = User::with('role')->with('profile')->paginate($perPage);

        $currentpage = $request->get('page');
        if($currentpage > 1){
            $page = $perPage * ($currentpage - 1);
        }
        Session::put('pages',$page);

        $userId = User::find(Auth()->id());
        if($userId->role_id == 3){ //Donor User
            return redirect("/donor")->with(['success' => "Profile updated successfully"]);
        }else{
            return view('dashboard.users.index',compact('users','perPage'));
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies(Config::get('constants.PERMISSIONS.USER_CREATE')), Response::HTTP_FORBIDDEN, 'Forbidden');

        $roles = Role::pluck('role_name','id');
        $countries = Country::orderBy('countryName','asc')->get();
        return view('dashboard.users.create',compact('roles','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        if($request->Date==00){
            $day="01";
         }
         elseif($request->Date<10){
            $day="0".$request->Date;
         }else{
       $day=$request->Date;
      }

        $dob = $request->year."-".$request->month."-".$day;
        $userData['role_id']   = $request->role_id;
      //  $userData['author']  = auth()->id();
        $userData['name']   = $request->name;
        $userData['dob']   = $dob;
        $userData['email']   = $request->email;
        $userData['password']  = Hash::make($request->password);
        $userId = User::create($userData);

        $profileData['user_id']   = $userId->id;
        $profileData['address']   = $request->address;
        $profileData['company']   = $request->company;
        $profileData['contactno']   = $request->contactno;
        $profileData['status']  = $request->status;
        $profileData['document_id']  = $request->document_id;
        $userprofile['countryCode'] = $request->countryCode;

       // $profileData['author']  = auth()->id();

        UserProfile::create($profileData);

        return redirect()->route('dashboard.users.index')->with(['status-success' => "New User created successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $permission
     * @return \Illuminate\Http\Response
     */
    public function view(User $user)
    {
        //
    }

    public function changepwd(Request $request)
    {
        if($request->getMethod() == 'POST'){
            $user = User::find( Auth()->id());
            $user->password  = Hash::make($request->password);
            $user->save();
            return redirect()->route('dashboard.users.index')->with(['success' => "Passsword updated successfully"]);
        }
        return view('dashboard.users.changepwd');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile(User $user)
    {
        $userDtl = User::find(Auth()->id());
        $countries = Country::orderBy('countryName','asc')->get();
        if($userDtl->role_id == 3){ //Donor User
            $user = $userDtl;
            return view('dashboard.users.profile',compact('user','countries'));
        }else{
            return view('dashboard.users.profile',compact('user','countries'));
        }
    }

    public function updateprofile(Request $request, User $user)
    {
        // $data = $request->validated();
         if($request->Date==00){
            $day="01";
         }
         elseif($request->Date<10){
            $day="0".$request->Date;
         }else{
            $day=$request->Date;
         }
         $dob = $request->year."-".$request->month."-".$day;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->dob = $dob;
        $user->save();

        $userprofile = UserProfile::find($request->profile_id);
        $userprofile->address = (!empty($request->address) ? $request->address:'');
        $userprofile->company = (!empty($request->company) ? $request->company:'');
        $userprofile->contactno = (!empty($request->contactno) ? $request->contactno:'');
        $userprofile->document_id = (!empty($request->document_id) ? $request->document_id:'');
        $userprofile->country = (!empty($request->countryCode) ? $request->countryCode:'');

        $userprofile->user_id = Auth()->id();
        $userprofile->author = Auth()->id();
        $userprofile->status = 1;
        $userprofile->save();

        return redirect()->route('dashboard.users.index')->with(['success' => "User Updated successfully"]);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $roles = Role::pluck('role_name','id');
        return view('dashboard.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = $user->find($request->user_id);
        if($request->Date==00){
            $day="01";

         }
         elseif($request->Date<10){
            $day="0".$request->Date;
         }else{
            $day=$request->Date;
        }
       //echo $day;
       $dob = $request->year."-".$request->month."-".$day;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->dob=$dob;
        $user->role_id = $request->role_id;
        if(!empty($request->password)){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        $userProfile = UserProfile::find($request->profile_id);
        $userProfile->address = $request->address;
        $userProfile->company = $request->company;
        $userProfile->contactno = $request->contactno;
        $userProfile->document_id = (!empty($request->document_id) ? $request->document_id:'');
        $userProfile->status = $request->status;
        $userProfile->author = auth()->id();
        $userProfile->save();

        return redirect()->route('dashboard.users.index')->with(['success' => "User Updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $user->delete();
        return redirect()->back()->with(['success' => "User Deleted successfully"]);
    }
}
