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
use App\Models\Donor;
use App\Models\ProjectMaster;
use App\Models\PaymentMaster;
use App\Mail\sendMail;
use App\Models\Country;
use Mail;

use App\Models\UserProfile;
use App\Models\Role;
use Config;
use File;
use PDF;
use DB;
use Illuminate\Support\Facades\Auth;


class DonorController extends Controller
{

    public function index()
    {
        //abort_if(Gate::denies(Config::get('constants.PERMISSIONS.PRODUCT_PANEL_ACCESS')), Response::HTTP_FORBIDDEN, 'Forbidden');
        $projects = ProjectMaster::orderBy('name', 'asc')->get();

        $title = "Manage Donor";
        $roleId = Auth::user()->role_id;
        if($roleId ==3) //Donor User
        {
            $donors = Donor::with('project')->with('paymentmode')->with('user')->where('donor_id',$roleId)->orderBy('created_at', 'desc')->get();
        }else
        {
            $donors = Donor::with('project')->with('paymentmode')->with('user')->orderBy('created_at', 'desc')->get();
        }
       // $donors = Donor::with('project')->with('paymentmode')->with('user')->orderBy('amount', 'DESC')->get();
        $getfrqdonor = Donor::with('user')->groupBy('donor_id')
                      ->selectRaw('count(*) as total,donor_id')
                      ->orderBy('total', 'DESC')
                      ->get();


        return view('dashboard.donors.index',compact('donors','title','roleId','projects'))->with('getfrqdonor',$getfrqdonor);
    }
    public function index1()
    {
        //abort_if(Gate::denies(Config::get('constants.PERMISSIONS.PRODUCT_PANEL_ACCESS')), Response::HTTP_FORBIDDEN, 'Forbidden');
        $projects = ProjectMaster::orderBy('name', 'asc')->get();

        $title = "Manage Donor";
        $roleId = Auth::user()->role_id;
        if($roleId ==3) //Donor User
        {
            $donors = Donor::with('project')->with('paymentmode')->with('user')->where('donor_id',$roleId)->orderBy('created_at', 'desc')->get();
        }else
        {
            $donors = Donor::with('project')->with('paymentmode')->with('user')->orderBy('created_at', 'desc')->get();
        }
       // $donors = Donor::with('project')->with('paymentmode')->with('user')->orderBy('amount', 'DESC')->get();
        $getfrqdonor = Donor::with('user')->groupBy('donor_id')
                      ->selectRaw('count(*) as total,donor_id')
                      ->orderBy('total', 'DESC')
                      ->get();


        return view('dashboard.donors.index1',compact('donors','title','roleId','projects'))->with('getfrqdonor',$getfrqdonor);
    }

    public function donate(Request $request)
    {
        //abort_if(Gate::denies(Config::get('constants.PERMISSIONS.PRODUCT_CREATE')), Response::HTTP_FORBIDDEN, 'Forbidden');

        $projects = ProjectMaster::orderBy('name', 'asc')->get();
        return view('dashboard.donors.donateform', compact(('projects')));
    }

    public function donordonateddetails($donor_id)
    {
        $reports = Donor::with('user')->with('project')->where('donor_id', $donor_id)->get();
        return view('dashboard.donors.donordonateddetails', compact('reports','action'));
    }


    public function search(Request $request)
    {
        $title = "Payment Report";
        $projects = ProjectMaster::orderBy('name', 'asc')->get();
        $roleId = Auth::user()->role_id;
        $from = $request->from;
        $to = $request->to;
        $project = $request->project_id;
        if($project == 'All'){
            $donors = Donor::with('project')->with('user')->whereBetween('payment_date', [$from, $to])->orderBy('created_at', 'desc')->get();
        }else{
            $donors = Donor::with('project')->with('user')->where('project_id',$project)->whereBetween('payment_date', [$from, $to])->orderBy('created_at', 'desc')->get();
        }
          return view('dashboard.donors.index',compact('donors','title','roleId','projects'));
    }

    public function receipt($id)
    {
        $getdonor = Donor::with('project')->with('paymentmode')->with('user')->where('id',$id)->first();
      //  echo $getdonor->project->name;
        $data = [
            'project' => $getdonor->project->name,
            'donor' => $getdonor->user->name,
            'amt' => $getdonor->actualamount,
            'date'=>$getdonor->payment_date,
            'ord'=>$getdonor->orderNo,
            'paymode'=>$getdonor->paymentmode->name,
            'jrn'=>$getdonor->jrn
        ];
        //return view('dashboard.donors.index',compact('donors','title'));
        //abort_if(Gate::denies(Config::get('constants.PERMISSIONS.PRODUCT_CREATE')), Response::HTTP_FORBIDDEN, 'Forbidden');

       // $projects = ProjectMaster::orderBy('name', 'asc')->get();
        //return view('dashboard.donors.receipt', compact(('projects')));
        $pdf = PDF::loadView('dashboard.donors.receipt', $data);
        return $pdf->download('receipt.pdf');

    }


