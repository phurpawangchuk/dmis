<?php

namespace App\Http\Controllers\Admin;

use File;
use Config;
use App\Models\Role;
use App\Models\User;
use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sliders = Slider::all();

        return view('dashboard.sliders.index',compact('sliders'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('slider_create'), Response::HTTP_FORBIDDEN, 'Forbidden');
       //abort_if(Gate::denies(Config::get('constants.PERMISSIONS.USER_CREATE')), Response::HTTP_FORBIDDEN, 'Forbidden');
        return view('dashboard.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(Request $request)
    {

        $request->validate([
            'file_name' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);

        $folderPath ='uploads/sliders/';
        if(!is_dir($folderPath)){
            mkdir($folderPath, 0755);
        }

        $file_tmp = $_FILES['file_name']['tmp_name'];
        $extension = $request->file_name->extension();
        $filename = uniqid() . '.'.$extension;
        $file = $folderPath. $filename;
        if(move_uploaded_file($file_tmp, $file)){

            $data = array(
                'title' => $request->title,
                'filename' 	=> $filename,
                'author' 	=> Auth::user()->id,
            );
            Slider::create($data);

        }
        return redirect('/sliders')->with(['success' => "Slider Image added successfully"]);
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

    public function updateprofile(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $userprofile = UserProfile::find($request->profile_id);
        $userprofile->address = (!empty($request->address) ? $request->address:'');
        $userprofile->company = (!empty($request->company) ? $request->company:'');
        $userprofile->contactno = (!empty($request->contactno) ? $request->contactno:'');
        $userprofile->document_id = (!empty($request->document_id) ? $request->document_id:'');
        $userprofile->countryCode = (!empty($request->countryCode) ? $request->countryCode:'');

        $userprofile->user_id = Auth()->id();
        $userprofile->author = Auth()->id();
        $userprofile->status = 1;
        $userprofile->save();

        return redirect()->route('dashboard.sliders.index')->with(['success' => "User Updated successfully"]);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_if(Gate::denies('slider_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $roles = Role::pluck('role_name','id');
        return view('dashboard.sliders.edit',compact('user','roles'));
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
        $user->name = $request->name;
        $user->email = $request->email;
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

        return redirect()->route('dashboard.sliders.index')->with(['success' => "User Updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        abort_if(Gate::denies('slider_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $slider->delete();
        return redirect()->back()->with(['success' => "Slider deleted successfully"]);
    }
}
