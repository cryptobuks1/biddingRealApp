<?php

namespace App\Http\Controllers\Bid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bidding;
use Session;
use App\Conditions;
use App\Auction;
use App\AuctionItem;
use Illuminate\Support\Facades\Crypt;
use CH;
use Carbon\Carbon;
use DB;
use Auth;
use DateTime;
use App\CustomField; 
use App\PostMeta;
use Mail;

class FrontBidController extends Controller
{
    
 
  public function Validate_Bidding_Conditions(Request $request){



  
 $currentBid=200;


  $conditionCount=Conditions::where('ac_parent_id',Crypt::decrypt($request->auction_parient_id))->where('ac_parent_child_id',Crypt::decrypt($request->auction_item_id))->where('status','on')->where('is_softdel','no');

 // bidding Current Query

$bidCurrent=Bidding::where('ac_parent_id',Crypt::decrypt($request->auction_parient_id))->where('ac_parent_child_id',Crypt::decrypt($request->auction_item_id))->where('status','on')->where('is_softdel','no')->orderBy('amount', 'desc');


 // auctionItem Current Query
$auctionItem=AuctionItem::where('id',Crypt::decrypt($request->auction_item_id))->where('status','on')->where('is_softdel','no')->first();



 


  if ($conditionCount->count()>0) {


  	 return  json_encode(['increement'=>$conditionCount->first()->inc_amount,'currentBidPrice'=>(!empty($bidCurrent->first()->amount))? $bidCurrent->first()->amount : $auctionItem->start_price]);
  }else {

  	  $age=CH::get_Post_Meta_value(Crypt::decrypt($request->auction_item_id),'number','age','horse',$status='on'); 

     $isRidden=CH::get_Post_Meta_value(Crypt::decrypt($request->auction_item_id),'isridden','is_ridden','horse',$status='on');


 

if ($bidCurrent->count()<1) {
  
$currentBid=$auctionItem->start_price;
}else {
  $currentBid=(!empty($bidCurrent->first()->amount))? $bidCurrent->first()->amount : $auctionItem->start_price;
}


  if($age <= 1){


  return  json_encode(['increement'=>50,'currentBidPrice'=>$currentBid]);
 
  	
  }elseif ($age <= 2 && $age > 1) {

  return  json_encode(['increement'=>100,'currentBidPrice'=>$currentBid]);

  }elseif ($age > 2 && $isRidden =='yes') {

 
     return  json_encode(['increement'=>300,'currentBidPrice'=>$currentBid]);
  }else {

    return  json_encode(['increement'=>200,'currentBidPrice'=>$currentBid]);

}


}
 
}





public function  GO_Bidding(Request $request){

date_default_timezone_set(session('ClientTimezone'));
$currentdate = CH::addUtc(date('Y-m-d H:i:s'));
$auctionItem=AuctionItem::where('id',Crypt::decrypt($request->auction_item_id))->where('status','on')->where('is_softdel','no')->first();

$currentBid=Bidding::where('ac_parent_id',Crypt::decrypt($request->auction_parient_id))->where('ac_parent_child_id',Crypt::decrypt($request->auction_item_id))->where('status','on')->where('is_softdel','no')->orderBy('amount', 'desc')->first();

if (!empty($currentBid)) {
  $currentBidId=$currentBid->id;
}else {
  
    $currentBidId=0;
}

$auctionItemStart_datetime=$auctionItem->start_datetime;

$auctionItemEnd_datetime=$auctionItem->end_datetime;




 
if ($auctionItemStart_datetime < $currentdate && $auctionItemEnd_datetime > $currentdate ) {


 $createBid=Bidding::create([
'ac_parent_id'=>Crypt::decrypt($request->auction_parient_id),
'ac_parent_child_id'=>Crypt::decrypt($request->auction_item_id), 
'user_id'=>Auth::user()->id,
'amount'=>$request->bidPrice, 
'bdatetime'=>CH::addUtc($request->create_datetimefooter),
]);



if ($createBid) {

  $returnDataSenmail=['insertedBid'=>$createBid->id,'previouseBid'=>$currentBidId,'ac_parent_id'=>Crypt::decrypt($request->auction_parient_id),'ac_parent_child_id'=>Crypt::decrypt($request->auction_item_id),'link_url'=>$request->currentUrl];

  return json_encode(['status'=>'ok','data'=>$returnDataSenmail]);
  
}else {
   return json_encode(['status'=>'error','data'=>'no']);
  
}
    
  }else {
     return json_encode(['status'=>'error','data'=>session('ClientTimezone')]);
  }


 

}



public function GO_BiddingSendMails(Request $request){





$auctionItem=AuctionItem::where('id',$request->data['ac_parent_child_id'])->where('status','on')->where('is_softdel','no')->first();

$currentBid=Bidding::with('getUser')->where('id',$request->data['insertedBid'])->where('status','on')->where('is_softdel','no')->orderBy('amount', 'desc')->first();

$previouseBid=Bidding::with('getUser')->where('id',$request->data['previouseBid'])->where('status','on')->where('is_softdel','no')->orderBy('amount', 'desc')->first();


      if (!empty($previouseBid->getUser->email)) {

          $to_name1 =$previouseBid->getUser->name;
          $to_email1 =$previouseBid->getUser->email;


          $data1 = array("name" =>$auctionItem->title,'lot'=>$auctionItem->id,'pic'=>asset('/img').'/'.explode(',', $auctionItem->gallery)[0] ,'bidder'=>$previouseBid->getUser->name,'bidamount'=>$previouseBid->amount,'linkurl'=>$request->data['link_url'],'subject'=>'You Are No More Highest Bidder','app_url'=>config('custom_env_Variables.APP_URL'),'logo'=>asset('/img').'/'.config('custom_env_Variables.SITE_LOGO'));
          
          Mail::send('emails.highestNomore', $data1, function($message) use ($to_name1, $to_email1,$request) {
          $message->to($to_email1, $to_name1) 
            ->subject('You Are No More Highest Bidder');
          $message->from( config('custom_env_Variables.MAIL_FROM_ADDRESS'),config('custom_env_Variables.MAIL_FROM_NAME'));
           });

         

          }

          $to_name =Auth::user()->name;
          $to_email =Auth::user()->email;


          $data = array("name" =>$auctionItem->title,'lot'=>$auctionItem->id,'pic'=>asset('/img').'/'.explode(',', $auctionItem->gallery)[0] ,'bidder'=>$currentBid->getUser->name,'bidamount'=>$currentBid->amount,'linkurl'=>$request->data['link_url'],'subject'=>'Highest Bidder','app_url'=>config('custom_env_Variables.APP_URL'),'logo'=>asset('/img').'/'.config('custom_env_Variables.SITE_LOGO'));
          
          Mail::send('emails.highestBid', $data, function($message) use ($to_name, $to_email,$request) {
          $message->to($to_email, $to_name) 
            ->subject('Highest Bidder');
          $message->from( config('custom_env_Variables.MAIL_FROM_ADDRESS'),config('custom_env_Variables.MAIL_FROM_NAME'));
           });



          return json_encode('ok');

}


}