    public function nextstep(Request $request)
    {
        $number = "";
        for($i=0; $i<10; $i++) {
        $min = ($i == 0) ? 1:0;
        $number .= mt_rand($min,9);
        }
        $orderNo = date('Ymd').$number;
        $data = array(
            "project_id" => $request->project_id,
            "amount" => $request->amount,
            "paymentoption" => 1,
            "orderNo" => $orderNo,
            "donor_id" => auth()->id(),
            "payment_date" => date('Y-m-d'),
            "status" => 'DF',
            "is_verified" =>'',
        );
        $donor = $request->session()->put('donor', $data);
        Donor::create($data);

        return view('dashboard.donors.nextstep');
    }


    public function details($param)
    {
        $params = explode('-',$param);
        $id = $params[0];
        $action = $params[1];
        $user = User::find($id);
        return view('dashboard.donors.donordetails', compact('user','action'));
    }

    public function onlinepayment(Request $request)
    {
        $txtTime = date("Ymdhms");
        $donor = $request->session()->get('donor');

        $bfs_msgType = "AR";
        $bfs_benfTxnTime = $txtTime;
        $bfs_orderNo = $donor['orderNo'];
        $bfs_benfId = "XXXXXX";
        $bfs_benfBankCode = "01";
        $bfs_txnCurrency = "BTN";
        $bfs_txnAmount = $donor['amount'];
        $bfs_remitterEmail = "pema12@gmail.com";
        $bfs_paymentDesc = "Donation";
        $bfs_version = "1.0";
        $data = $bfs_benfBankCode.'|'.$bfs_benfId.'|'.$bfs_benfTxnTime.'|'.$bfs_msgType.'|'.$bfs_orderNo.'|'.$bfs_paymentDesc.'|'.$bfs_remitterEmail.'|'.$bfs_txnAmount.'|'.$bfs_txnCurrency.'|'.$bfs_version;

        return view('dashboard.donors.onlinepayment',compact('bfs_msgType', 'bfs_benfTxnTime', 'bfs_orderNo', 'bfs_benfId', 'bfs_benfBankCode',
        'bfs_txnCurrency', 'bfs_txnAmount', 'bfs_remitterEmail', 'bfs_paymentDesc', 'bfs_version', 'bfs_checkSum','data'));
    }


    /*public function makepayment(Request $request)
    {
        $amount = $request->get('amount');

        $number = "";
        for($i=0; $i<10; $i++) {
        $min = ($i == 0) ? 1:0;
        $number .= mt_rand($min,9);
        }
        $today = date("Ymdhms");

        $donor = $request->session()->get('donor');

        $bfs_msgType = "AR";
        $bfs_benfTxnTime = $today;
        $bfs_orderNo = $donor['orderNo'];
        $bfs_benfId = "KEY_111";
        $bfs_benfBankCode = "01";
        $bfs_txnCurrency = "BTN";
        $bfs_txnAmount = $donor['amount'];
        $bfs_remitterEmail = "test@gmail.com";
        $bfs_paymentDesc = "Fee";
        $bfs_version = "1.0";
        $data = $bfs_benfBankCode.'|'.$bfs_benfId.'|'.$bfs_benfTxnTime.'|'.$bfs_msgType.'|'.$bfs_orderNo.'|'.$bfs_paymentDesc.'|'.$bfs_remitterEmail.'|'.$bfs_txnAmount.'|'.$bfs_txnCurrency.'|'.$bfs_version;

        $key = File::get(base_path().'/config/keys/XXXXX.key');

        $p = openssl_pkey_get_private($key);
        openssl_sign($data, $signature, $p);
        openssl_free_key($p);
        $signed = bin2hex($signature);
        $bfs_checkSum = strtoupper($signed);

        return view('dashboard.donors.makepayment',compact('bfs_msgType', 'bfs_benfTxnTime', 'bfs_orderNo', 'bfs_benfId', 'bfs_benfBankCode',
        'bfs_txnCurrency', 'bfs_txnAmount', 'bfs_remitterEmail', 'bfs_paymentDesc', 'bfs_version', 'bfs_checkSum','data'));

    }*/

