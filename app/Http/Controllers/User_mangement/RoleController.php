<?php

namespace App\Http\Controllers\user_mangement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
class RoleController extends Controller
{
    

public function insert(Request $request){
	
 $request->validate([
            'role_name' => 'required',
            'status'    => 'required'
        ]);
$user_id = \Auth::user()->id;
$role= new Role(['role'=>$request->role_name,'status'=>$request->status,"user_id"=> $user_id]);
$role->save();

 return redirect()->to('admin/user_mangement#role')->with('message','New Role Added Successfully');

}


public function update(Request $request , $id){

  

 
        $role=Role::find($id);
        $role->role=$request->role_name;
        $role->status=$request->status;
        $role->save();
         return redirect()->to('admin/user_mangement#role')->with('message',$role->role.' Role Updated Successfully');

}


 public function destroy($id)
    {

    	$role=Role::find($id);
    Role::destroy($id);
  
    return redirect()->to('admin/user_mangement#role')->with('message',$role->role.'Role Deleted Successfully');
    }

}
