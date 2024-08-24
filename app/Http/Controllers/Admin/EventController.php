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

class EventController extends Controller
{

    public function index(Request $request)
    {
        abort_if(Gate::denies('event_panel_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $title = "YDF Event List";
       
        $perPage = 10;  $page = 1;
        $currentpage = $request->get('page');
        if($currentpage > 1){ 
            $page = $perPage * ($currentpage - 1);
        } 
        Session::put('pages',$page);

        if(Auth()->user()->role_id == 2 || Auth()->user()->role_id == 3){ //YDF-DOnor user
            $events = Event::where('author', Auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);//get();
        }else{
            $events = Event::orderBy('created_at', 'desc')->paginate(10);//get();
        }
        $events = Event::orderBy('created_at', 'desc')->paginate(10);//get();
        return view('dashboard.events.index',compact('events','title','perPage'));
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $title = "Create New Event";
        return view('dashboard.events.create',compact('title'));
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
       if($request->Date<10){
             $day="0".$request->Date;
       }else{
        $day=$request->Date;
       }

        $event_date = $request->year."-".$request->month."-".$day;

         $data = array(
            "event_name" => $request->event_name,
            "event_date" => $event_date,
            "description" => $request->description,
            "author" => auth()->id(),
        );
        Event::create($data);
        
        return redirect()->route('dashboard.events.index')->with(['success' => "Event is created successfully"]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $title = "Edit Event";
        if(Auth()->user()->role_id == 1)
        {
            
            
            return view('dashboard.events.edit',compact('title','event'));
        }else{
            if(Auth()->user()->id == $event->author){
                return view('dashboard.events.edit',compact('title','event'));
            }else{
                return redirect()->route('dashboard.events.edit')->with(['error' => "Sorry..This event is does not belong to you."]);
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
    public function update(Request $request, Event $event)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');
        if($request->Date==00){
            $day="01";
         }
         elseif($request->Date<10){
            $day="0".$request->Date;
         }else{
       $day=$request->Date;
      }
       
       $event_date = $request->year."-".$request->month."-".$day;
       
        $event->event_name = $request->event_name;
        $event->event_date = $event_date;
        $event->description = $request->description;
        $event->save();
        return redirect()->route('dashboard.events.index')->with(['success' => "Event updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');
       
        $event->delete();
        return redirect()->back()->with(['error' => "Event Deleted successfully"]);
    }
  
}