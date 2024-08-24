<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Gewog;
use App\Models\Village;


class ComponentController extends Controller
{
    public function displayProfileImage($profile)
    {

        $profilePictureMissing = Storage::missing('profile/' . $profile . '.jpg');

        if ($profilePictureMissing) {
            $noImageFile = file_get_contents(public_path() . '/images/no-image.jpg');
            
            
            return \Response::make($noImageFile, 200)->header("Content-Type", 'image/jpg');
        }

        $file = Storage::get('profile/' . $profile . '.jpg');
        $type = Storage::mimeType('profile/' . $profile . '.jpg');

        $response = \Response::make($file, 200)->header("Content-Type", $type);

        return $response;
    }

    public function displayDocument ($link)
    {
        $file=Storage::download('document/'.$link);
        return $file;
    }

    public function getGewogByDzongkhag($dzongkhagId, Request $request)
    {
       
        $gewogs = [];
        $villages=[];

        if ($request->has('load_gewogs') && $request->load_gewogs) {
            $gewogs = Gewog::where('dzongkhag_id',$dzongkhagId)->orderBy('name')->get();
        }

        
        return response()->json(['gewogs' => $gewogs,'villages' => $villages], 200);
    }

    public function getVillageByGewog($gewogId, Request $request)
    {
       
         $villages=[];

        if ($request->has('load_villages') && $request->load_villages) {
            $villages = Village::where('gewog_id',$gewogId)->orderBy('name')->get();
        }

        
        return response()->json(['villages' => $villages], 200);
    }


    public function getGewogByCDzongkhag($dzongkhagId, Request $request)
    {
       
        $gewogs = [];
        $villages=[];

        if ($request->has('cload_gewogs') && $request->cload_gewogs) {
            $gewogs = Gewog::where('dzongkhag_id',$dzongkhagId)->orderBy('name')->get();
        }

        
        return response()->json(['gewogs' => $gewogs,'villages' => $villages], 200);
    }

    public function getVillageByCGewog($gewogId, Request $request)
    {
       
         $villages=[];

        if ($request->has('cload_villages') && $request->cload_villages) {
            $villages = Village::where('gewog_id',$gewogId)->orderBy('name')->get();
        }

        
        return response()->json(['villages' => $villages], 200);
    }


}
