<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
      
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
       /* $menu = new \App\Models\Menu;
        $menuList = $menu->tree();
        return view('welcome')->with('menulist', $menuList);
        */
        return view('welcome');
    }
}
