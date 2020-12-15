<?php

namespace App\Http\Controllers\user_mangement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\rolesauthority;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use CH;
class dashboardController extends Controller
{
    


public function index(){


   
    
  
     
        $allroles=Role::all();
        $allusers=User::with('Role')->get();
   
    
	return view('admin.user_mangement.dashboard',compact('allroles','allusers')); 
}



public function getall_user_ajax(){


// {{ (isset($user->Role)) ? $user->Role->role : '' }}
   return datatables()
                ->of(
                    User::orderBy('id', 'DESC')->get()
                )->addColumn(
                    'status',
                    function ($data) {

                     $role=Role::findOrFail($data->role_id);

                        if (!empty($role)) {
                            $label = '<span class="label label-success">'.$role->role.'</span>';
                        } else {
                            $label = '<span class="label label-danger">Not Assign </span>';
                        }

                        return $label;
                    }
                )->addColumn(
                    'action',
                    function ($data) {
                        $button = ' <div class="btn-group">
                  <button type="button" class="btn btn-danger btn-sm shadow-lg border-0 dropdown-toggle btn-block shadow-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Operations
                  </button>';

                        $button .= '<div class="dropdown-menu">
                   
                
                    <a class="dropdown-item" href="' . route('edit_user_data', ['id' => Crypt::encrypt($data->id)]) . '">Edit</a>
                   
                    <button class="dropdown-item deleteAuction btn-danger btn-block"   del-id=' . $data->id . '>Delete</button>
                  </div>
                </div>';
                        return $button;
                    }
                )->rawColumns(['action', 'status'])
                ->make(true);
        }







public function get_authority()
{

    $data = CH::getVendorAuthorities();
    return json_encode($data);
}   
 
}
