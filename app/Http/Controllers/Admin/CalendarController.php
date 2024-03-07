<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Event;
use App\Http\Requests\EventRequest;
use Config;
use File;
use App\Models\Calendar;

class CalendarController extends Controller
{

    public function index(Request $request)
    {
        abort_if(Gate::denies('event_panel_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $title = "Calendars List";
       
        $perPage = 10;  $page = 1;
        $currentpage = $request->get('page');
        if($currentpage > 1){ 
            $page = $perPage * ($currentpage - 1);
        } 
        Session::put('pages',$page);

        if(Auth()->user()->role_id == 3){ //Donor user
            $calendars = Calendar::where('author', Auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);//get();
        }else{
            $calendars = Calendar::orderBy('created_at', 'desc')->paginate(10);//get();
        }

        return view('dashboard.calendars.index',compact('calendars','title','perPage'));
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $title = "Create New Calendar";
        // $countries = User
        return view('dashboard.calendars.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $data = array(
            "event_name" => $request->event_name,
            "event_date" => $request->event_date,
            "description" => $request->description,
            "author" => auth()->id(),
        );
        Calendar::create($data);
        
        return redirect()->route('dashboard.calendars.index')->with(['success' => "Calendar is created successfully"]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Calendar $calendar)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $title = "Edit Calendar";
        if(Auth()->user()->role_id == 1)
        {
            return view('dashboard.calendars.edit',compact('title','calendar'));
        }else{
            if(Auth()->user()->id == $event->author){
                return view('dashboard.calendars.edit',compact('title','calendar'));
            }else{
                return redirect()->route('dashboard.calendars.edit')->with(['error' => "Sorry..This calendar is does not belong to you."]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calendar $calendar)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');
       
        $calendar->event_name = $request->event_name;
        $calendar->event_date = $request->event_date;
        $calendar->description = $request->description;
        $calendar->save();
        return redirect()->route('dashboard.calendars.index')->with(['success' => "Calendar updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendar $calendar)
    {
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');
       
        $calendar->delete();
        return redirect()->back()->with(['error' => "Calendar Deleted successfully"]);
    }
  
}