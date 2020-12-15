<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HowToBidController extends Controller
{
     public function index()
    {
    	 return view('how-bid')->with('general',\App\General::find(1));
    }
}
 