    public function postDonate(Request $request)
    {
        //abort_if(Gate::denies(Config::get('constants.PERMISSIONS.PRODUCT_CREATE')), Response::HTTP_FORBIDDEN, 'Forbidden');
        $number = "";
        for($i=0; $i<10; $i++) {
        $min = ($i == 0) ? 1:0;
        $number .= mt_rand($min,9);
        }
        $orderNo = date('Ymd').$number;
        $amount = $request->amount;
        $data = array(
            "project_id" => $request->project_id,
            "amount" => $amount,
            "paymentoption" => 1,
            "jrn" => $request->jrn,
            "donor_id" => auth()->id(),
            "payment_date" => date('Y-m-d'),
            "bank" => $request->bank,
            "status" => 'DF',
            "actualamount" =>  $request->amount,
            "jrn_updatedby" => '',
            "is_verified" =>'',
        );
        $donor = $request->session()->put('donor', $data);
        Donor::create($data);
        // return redirect()->route('dashboard.donors.onlinepayment');
        return redirect()->route('dashboard.donors.donateform')->with(['success' => "Payment initiated successfully"]);
    }

    public function edit(Donor $donor)
    {
        return view('dashboard.donors.edit',compact('donor'));
    }



    public function update(Request $request, Donor $donor)
    {
        $donor = $donor->find($donor->id);
        $donor->is_verified = $request->status;
        $donor->actualamount = $request->actualamount;
        $donor->jrn_updatedby = Auth::user()->id;
        $donor->save();

        return redirect()->route('dashboard.donors.index')->with(['success' => "Jrn Updated successfully"]);
    }


    public function festgreeting(Request $request)
    {

        $nationalities = UserProfile::select('countries.*','user_profiles.*')
                    ->leftJoin('countries', 'countries.id', '=', 'user_profiles.country')
                    ->groupBy('user_profiles.country')
                    ->get();
       return view('dashboard.donors.festgreeting', compact('nationalities'));
    }

    public function sending(Request $request)
    {
        $nationality = '';

        for($i=0; $i<count($request['nationality']); $i++)
        {
            if($nationality != $request['nationality'][$i]){
                $user = UserProfile::with('user')->where('country',$request['nationality'][$i])->get();
                for($i=0; $i<count($user); $i++){
                    $to =  $user[$i]['user']['email'];

                    $details = [
                                'title' => 'Greeting from YDF',
                                'body' => $request['message']
                            ];
                    $nationality = $request['nationality'][$i];
                    Mail::to($to)->send(new sendMail($details));
                }
            }
        }

        return view('dashboard.donors.sending')->with(['success' => "Message sent successfully"]);

    }


    public function sendgreeting(Request $request)
    {
        $users = User::with('profile')->orderBy('created_at', 'asc')->get();
        return view('dashboard.donors.send-greeting', compact(('users')));
    }

    public function send(Request $request)
    {
       $usersList = $request['users'];
       $arr = array();

      for($i=0; $i<count($usersList); $i++){
          $userDtl=User::find($usersList[$i]);
          array_push($arr, $userDtl->email);

      }
       foreach($arr as $email){
            $to = $email;
            $details = [
                        'title' => 'Greeting from YDF',
                        'body' => $request['message']
                    ];
            Mail::to($to)->send(new sendMail($details));
        }
        return view('dashboard.donors.send')->with(['success' => "Message sent successfully"]);
    }

    // public function rma()
    // {
    //     abort_if(Gate::denies(Config::get('constants.PERMISSIONS.PRODUCT_PANEL_ACCESS')), Response::HTTP_FORBIDDEN, 'Forbidden');
    //     $title = "Donation list using RMA PaymentGateway";
    //     $reports = Donor::with('project')->with('paymentmode')->with('user')->where('paymentoption','=',1)->get();
    //     return view('dashboard.donors.rma',compact('reports','title'));
    // }

    public function donationhistory()
    {
        //abort_if(Gate::denies(Config::get('constants.PERMISSIONS.PRODUCT_PANEL_ACCESS')), Response::HTTP_FORBIDDEN, 'Forbidden');
        $title = "Donation History";
        $id = Auth::user()->id;
        $reports = Donor::with('project')->with('paymentmode')->with('user')->where('paymentoption','=',1)->where('donor_id',$id)->get();
        /// echo $id;
         //echo $report
        return view('dashboard.donors.donationhistory',compact('reports','title'));
    }

