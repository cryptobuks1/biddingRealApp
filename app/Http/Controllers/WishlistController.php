<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WhishList;
class WishlistController extends Controller
{
    public function addWhishlist(Request $request){
      $checkalready=WhishList::where('user_id',$request->user_id)->where('item_id',$request->ItemIdauc)->count();
   if ($checkalready>0) {

   	return json_encode(['status'=>'already']); 
   	
   }else {
   	
   	$check= WhishList::create(['user_id'=>$request->user_id,'item_id'=>$request->ItemIdauc]);
    return json_encode(['status'=>'ok']);

   }

 

    }


public function remWhishlist(Request $request){

$check=WhishList::where('user_id',$request->user_id)->where('item_id',$request->ItemIdauc)->delete();
if ($check) {
   return json_encode(['status'=>'ok']);
}else {
   return json_encode(['status'=>'no']);
}


}
    
}
