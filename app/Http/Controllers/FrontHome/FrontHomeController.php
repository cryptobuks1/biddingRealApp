<?php

namespace App\Http\Controllers\FrontHome;

use App\Http\Controllers\Controller;
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
use Illuminate\Support\Str;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Support\Facades\Crypt;



class FrontHomeController extends Controller
{
    public function index(){

    
      




          $auctions= Auction::where('is_softdel','no')->orderBy('start_datetime', 'desc')->paginate(5);
          return view('frontEnd/home/front-home')->with('auctions',$auctions);

    }


  public function frontAuctionFilter(Request $request){



   
 
          $acData=Auction::where('is_softdel','no');
          if ($request->status) {
              
               $acData->where('status',$request->status)->where('is_softdel','no');
          }

          if($request->from_date && $request->to_date){
          $acData->where('end_datetime','<=',CH::addUtc($request->to_date))->where('start_datetime','>=',CH::addUtc($request->from_date));

          }

          



  return view('frontEnd/home/front-home')->with('auctions', $acData->orderBy('start_datetime', 'desc')->paginate(5));
   

  

}


    public function single_auction($id,$post_type){
         $countries = Countries::all();


        $auction_id = Crypt::decrypt($id);
       $ptype = Crypt::decrypt($post_type);
         $auction= Auction::findOrFail($auction_id);
       $auctionItems = AuctionItem::where('ac_parent_id',$auction_id)->where('post_type',$ptype)->where('is_softdel','no')->paginate(6);
        return view('frontEnd/home/single-auction')->with('auctionItems', $auctionItems)->with('auction', $auction)->with('countries',$countries);

    }
   

      public function single_auction_item($id,$auctionId,$post_type){
        
        $auction_id = Crypt::decrypt($auctionId);
        $auction_item_id=Crypt::decrypt($id);
       $ptype = Crypt::decrypt($post_type);
         $auction= Auction::findOrFail($auction_id);
       $auctionItem = AuctionItem::where('ac_parent_id',$auction_id)->where('post_type',$ptype)->where('id',$auction_item_id)->where('is_softdel','no')->first();

        return view('frontEnd/auction-items/auction-item-single')->with('auctionItem', $auctionItem)->with('auction', $auction);

    }


     public function news_frontend(){

      
        $news= News::where('is_softdel','no')->where('status','on')->orderBy('id', 'desc')->paginate(2);
          return view('frontEnd.news.news')->with('news',$news);

    }



    public function single_news_frontend($id){
   
           $news= News::findOrFail(Crypt::decrypt($id));
          return view('frontEnd.news.news-single')->with('news',$news);

    }



    public function postContactFront(Request $request){

        
 
          
     
        
        
           $request->validate(
            [
                'email' =>'required','create_datetime' => 'required','is_agree' => 'required','name' => 'required' ,'subject' => 'required',
            ]
        );

           
            $insert = Contacts::create(
                [
                    'email' => $request->email,'description' => $request->description, 'create_datetime' => CH::addUtc($request->create_datetime),'status' =>'off','phone' =>$request->phone,'is_agree' =>$request->is_agree,'name' =>$request->name,'subject' =>$request->subject
                ]
            );

            if ($insert) {
   
          $to_name =config('custom_env_Variables.MAIL_FROM_NAME');
          $to_email =config('custom_env_Variables.MAIL_TO_CONTACT');
          $data = array('name'=>$request->name, "email" =>$request->email,"body" =>$request->description, "phone" =>$request->phone,'subject'=>$request->subject,'app_url'=>config('custom_env_Variables.APP_URL'),'logo'=>asset('img').'/'.config('custom_env_Variables.SITE_LOGO'));
          
          Mail::send('emails.contact', $data, function($message) use ($to_name, $to_email,$request) {
          $message->to($to_email, $to_name) 
            ->subject($request->subject);
          $message->from( config('custom_env_Variables.MAIL_FROM_ADDRESS'),config('custom_env_Variables.MAIL_FROM_NAME'));
           });



                return redirect()->back()
                    ->with('message', 'Email Send SuccessFully...!');
            }

    }




      public function postSubscribeFront(Request $request){

        
     
        $request->validate(
            [
                'email' =>'required|email|unique:subscriber','create_datetime' => 'required'
            ]
        );

       
            $insert = Subscriber::create(
                [
                    'email' => $request->email,'create_datetime' => CH::addUtc($request->create_datetime),'status'=>'off'
                ]
            );

            if ($insert) {
                return redirect()->back()
                    ->with('message', $insert->email . 'Subscription Done SuccessFully...!');
            }
          
     

    }


   