    public function offlinedonation()
    {
        //abort_if(Gate::denies(Config::get('constants.PERMISSIONS.PRODUCT_PANEL_ACCESS')), Response::HTTP_FORBIDDEN, 'Forbidden');
        $title = "Collect Offline Donation";
        $countries = Country::orderBy('created_at','asc')->get();
        $projects = ProjectMaster::orderBy('name', 'asc')->get();
        $paymentModes = PaymentMaster::orderBy('name', 'asc')->get();
        return view('dashboard.donors.offlinedonation',compact('countries','title','projects','paymentModes'));
    }

    public function registereddonor()
    {
        //abort_if(Gate::denies(Config::get('constants.PERMISSIONS.PRODUCT_PANEL_ACCESS')), Response::HTTP_FORBIDDEN, 'Forbidden');
        $title = "Donor User Registered List";
        $users = User::where('role_id','=',3)->orderBy('created_at', 'desc')->get();
        return view('dashboard.donors.registereddonor',compact('users','title'));
    }

    public function store(Request $request)
    {
        $number = "";
        for($i=0; $i<10; $i++) {
        $min = ($i == 0) ? 1:0;
        $number .= mt_rand($min,9);
        }
        $orderNo = date('Ymd').$number;

        $data['name']   = $request->name;
        $data['email']   = $request->email;
        $data['address']   = $request->address;
        $data['contactno']   = $request->contactno;
        $data['project_id']   = $request->project_id;
        $data['amount']   = $request->amount;
        $data['paymentoption']   = $request->paymentoption;
        $data['payment_date']   = $request->payment_date;
        $data['author']  = auth()->id();
        $data['orderNo'] = $orderNo;

        OfflineDonor::create($data);

        return redirect()->route('dashboard.donors.offlinedonorindex')->with(['status-success' => "Collected donation successfully"]);
    }
    public function charts()
    {
    }
    public function birthdaynotifiaction(Request $req){
        //  if(isset($var)){
        /*if($req->input('view')!=''){
            //$update_query=DB::table('comments')->where('comment_status','0')->update(['comment_status'=>'1']);
        }*/
        //echo date('d');
        // exit();
        $output = '';
        $getbrithdaynoc= User::where('status','0')
                                ->whereMonth('dob',date('m'))
                                ->whereDay('dob',date('d'))
                                ->get();
        foreach($getbrithdaynoc as $noc)
        {

        // exit();
    //   echo'<script src='.asset("/js/jquery.min.js").'></script>';
        $output .= '
                    <a class="dropdown-item" href="#" data-toggle="modal" id="userButton" data-target="#userModal" data-attr='.route('dashboard.donors.birthdaywishes', $noc->id).'>
                    <i class="fas fa-user"></i>'.$noc->name.'('.$noc->email.')<br/>
                    </a>
                    ';
        }
        //$count="1";
        $count = User::where('status','0')
                ->whereMonth('dob',date('m'))
                ->whereDay('dob',date('d'))->count();
                $data = array(
                    'notification' => $output,
                    'unseen_notification'  => $count
                );
            echo json_encode($data);
     }

     Public function inactivedonorlist(Request $request)
     {
        $results = User::with('profile')->where('status',0)->where('role_id',3)->get();
        // dd($results);
        return view('dashboard.donors.inactivedonorlist', compact('results'));

     }

     Public function donorlist(Request $request)
     {

        $getdonortotalamt = Donor::with('user')->groupBy('donor_id')
                                ->selectRaw('sum(actualamount) as Amount,donor_id')
                                ->orderBy('Amount', 'DESC')
                                ->having('Amount', '>', 0)
                                ->get();

        $getfrqdonor = Donor::with('user')->groupBy('donor_id')
                                         ->selectRaw('count(*) as total,donor_id')
                                         ->orderBy('total', 'DESC')
                                         ->get();


                          // return view('dashboard.donors.index',compact('donors','title','roleId'))->with('getfrqdonor',$getfrqdonor);
        return view('dashboard.donors.donorlist')->with('getdonortotalamt',$getdonortotalamt)->with('getfrqdonor',$getfrqdonor);
     }

     public function birthdaynotifiactionupdate(Request $req)
     {

        $details = [
            'title' => 'Greeting from YDF',
            'body' => $req->input('wish')
        ];

         Mail::to($req->input('email'))->send(new sendMail($details));
        $update_query=User::where('status','0')->where('id',$req->input('id'))
        ->whereMonth('dob',date('m'))
        ->whereDay('dob',date('d'))->update(['status'=>'1']);
         echo json_encode("Greeting Sent Succesfully");

     }

     public function birthdaywishes(User $user)

     {
        return view('dashboard.donors.brithdaywishespost',compact('user'));

     }


}
