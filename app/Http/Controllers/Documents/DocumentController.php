<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Profile;
use App\Models\ProfileDocument;
use Auth;
use Storage;



class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $getdocuments=Document::all();

        $getdocuments=Document::with(['profiledocument'])->get();


       // return view ('masters.documents.documents')->with("getdocuments",$getdocuments);
       return view ('masters.documents.documents');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('masters.documents.adddocuments');
       // exit();
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
            'dname' => 'required',
            'dtype' => 'required',

        ]);
        //echo $request->input('dname');

        try {
                       $document=new Document;
                       $document->name=$request->input('dname');
                       $document->type=$request->input('dtype');
                       $document->is_required=$request->input('optradio');
                       $document->updated_by=Auth::user()->id;
                       $document->save();



                       return redirect('Documents/index')->with('msg_success', 'Succesfully update');


              } catch(\Illuminate\Database\QueryException $ex){
                return redirect('Documents/index')->with('msg_error', 'Sorry Something is Worrog11');
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
         //echo $id;
         $getdocument=Document::where('id',$id)->first();
         return view('masters.documents.editdocuments')->with('getdocument',$getdocument);

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
        //echo $id;
           try{
            // echo $request->input('dat');
               $document = Document::find($id);
               $document->name=$request->input('dname');
               $document->type=$request->input('dtype');
               $document->is_required=$request->input('optradio');
               $document->save();
               return redirect('Documents/index')->with('msg_success', 'Succesfully update');



              } catch(\Illuminate\Database\QueryException $ex){
                return redirect('Documents/index')->with('msg_error', 'Succesfully update');

             }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function myDocuments()
    {
        $user_id=Auth::user()->id;
        $profile_id=Profile::where('user_id',$user_id)->first();
        $id=$profile_id->id;

        $cid=Profile::findorFail($id);

        $documentcheck=Document::wheredoesnthave('profiledocument',function($q) use ($id){
            $q->where('profile_id',$id);
        })->count();

        $documents=Document::with(['profiledocument'=>function($q) use ($id){
            $q->where('profile_id',$id);
        }])
        ->get();

        return view ('studentsdashboard.mydocuments',compact('documentcheck','documents','cid'));
    }

    public function addProfileDocument ()
    {
        $user_id=Auth::user()->id;
        $profile_id=Profile::where('user_id',$user_id)->first();
        $id=$profile_id->id;

        $documents=Document::wheredoesnthave('profiledocument',function($q) use ($id){
            $q->where('profile_id',$id);
        })->get();


        return view ('studentsdashboard.addprofiledocument',compact('documents','profile_id'));
    }

    public function documentAdd(Request $request)
    {
        if ($request->has('document_path') && $request->document_path != null) {

            $filename=$request->document_path->getClientOriginalName();
            $profile=Profile::findOrFail($request->profile_id);

            $documentname=$profile->cid."_".$request->document_id.'_'.$filename;

            $documentfile=$request->document_path;


            $fileCheck = Storage::exists('document/' . $documentname);

            if ($fileCheck) {
                Storage::delete('document/' . $documentname);

            }
            Storage::putFileAs('document', $documentfile, $documentname);

        }

        $profiledocument= new ProfileDocument;
        $profiledocument->document_id=$request->document_id;
        $profiledocument->profile_id=$request->profile_id;
        $profiledocument->src=$filename;
        $profiledocument->created_at=now();
        $profiledocument->updated_at=now();

        $profiledocument->save();

        return redirect("/Documents/myDocuments")->with('msg_success', 'Your documents have been added successfully');

    }

    public function editMyDocument ($id)
    {
        $document=ProfileDocument::with('document')->findOrfail($id);


        return view ('studentsdashboard.editmydocument',compact('document'));
    }

    public function documentUpdate (Request $request,$id)
    {
        $documentuploaded=ProfileDocument::with('document','profile')->findOrFail($id);

        if ($request->has('document_path') && $request->document_path != null) {

            $filename=$request->document_path->getClientOriginalName();

            $documentname=$documentuploaded->profile->cid.'_'.$documentuploaded->document->id.'_'.$filename;

            $documentfile=$request->document_path;

            $olddocument=$documentuploaded->profile->cid.'_'.$documentuploaded->document->id.'_'.$documentuploaded->src;

            $oldcheck = Storage::exists('document/' . $olddocument);

             if ($oldcheck) {
                Storage::delete('document/' . $olddocument);

             }


            $fileCheck = Storage::exists('document/' . $documentname);

             if ($fileCheck) {
                Storage::delete('document/' . $documentname);

             }
            Storage::putFileAs('document', $documentfile, $documentname);

        }
        else
        {
           $filename=$documentuploaded->src;
        }

        $documentuploaded->src=$filename;
        $documentuploaded->save();

        return redirect("/Documents/myDocuments")->with('msg_success', 'Your documents have been updated successfully');


    }

    public function removeProfileDocument ($id)
    {
        $documentuploaded=ProfileDocument::with('document','profile')->findOrFail($id);

        $documentname=$documentuploaded->profile->cid.'_'.$documentuploaded->document->id.'_'.$documentuploaded->src;

        $fileCheck = Storage::exists('document/' . $documentname);

        if ($fileCheck) {
           Storage::delete('document/' . $documentname);

        }

        $documentuploaded->delete();

        return redirect("/Documents/myDocuments")->with('msg_error', 'Your documents is removed, Please make sure its not a required document in the checklist');

    }
    public function destroy($id)
    {
        //


        try{
            $document = Document::find($id);
            $document->delete();
            return redirect('Documents/index')->with('msg_success', 'Succesfully Deleted');

        }
        catch(\Illuminate\Database\QueryException $ex){
            return redirect('Documents/index')->with('msg_error', 'Cant delete');

       }
    }
}
