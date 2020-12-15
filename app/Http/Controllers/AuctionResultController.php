<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auction;
use App\AuctionItem; 
use App\News; 
use App\Contacts;
use Carbon\Carbon;
use App\Bidding;
use App\Subscriber; 
use CH;
use Mail;
use Illuminate\Support\Facades\Crypt;
class AuctionResultController extends Controller
{
    public function  auctionResult_admin_ajax(Request $request){

    
       


          $acution_id = $request->input('acution_id');
     
      if ($acution_id=='all') {
        
        $auctionsdata= AuctionItem::all();
      }else {
       $auctionsdata= AuctionItem::where('ac_parent_id', $acution_id)->get();
      }
      

         foreach ($auctionsdata as $auctionsitem) {
         

      

          $validatewinner=CH::validateDisplayAcutionDataGlobal($auctionsitem->ac_parent_id,$auctionsitem->id,$auctionsitem->start_price,$auctionsitem->start_datetime,$auctionsitem->end_datetime);


      




              if ( $validatewinner=='endbid') {

                $isfull2= Bidding::with('getUser')->where('ac_parent_child_id',$auctionsitem->id)->where('status','on')->where('win','on')->where('sold','on')->where('is_softdel','no')->count();
              

              
               if($isfull2>0){

           

                  }else {
            

              $isfull1= Bidding::with('getUser')->where('ac_parent_child_id',$auctionsitem->id)->where('status','on')->where('win','off')->where('sold','off')->where('is_softdel','no')->orderBy('amount', 'desc')->first();



                 $isfull1->update(['win'=>'on','sold'=>'on']);


                  if (!empty($isfull1->getUser->email)) {

               $to_name1 =$isfull1->getUser->name;
               $to_email1 =$isfull1->getUser->email;


          $data1 = array("name" =>$auctionsitem->title,'lot'=>$auctionsitem->id,'pic'=>asset('/img').'/'.explode(',', $auctionsitem->gallery)[0] ,'bidamount'=>$isfull1->amount,'subject'=>'Congratulation You Are Winner','app_url'=>config('custom_env_Variables.APP_URL'),'logo'=>config('custom_env_Variables.APP_URL').'/public/img/'.config('custom_env_Variables.SITE_LOGO'));
          
          Mail::send('emails.win', $data1, function($message) use ($to_name1, $to_email1) {
          $message->to($to_email1, $to_name1) 
            ->subject('Congratulation You Are Winner');
          $message->from( config('custom_env_Variables.MAIL_FROM_ADDRESS'),config('custom_env_Variables.MAIL_FROM_NAME'));
           });
          }

               }


                 AuctionItem::findOrFail($auctionsitem->id)->update(['status'=>'off']);
              
              }elseif ($validatewinner=='endauctionmain') {
                

                 Auction::findOrFail($auctionsitem->ac_parent_id)->update(['status'=>'off']);
               
                
              }else {

                  $isfull= Bidding::where('ac_parent_child_id',$auctionsitem->id)->where('status','on')->where('win','on')->where('sold','on')->where('is_softdel','no');

                 if (!empty($isfull)) {
                    $isfull->update(['win'=>'off','sold'=>'off']);
                   }

                
                 
               AuctionItem::findOrFail($auctionsitem->id)->update(['status'=>'on']);

              }
             

              

         
       }




       return back()->with('message','operation Done SuccessFully Thanks Check All Auction Status declare winners send mails Etc');
          

    }
}
