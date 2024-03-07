<?php

namespace App\Http\Controllers\Ydfusers;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class YdfuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getmanageusers=User::where('role_id','2')->get();
        
        return view ('masters.ydfusers.ydfusers')->with("getmanageusers",$getmanageusers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('masters.ydfusers.addydfusers');
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
            'email' => 'required',
            
        ]);
        //echo $request->input('dname');

        try { 
                       $user=new User;
                       $user->name=$request->input('name');
                       $user->email=$request->input('email');
                       $user->password=Hash::make("ydfuser@123");
                       $user->role_id="2";
                       $user->is_active="1";
                       $user->save();
           
              
               
                       return redirect('Manageusers/index')->with('msg_success', 'Succesfully inserted');
                  
           
              } catch(\Illuminate\Database\QueryException $ex){ 
               // return redirect('Manageusers/index')->with('msg_error', 'Sorry Something is Worrog11');
              dd($ex);
            
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
        $getuser=User::where('id',$id)->first();
        return view('masters.ydfusers.editydfusers')->with('getuser',$getuser);
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
               $user = User::find($id);
               $user->name=$request->input('name');
               $user->email=$request->input('email');
             
              
               $user->is_active=$request->input('optradio');
               $user->save();
   
      
       
               return redirect('Manageusers/index')->with('msg_success', 'Succesfully Upadated');
               
                       
               
              } catch(\Illuminate\Database\QueryException $ex){ 
                return redirect('Manageusers/index')->with('msg_error', 'update failed');
               
             }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resetpassword($id)
    {
        $getuser=User::where('id',$id)->first();
        return view('masters.ydfusers.resetpassword')->with('getuser',$getuser);
    }
    public function passwordupdate(Request $request,$id)
    {
        //
        $request->validate([
            'pw1' => 'required',
            'pw2' => 'required',
            
        ]);
        try{
            // echo $request->input('dat');
               $user = User::find($id);
               if($request->input('pw1')==$request->input('pw2')){
                $user->password=Hash::make($request->input('pw1'));
             
             
              
              
                $user->save();
    
       
        
                return redirect('Manageusers/index')->with('msg_success', 'Succesfully Upadated');
               }
               else{
                   return back()->with('msg_error', 'Password dosnt match');
               }
               
             
             
              
              
               
   
      
       
              
               
                       
               
              } catch(\Illuminate\Database\QueryException $ex){ 
                return redirect('Manageusers/index')->with('msg_error', 'update failed');
               
             }
    }

}
