<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Session;
class SetClientTimezoneSessionController extends Controller
{
    public function index(Request $request){

        Session::put('ClientTimezone', $request->timezone);
       return  Response::json(Session::get('ClientTimezone'), 200);;
    }
}
  