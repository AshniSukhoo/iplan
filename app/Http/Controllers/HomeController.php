<?php

namespace Iplan\Http\Controllers;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['index']);
        $this->middleware('guest')->only(['getWelcomePage']);
    }
    
    /**
     * Load Welcome Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getWelcomePage()
    {
        return view('welcome');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('home');
    }
}
