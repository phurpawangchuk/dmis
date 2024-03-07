<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class CountryController extends Controller
{
    public $search;
    /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      abort_if(Gate::denies('country_panel_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

      $perPage = 10;  $page = 1;
      $countries = Country::with('user')->orderBy('countryName','asc')->paginate(15);

      $currentpage = $request->get('page');
      if($currentpage > 1){ 
          $page = $perPage * ($currentpage - 1);
      }
      Session::put('pages',$page);

      return view('dashboard.countries.index',compact('countries','perPage'));
  }

   /* Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $title = "Create New Country";
      abort_if(Gate::denies('country_create'), Response::HTTP_FORBIDDEN, 'Forbidden');
   
      return view('dashboard.countries.create', compact('title'));

  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $data['countryName'] = $request->countryName;
      $data['countryCode'] = $request->countryCode;
      $data['author'] = auth()->id();
      Country::create($data);

      return redirect()->route('dashboard.countries.index')->with(['success' => "Add successfully"]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Country $country)
  {
      abort_if(Gate::denies('country_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');
      return view('dashboard.countries.edit',compact('country'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Country $country, Request $request)
  {
      abort_if(Gate::denies('country_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');

      $country->update($request->all());
      return redirect()->route('dashboard.countries.index')->with(['success' => "Country Updated successfully"]);
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Country $country)
  {
      abort_if(Gate::denies('country_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');
    
      $country->delete();
      return redirect()->back()->with(['success' => "Country Deleted successfully"]);
  }
}