     public function postfilterFrontsSidebar(Request $request){


              $currentvalbid='';
            
            

           if (!empty($request->from_date) || !empty($request->status)) {
 
          $acData=AuctionItem::where('is_softdel','no');
          if ($request->status) {
              
               $acData->where('status',$request->status)->where('is_softdel','no');
          }

          if($request->from_date && $request->to_date){
          $acData->where('end_datetime','<=',CH::addUtc($request->to_date))->where('start_datetime','>=',CH::addUtc($request->from_date));

          }

           if($request->start_price && $request->end_price){

            $acData->whereBetween('start_price', [$request->start_price, $request->end_price]);

          }

     
   

     $teMp='';
  foreach ($acData->orderBy('id', 'DESC')->inRandomOrder()->limit(8)->get() as $value) {

                                      $currentBid=CH::ItemBiddinCurrent($value->id);
                                        if(!empty($currentBid)){

                                       $currentvalbid=$currentBid->amount;

                                   

                                        }else {
                                           $currentvalbid=$value->start_price;
                                        }

                                 

                              
 
  $teMp.='<ul id="last-bids-list" class="bids-list side-listing pb-1">
      <li class="horse-wrap">
        <a data-v-85470632="" href="'.route("single-auction-item",["id"=>Crypt::encrypt($value->id),"post_type"=>Crypt::encrypt($value->post_type),"auctionId"=>Crypt::encrypt($value->ac_parent_id)]).'">
          <div data-v-85470632="" class="top-row">
            <div data-v-85470632="" class="lot-number style="background-color: #962B25 !important;" >LOT '.$value->id.'</div>
            <div data-v-85470632="" class="name-company">
             
              <small data-v-85470632="">'.Str::limit($value->title,18).'</small>
            </div>
            <div data-v-85470632="" class="flag"></div>
          </div> 
          <div data-v-85470632="" class="main-row">
            <div data-v-85470632="" class="horse-img"><img class="img-fluid img-thumbnail bg-white" data-v-85470632="" src="'.asset('/img').'/'.explode(',', $value->gallery)[0].'" alt=""></div>
            <div data-v-85470632="" class="details">
              <h5 data-v-85470632="" class="grey-bg">Sire</h5>
              <small data-v-85470632="" title="Secret">
              '.CH::get_Post_Meta_value($value->id,$field_type='text',$meta_key='sire',$value->post_type,$status='on').'
              </small>
            </div>
            <div data-v-85470632="" class="details">
              <h5 data-v-85470632="" class="grey-bg">Dam By</h5>
              <small data-v-85470632="" title="Hohenstein/T.">'.CH::get_Post_Meta_value($value->id,$field_type='text',$meta_key='dam_by',$value->post_type,$status='on').'</small>
            </div>
            <div data-v-85470632="" class="bid-price">
              <h3 data-v-85470632="">
              <span class="fa fa-gavel"></span>
              
              $'.$currentvalbid.'
              <!----> <!---->
              </h3>
            </div>
          </div>
        </a>
      </li>';

       }


       return $teMp;


  }else {


  $auctionItem=AuctionItem::where('status','on')->where('is_softdel','no')->orderBy('id', 'DESC')->inRandomOrder()->limit(8)->get();
  
  $teMp='';
  foreach ($auctionItem as $value) {


      $currentBid=CH::ItemBiddinCurrent($value->id);
                                        if(!empty($currentBid)){

                                       $currentvalbid=$currentBid->amount;

                                   

                                        }else {
                                           $currentvalbid=$value->start_price;
                                        }
    
 
  $teMp.='<ul id="last-bids-list" class="bids-list side-listing pb-1">
      <li class="horse-wrap">
        <a data-v-85470632="" href="'.route("single-auction-item",["id"=>Crypt::encrypt($value->id),"post_type"=>Crypt::encrypt($value->post_type),"auctionId"=>Crypt::encrypt($value->ac_parent_id)]).'">
          <div data-v-85470632="" class="top-row">
            <div data-v-85470632="" class="lot-number style="background-color: #962B25 !important;" >LOT '.$value->id.'</div>
            <div data-v-85470632="" class="name-company">
             
              <small data-v-85470632="">'.Str::limit($value->title,25).'</small>
            </div>
            <div data-v-85470632="" class="flag"></div>
          </div>
          <div data-v-85470632="" class="main-row">
            <div data-v-85470632="" class="horse-img"><img class="img-fluid img-thumbnail bg-white" data-v-85470632="" src="'.asset('/img').'/'.explode(',', $value->gallery)[0].'" alt=""></div>
            <div data-v-85470632="" class="details">
              <h5 data-v-85470632="" class="grey-bg">Sire</h5>
              <small data-v-85470632="" title="Secret">'.CH::get_Post_Meta_value($value->id,$field_type='text',$meta_key='sire',$value->post_type,$status='on').'</small>
            </div>
            <div data-v-85470632="" class="details">
              <h5 data-v-85470632="" class="grey-bg">Dam By</h5>
              <small data-v-85470632="" title="Hohenstein/T.">'.CH::get_Post_Meta_value($value->id,$field_type='text',$meta_key='dam_by',$value->post_type,$status='on').'</small>
            </div>
            <div data-v-85470632="" class="bid-price">
              <h3 data-v-85470632="">
              <span class="fa fa-gavel"></span>
              
              $'.$currentvalbid.'
              <!----> <!---->
              </h3>
            </div>
          </div>
        </a>
      </li>';

       }


       return $teMp;
    }
   


   }





