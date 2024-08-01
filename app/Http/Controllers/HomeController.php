<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $page     =  "dashboard";
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data   = array(
            "page" => $this->page,
            'page_title'=>'Dashboard',
        );
        return view('dashboard.dashboard', $data);
    }
}
