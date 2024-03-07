<?php

namespace App\Http\Controllers\Sponsers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sponser;
use Auth;

class SponserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $getsponsers=Sponser::with(['sponserscholarship'])->get();
       
        
        return view ('masters.sponsers.sponsers')->with("getsponsers",$getsponsers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('masters.sponsers.addsponsers');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'address'=>'required',
            
        ]);
        //echo $request->input('dname');

        try { 
                       $sponser=new Sponser;
                       $sponser->name=$request->input('name');
                       $sponser->type=$request->input('type');
                       $sponser->address=$request->input('address');
                       $sponser->updated_by=Auth::user()->id;
                       $sponser->save();
               
                       return redirect('Sponsers/index')->with('msg_success', 'Succesfully inserted');
           
              } catch(\Illuminate\Database\QueryException $ex){ 
                return redirect('Sponsers/index')->with('msg_error', 'Sorry Something is Worrog11');
              //dd($ex);
           }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getsponser=Sponser::where('id',$id)->first();
        return view('masters.sponsers.editsponsers')->with('getsponser',$getsponser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try{
            // echo $request->input('dat');
               $sponser = Sponser::find($id);
               $sponser->name=$request->input('name');
               $sponser->type=$request->input('type');
               $sponser->address=$request->input('address');
               $sponser->save();
               return redirect('Sponsers/index')->with('msg_success', 'Succesfully update');
               
                       
               
              } catch(\Illuminate\Database\QueryException $ex){ 
                //return redirect('Sponsers/index')->with('msg_error', 'failed update');
                dd($ex);
               
             }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            $sponser = Sponser::find($id);
            $sponser->delete();
            return redirect('Sponsers/index')->with('msg_success', 'Succesfully Deleted');
        
        }
        catch(\Illuminate\Database\QueryException $ex){ 
            return redirect('Sponsers/index')->with('msg_error', 'Cant delete');
         
       }
    }
}
