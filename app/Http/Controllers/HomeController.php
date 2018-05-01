<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show home page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show_banner = true;
        return view('home', compact('show_banner'));
    }
}
