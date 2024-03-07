<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Donor;
use App\Models\ProjectMaster;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if( Auth::user()->role_id == 3)
        {
            $projects = Donor::select('donors.project_id', 'project_masters.name',DB::raw("SUM(amount) as amount"))
            ->leftJoin('project_masters', 'project_masters.id', '=', 'donors.project_id')
            ->where('is_verified',1)
            ->where('donor_id',Auth::user()->id)
            ->orderBy("project_id")
            ->groupBy("donors.project_id","project_masters.name")
            ->get();

            $events = Event::select('events.event_name','events.event_date')
                        ->orderBy("events.event_date",'desc')
                        ->take(5)
                        ->get();

            return view('dashboard.donor',compact('projects','events'));
        }else
        {
            $projects = Donor::select('donors.project_id', 'project_masters.name',DB::raw("SUM(amount) as amount"))
                        ->leftJoin('project_masters', 'project_masters.id', '=', 'donors.project_id')
                        ->where('is_verified',1)
                        ->orderBy("project_id")
                        ->groupBy("donors.project_id","project_masters.name")
                        ->get();

            $users = User::select('countries.countryName',DB::raw("count(user_id) as country"))
                        ->leftJoin('user_profiles', 'user_profiles.user_id', '=', 'users.id')
                        ->leftJoin('countries', 'countries.id', '=', 'user_profiles.country')
                        ->where('user_profiles.status',1)
                        ->where('user_profiles.country',"!=",'')
                        ->orderBy("countries.countryName")
                        ->groupBy("countries.countryName")
                        ->get();


            $donors = Donor::select('users.id','users.name',DB::raw("sum(amount) as amount"))
                        ->leftJoin('users', 'users.id', '=', 'donors.donor_id')
                        ->where('donors.is_verified',1)
                        ->orderBy("users.id")
                        ->groupBy("users.id","users.name")
                        ->get();

            $userList = User::select('roles.role_name','users.role_id',DB::raw("count(role_id) as count"))
                        ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
                        ->orderBy("roles.role_name")
                        ->groupBy("roles.role_name","users.role_id")
                        ->get();
            return view('dashboard.dashboard',compact('projects','users','donors','userList'));
    }
}
}

