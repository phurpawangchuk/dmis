<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use App\Models\Sponser;
use App\Models\Scholarship;
use App\Models\Testimony;
use App\Models\Event;
use App\Models\UserProfile;
use App\Models\Country;
use Mail;
use App\Models\ProjectMaster;
use App\Mail\sendMail;
use App\Models\Religion;

class FrontController extends Controller
{

    public function welcome()
    {
        $projects = ProjectMaster::all();
        $events = Event::orderBy('created_at','desc')->take(5)->get();
        return view ('frontend.welcome',compact('projects','events'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = ProjectMaster::all();
        $events = Event::orderBy('created_at','desc')->take(5)->get();

        return view ('frontend.frontpage',compact('projects','events'));
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
    public function donorregistration(Request $request)
    {
        $countries = Country::orderBy('countryName')->get();
        $religions = Religion::orderBy('name')->get();
        return view ('frontend.donorregister',compact('countries','religions'));
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
    public function goLogin()
    {
        return view ('auth.login');
    }

    public function scholarshipDetails($id)
    {

       $scholarshipdetail=Scholarship::with(['scholarshipsponser'])->where('id',$id)->first();

        return view ('frontend.details')->with('scholarshipdetail',$scholarshipdetail);
    }

    public function loginRegister()
    {
        return view ('frontend.registerlogin');
    }


    public function studentRegistration()
    {
        return view ('frontend.studentregister');
    }

    public function studentLogin()
    {
        return view ('frontend.studentlogin');
    }

    public function allScholarships()
    {
        $scholarships=Scholarship:: where('is_active',1)->get();
        return view ('frontend.allscholarships',compact('scholarships'));
    }

    public function registration(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'email' => 'required',
            'psw' => 'required'
        ]);

        //GET
        $document_id = (!empty($request->document_id) ? $request->document_id:'');
        $fullname = (!empty($request->fullname) ? $request->fullname:'');
        $countryCode = (!empty($request->country) ? $request->country:'');
        $nationality = (!empty($request->nationality) ? $request->nationality:'');
        $email=$request->email;
        $password=Hash::make($request->psw);

        //checking email in users

        $emailuser=User::where('email','=',$email)->first();

        if($emailuser)
        {
            return redirect("/donorregistration")->with(['error'=>'Email is already used. Please provide different email and try again']);
        }
        else
        {
            $cidprofile=UserProfile::where('document_id','=',$document_id)->first();

            if ($cidprofile)
            {
                return redirect("/donorregistration")->with(['error'=>'There is already profile with this document Number, Please check and try again']);
            }
            else
            {
                $userData['role_id']   = 3;
                $userData['name']   = $fullname;
                $userData['email']   = $email;
                $userData['password']  = $password;
                $userData['dob']  = date('Y-m-d',strtotime('1901-01-01'));;

                $userId = User::create($userData);


                $profileData['user_id']   = $userId->id;
                $profileData['address']   = (!empty($request->address) ? $request->address:'');
                $profileData['company']   = (!empty($request->company) ? $request->company:'');
                $profileData['contactno']   = (!empty($request->contactno) ? $request->contactno:'');
                $profileData['country']   =  (!empty($request->country) ? $request->country:'');
                $profileData['nationality']   = $nationality;
                $profileData['religion']   = (!empty($request->religion) ? $request->religion:'');
                $profileData['status']  = 1;
                $profileData['document_id']  = $document_id;
               // $profileData['author']  = '';
                UserProfile::create($profileData);

                return redirect("/register")->with('success', 'Registration successful. Please use your email and password to login and update your profile.');

            }
        }
    }


    public function forgotpassword(Request $request){
        if($request->getMethod() == "GET"){
            return view('frontend.forgotpassword');
        }else{
            if(User::where('email',$request->email)->exists()) {
                $bytes = random_bytes(4);

                $user = User::where('email',$request->email)->first();
                $userpasswordupdated=User::find($user->id);
                $userpasswordupdated->password=Hash::make(bin2hex($bytes));
                $userpasswordupdated->save();

                $details = [
                    'title' =>'New password for DMiS',
                    'body' => "Your new password for DMiS is ".bin2hex($bytes)
                  ];
                  try{
                        Mail::to($request->email)->send(new sendMail($details));
                        return redirect()->back()->with("success","Password sent to your email.");
                    }
                    catch(\Exception $e){
                        dd($e);
                  }

            }else{
                return redirect()->back()->with("error","Sorry we donot have your information...");
            }
        }
    }

    public function studentForgotPage(){
        return view('frontend.studentforgotpassword');
    }

    public function studentForgotPost(Request $request){

          if(User::where('email',$request->input('email') )->exists()) {

              $bytes = random_bytes(4);

              $user=User::where('email',$request->input('email'))->first();
              $userpasswordupdated=User::find($user->id);
              $userpasswordupdated->password=Hash::make(bin2hex($bytes));
              $userpasswordupdated->save();

              $details = [
                'title' =>'new password',
                'body' => bin2hex($bytes)
              ];
                  try{
                  \Mail::to($request->input('email'))->send(new \App\Mail\Mail\SentMail($details));
                  return redirect()->back()->with("msg_success","Password sent To your mail");
                  }
                  catch(\Exception $e){
                    dd($e);
                }


           }else{
                 return redirect()->back()->with("msg_error","Sorry email is worong");

        }


    }
    public function partners(){
        return view('frontend.partners');
    }

    public function resultDetails ($id)
    {
        $sid=$id;
        $scholarship=Scholarship::findorfail($id);
        $profiles=Profile::wherehas('profileresult',function($q) use ($sid){
            $q->where('scholarship_id',$sid)
            ->where('is_finalized',1);
        })
        ->get();
        return view ('frontend.detailresult',compact('profiles','scholarship'));
    }
}
