<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use Config;

class ApiController extends Controller
{
    function __construct() {
        $this->client = new Client([
            'curl' => array( CURLOPT_SSL_VERIFYPEER => false),
            'base_uri' => Config::get('datahub.api.DCRC_CITIZEN_DETAILS'),
            'timeout'  => 20,
        ]);
    }
      
    public function citizenDetails(Request $request)
    {
        $citizenData = $this->getApplicationDetails('10906000331');
        return view('admin.api.citizen',compact('citizenData'));
    }

    public function getAuthorizationCode() {
        return base64_encode(Config::get('datahub.api.CLIENT_ID').':'.Config::get('datahub.api.CLIENT_SECRET'));
      }
    
    public function getApplicationDetails($cid) {
        $response = $this->client->request('POST', Config::get('datahub.api.TOKEN_ENDPOINT'), 
            [
            'headers' => ['Authorization' => 'Basic '.$this->getAuthorizationCode()],
            'form_params' =>  [
                'grant_type' => 'client_credentials'
            ]
            ]); 
        
        if($response->getStatusCode()==200) {
            $jsonObject = json_decode($response->getBody());
            $res = $this->client->request('GET', 'citizendetails/'.$cid, 
            [
            'headers' => [
                'Authorization' => 'Bearer '.$jsonObject->access_token,
                'Accept'        => 'Application/json'
            ],
                'form_params' =>  [
                'grant_type' => 'client_credentials'
                ]
            ]);

            $json = json_decode($res->getBody(),true);
            $allResponse = $json['citizenDetailsResponse'];
            foreach ($allResponse as $data){
                $resDetail = $data;
            }
            return $resDetail[0];
        } 
    }
}
