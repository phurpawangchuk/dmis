<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Session;
use Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *

            *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'is_active'=> '1'
        ]);

       $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
           //
           if (Auth::user()->is_active==0)
           {
            return redirect("/login")->with('msg_error','Your account is not active, you cannot use the system');
           }
           elseif (Auth::user()->isStudent())
           {
            return redirect("/login")->with('msg_error','You cannot use this login');
           }
           else
           {
            return redirect("/dashboard");
           }
        }

       return redirect("/login")->with('msg_error','Login information not found, Please try again');

    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('/');
    }


    public function sLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'is_active'=> '1'
        ]);

       $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
           //
           if (Auth::user()->is_active==0)
           {
            return redirect("/loginRegister")->with('msg_error','Your account is not active, you cannot use the system');
           }
           elseif (!Auth::user()->isStudent())
           {
            return redirect("/loginRegister")->with('msg_error','You cannot use this login');
           }
           else
           {
            return redirect("studentDashboard/instructions");
           }
        }

       return redirect("/loginRegister")->with('msg_error','Login information not found, Please try again');

    }
    public function changepassword(){

          return view('auth.changepassword');

    }
    public function postpassword(Request $request){


        if (!(Hash::check($request->input('password'), Auth::user()->password))) {
            // The passwords matches


           return redirect()->back()->with("msg_error","Your current password does not matches with the old password.");
        }
        $user = Auth::user();
        $user->password = bcrypt($request->input('npassword'));
        $user->save();

        return redirect()->back()->with("msg_success","Password successfully changed!");


  }
  public function sLogins()
    {
        return view ('studentsdashboard.payments');
    }

    public function otp()
    {
        return view ('studentsdashboard.otp');
    }

}
