<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bidding;
use App\Auction;
use App\AuctionItem;
use App\User; 
use Auth;
use Illuminate\Support\Facades\Crypt;
use CH;
use DB;
use App\WhishList;
use PragmaRX\Countries\Package\Countries;
class ProfileController extends Controller
{
    public function index(){
        $countries = Countries::all();

        $winningAuctionscount=Bidding::where('status','on')->where('is_softdel','no')->where('win','on')->where('sold','on')->count();

        $auctionswhereBidcount=Bidding::where('user_id',Auth::user()->id)->distinct()->count(['ac_parent_child_id']);
       
   


$whishListcount=WhishList::where('user_id',Auth::user()->id)->count();
 

    	return view('frontEnd.myAccount.index',compact('countries','winningAuctionscount','auctionswhereBidcount','whishListcount'));
    }




    public function myaccountUpdate( Request $request){

                $request->validate( [
            'name' => ['required', 'string', 'max:255'],
          
            'vat_number' => ['required'],
            'address' => ['required'],
            'country'=>['required'],
           
        ]
            );


            $image_name = $request->pfilehidden;
        $image = $request->file('pfile');
       if (!empty( $image)) {
       	     $image = $request->file('pfile');
            $image_name = time() . uniqid(). '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img/');
            $image->move($destinationPath, $image_name);
       }

 
          $check=User::find(Auth::user()->id)->update([
            'name' =>$request->name,
            'address' => $request->address,
            'country'=>$request->country,
            'vat_number' =>$request->vat_number,
            'business_name'=>$request->busname,
            'phone'=>$request->phone,
            'fname'=>$request->fname,
            'cname'=>$request->cname,
            'image'=>$image_name

        ]);


                if($check){

                return redirect()->back()
                ->with('message', $request->name . 'updated SuccessFully...!');
                }else {
                	    return redirect()->back()
                ->with('error', $request->name . 'Not updated ...!');
                }

    }







    public function myaccountWinningBids(){

        

        $winningAuctionscount=Bidding::where('user_id',Auth::user()->id)->where('status','on')->where('is_softdel','no')->where('win','on')->where('sold','on')->count();

         $winningAuctions=Bidding::where('user_id',Auth::user()->id)->with('getAuction')->with('getAuctionItem')->with('getUser')->where('status','on')->where('is_softdel','no')->where('win','on')->where('sold','on')->get();

$whishListcount=WhishList::where('user_id',Auth::user()->id)->count();
// dd( $winningAuctions);


        $auctionswhereBidcount=Bidding::where('user_id',Auth::user()->id)->distinct()->count(['ac_parent_child_id']);
        return view('frontEnd.myAccount.winningAuction',compact('winningAuctionscount','auctionswhereBidcount','winningAuctions','whishListcount'));

    }



    public function myaccountWhereBids(){

        

        $winningAuctionscount=Bidding::where('user_id',Auth::user()->id)->where('status','on')->where('is_softdel','no')->where('win','on')->where('sold','on')->count();

        $auctionswhereBidcount=Bidding::where('user_id',Auth::user()->id)->where('user_id',Auth::user()->id)->where('status','on')->where('is_softdel','no')->distinct()->count(['ac_parent_child_id']);


         // $auctionswhereBids=Bidding::with('getAuction2')->with('getAuctionItem2')->where('user_id',Auth::user()->id)->where('status','on')->where('is_softdel','no')->distinct()->get(['ac_parent_child_id']);


            $auctionswhereBids=Bidding::where('user_id',Auth::user()->id)->where('status','on')->where('is_softdel','no')->with('getAuction','getAuctionItem')->distinct()->get(['ac_parent_child_id','user_id','ac_parent_id']);
 
         
 $whishListcount=WhishList::where('user_id',Auth::user()->id)->count();

   

        return view('frontEnd.myAccount.auctionwherebids',compact('winningAuctionscount','auctionswhereBidcount','auctionswhereBids','whishListcount'));

    }



 public function whishlist(){

         

       $winningAuctionscount=Bidding::where('user_id',Auth::user()->id)->where('status','on')->where('is_softdel','no')->where('win','on')->where('sold','on')->count();

       $auctionswhereBidcount=Bidding::where('user_id',Auth::user()->id)->where('status','on')->where('is_softdel','no')->distinct()->count(['ac_parent_child_id']);

        $whishList=WhishList::with('getAuctionitem')->where('user_id',Auth::user()->id)->get();
 

 
        $whishListcount=WhishList::where('user_id',Auth::user()->id)->count();
         
       

   

        return view('frontEnd.myAccount.whishlist',compact('whishListcount','whishList','winningAuctionscount','auctionswhereBidcount'));

    }



    
}