   public function postfilterFrontsSingleac(Request $request){

        $countries = Countries::all();


       if (!empty($request->auctionsRun)) {

    
       $acData=AuctionItem::with('getAuctionPostMeta','getAuctionBidding')->where('status',$request->auctionsRun);

      if ($request->auctionsRun) {
              
          $acData->where('status',$request->auctionsRun);
          
          }


       if ($request->gender) {
          $gender=$request->gender;
          $acData->whereHas('getAuctionPostMeta',function($q1) use($gender){
         $q1->where('meta_value',$gender);
          });
          
          }

           if ($request->age) {
              $age=$request->age;
          $acData->whereHas('getAuctionPostMeta',function($q2) use($age){
         $q2->where('meta_value',$age);
          });
          
          }



           if ($request->breed) {
              $breed=$request->breed;
          $acData->whereHas('getAuctionPostMeta',function($q4) use($breed){
         $q4->Where('meta_value', $breed);
          });
          
          }

          if ($request->biddingprice) {
     


             $biddingprice=$request->biddingprice; 


              if ($request->biddingprice=='ltoh') {
                 $acData->whereHas('getAuctionBidding',function($q3) use($biddingprice){
         $q3->orderBy('amount', 'asc');
          });

              }else{

          $acData->whereHas('getAuctionBidding',function($q3) use($biddingprice){
         $q3->orderBy('amount', 'desc');
          });
              }
       
          
          }

 

         }



       // if (!empty($request->date_timepicker_start_filter)|| !empty($request->date_timepicker_end_filter) || !empty($request->start_price) || !empty($request->end_price) || !empty($request->auctionsRun)) {
 
       //    $acData=AuctionItem::where('status',$request->auctionsRun);

         
       //    if ($request->auctionsRun) {
              
       //         $acData->where('status',$request->auctionsRun);
       //    }

       //    if($request->from_date && $request->to_date){
       //    $acData->where('end_datetime','<=',CH::addUtc($request->to_date))->where('start_datetime','>=',CH::addUtc($request->from_date));

       //    }

       //     if($request->start_price && $request->end_price){

       //      $acData->whereBetween('start_price', [$request->start_price, $request->end_price]);

       //    }
       //   }
    

        $auction_id =$request->auction_id;
        $ptype =$request->post_type; 
        $auction= Auction::findOrFail($auction_id);

         

         if ($request->biddingprice) {

          if ($request->biddingprice=='ltoh') {

          
             $auctionItems =$acData->where('ac_parent_id',$auction_id)->where('post_type',$ptype)->orderBy('id', 'asc')->get();
          }else {
             $auctionItems =$acData->where('ac_parent_id',$auction_id)->where('post_type',$ptype)->orderBy('id', 'desc')->get();
          }
        

         }else {

        
            $auctionItems =$acData->where('ac_parent_id',$auction_id)->where('post_type',$ptype)->get();
           
         }
 

       
       //dd(   $auctionItems );
        return view('frontEnd/home/single-auction')->with('auctionItems', $auctionItems)->with('auction', $auction)->with('countries',$countries);

    
}


}
 