<?php

namespace App\Http\Controllers\Institutes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institute;
use App\Models\Countries;
use Auth;

class InstituteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $getinstitutes=Institute::with("country")->get();
       

        

        return view ('masters.institutes.institutes')->with("getinstitutes",$getinstitutes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getcountry=Countries::all();
        
        return view ('masters.institutes.addinstitutes')->with('getcountry',$getcountry);
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
            'location' => 'required',
            'country' => 'required',
            
        ]);
        //echo $request->input('dname');

        try { 
                       $institute=new Institute;
                       $institute->name=$request->input('name');
                       $institute->location=$request->input('location');
                       $institute->country_id=$request->input('country');
                       $institute->updated_by=Auth::user()->id;
                       $institute->save();
           
              
               
                       return redirect('Institutes/index')->with('msg_success', 'Succesfully inserted');
                  
           
              } catch(\Illuminate\Database\QueryException $ex){ 
               return redirect('Institutes/index')->with('msg_error', 'Sorry Something is Worrog11');
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
        $getcountry=Countries::all();
        $institute=Institute::with("country")->where('id',$id)->first();
       
        return view ('masters.institutes.editinstitutes')->with('getcountry',$getcountry)->with('institute',$institute);
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
        
       try{
            // echo $request->input('dat');
               $institute = Institute::find($id);
               $institute->name=$request->input('name');
               $institute->location=$request->input('location');
               $institute->country_id=$request->input('country');
               $institute->save();
           
              
               
                       return redirect('Institutes/index')->with('msg_success', 'Succesfully Update');
               
                       
               
              } catch(\Illuminate\Database\QueryException $ex){ 
                return redirect('Institutes/index')->with('msg_error', 'Sorry Something is Worrog11');
                //dd($ex);
               
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
        try{
            $institute = Institute::find($id);
            $institute->delete();
            return redirect('Institutes/index')->with('msg_success', 'Succesfully Deleted');
        
        }
        catch(\Illuminate\Database\QueryException $ex){ 
            return redirect('Institutes/index')->with('msg_error', 'Cant delete');
         
       }
    }
}
