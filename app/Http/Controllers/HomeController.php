<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function __construct()
    {
        view()->share(['tab_selected' => '']);
    }


    /**
     * Show home page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show_banner = true;
        if (!Auth::guest()){
            $show_banner = false;
            $user = Auth::user();
            return view('home', compact('show_banner', 'user'));
        }
        return view('home', compact('show_banner'   ));
    }
}
