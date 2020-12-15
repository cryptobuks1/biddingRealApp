<?php

namespace App\Http\Controllers\AdminBid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bidding;
use App\Auction;
use App\AuctionItem;
use Session;
use Illuminate\Support\Facades\Crypt;
use CH;
use DB;
use Carbon\Carbon;
class AdminBidController extends Controller
{
    public function index(){
 
    	 return view('admin.bids.dashboard')->with('auctionsItems',AuctionItem::latest()->limit(8)->get());
    }


 

      public function bidAdmin_ajax(Request $request)
    {
        if (!empty($request->status)  || !empty($request->allauctions) || !empty($request->allauctionsItem) || !empty($request->sold) || !empty($request->winner) || !empty($request->from_date) && !empty($request->to_date)) {




           
          $acData=Bidding::with('getAuction')->with('getAuctionItem')->with('getUser')->where('is_softdel', 'no');
          if ($request->status) {
              
               $acData->where('status',$request->status);
          }

             if ($request->winner) {
              
               $acData->where('win',$request->winner);
          }


           if ($request->sold) {
              
               $acData->where('sold',$request->sold);
          }
        

          if ($request->allauctions) {
              
               $acData->where('ac_parent_id',$request->allauctions);
          }

          if ($request->allauctionsItem) {
              
               $acData->where('ac_parent_child_id',$request->allauctionsItem);
          }

       
          if($request->from_date && $request->to_date){
          $acData->whereBetween('bdatetime', [CH::addUtc($request->from_date), CH::addUtc($request->to_date)]);

         // where('end_datetime','<=',CH::addUtc($request->to_date))->where('start_datetime','>=',CH::addUtc($request->from_date));


          }
          
            return datatables()
                ->of($acData->latest()
                        ->get())->setRowClass(function ($data) {
               return 'customvalueofemailget';
                })->addColumn(
                    'status',
                    function ($data) {
                        if ($data->status == 'on') {
                            $label1 = '<span class="label label-success">Active</span>';
                        } else {
                            $label1 = '<span class="label label-danger">Deactive</span>';
                        }

                        return $label1;
                    }
                )->addColumn(
                    'sold',
                    function ($data) {
                        if ($data->sold == 'on') {
                            $label2 = '<span class="label label-success">yes</span>';
                        } else {
                            $label2 = '<span class="label label-danger">No</span>';
                        }

                        return $label2;
                    }
                )->addColumn(
                    'win',
                    function ($data) {
                        if ($data->win == 'on') {
                            $label = '<span class="label label-success">yes</span>';
                        } else {
                            $label = '<span class="label label-danger">No</span>';
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
                   
                
                    <a class="dropdown-item" href="' . route('bidAdminEdit', ['id' => Crypt::encrypt($data->id)]) . '">Edit</a>
                   
                    <button class="dropdown-item deleteAuction btn-danger btn-block"   del-id=' . $data->id . '>Delete</button>
                  </div>
                </div>';
                        return $button;
                    }
                )->rawColumns(['action','win','sold','status'])
                ->make(true);



        } else {
            return datatables()
                ->of(
                    Bidding::with('getAuction')->with('getAuctionItem')->with('getUser')->where('is_softdel', 'no')->latest()
                        // ->orderBy('id', 'asc')
                        ->get()
                )->setRowClass(function ($data) {
               return 'customvalueofemailget';
                })->addColumn(
                    'status',
                    function ($data) {
                        if ($data->status == 'on') {
                            $label1 = '<span class="label label-success">Active</span>';
                        } else {
                            $label1 = '<span class="label label-danger">Deactive</span>';
                        }

                        return $label1;
                    }
                )->addColumn(
                    'sold',
                    function ($data) {
                        if ($data->sold == 'on') {
                            $label2 = '<span class="label label-success">yes</span>';
                        } else {
                            $label2 = '<span class="label label-danger">No</span>';
                        }

                        return $label2;
                    }
                )->addColumn(
                    'win',
                    function ($data) {
                        if ($data->win == 'on') {
                            $label = '<span class="label label-success">yes</span>';
                        } else {
                            $label = '<span class="label label-danger">No</span>';
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
                   
                
                    <a class="dropdown-item" href="' . route('bidAdminEdit', ['id' => Crypt::encrypt($data->id)]) . '">Edit</a>
                   
                    <button class="dropdown-item deleteAuction btn-danger btn-block"   del-id=' . $data->id . '>Delete</button>
                  </div>
                </div>';
                        return $button;
                    }
                )->rawColumns(['action','win','sold','status'])
                ->make(true);
        }
    }







      public function dataAjaxBiddingSelect2(Request $request)
    {
    	
       $search = $request->auction;

      if($search == ''){
         $acRecord = Auction::orderby('title','asc')->select('id','title')->limit(8)->get();
      }else{
         $acRecord = Auction::orderby('title','asc')->select('id','title')->where('title', 'like', '%' .$search . '%')->limit(8)->get();
      }

      $response = array();
      foreach($acRecord as $acRecordsingle){
         $response[] = array(
              "id"=>$acRecordsingle->id,
              "text"=>$acRecordsingle->title
         );
      }
 
      echo json_encode($response);
      exit;

    }





  
      public function dataAjaxAC_itemBiddingSelect2(Request $request)
    {
    	
       $search = $request->allauctionsItem;

      if($search == ''){
         $acRecord = AuctionItem::orderby('title','asc')->select('id','title')->limit(8)->get();
      }else{
         $acRecord = AuctionItem::orderby('title','asc')->select('id','title')->where('title', 'like', '%' .$search . '%')->limit(8)->get();
      }

      $response = array();
      foreach($acRecord as $acRecordsingle){
         $response[] = array(
              "id"=>$acRecordsingle->id,
              "text"=>$acRecordsingle->title
         );
      }
 
      echo json_encode($response);
      exit;

    }



    
    
       public function bidAdminEdit($id)
    {
        $auction_id_bidding = Crypt::decrypt($id);

        $auction_id_bidding =Bidding::with('getAuction')->with('getAuctionItem')->with('getUser')->where('id',$auction_id_bidding)->where('is_softdel', 'no')->first(); 


     

        return view('admin.bids.edit')->with('bid', $auction_id_bidding);
    }




        public function bidAdminUpdate(Request $request){

       
          $request->validate(
            [
                'amount' =>'required','bdatetime' => 'required','win' => 'required','status' => 'required','sold' => 'required'
            ]
        );

       
        $updateBid = Bidding::find(Crypt::decrypt($request->bid_id));
        $updateBid->update(
            [
                   
              'amount' => $request->amount,'bdatetime' => $request->bdatetime, 'win' =>$request->win,'status' =>$request->status,'sold' =>$request->sold
                ]
        );

        if ($updateBid) {
            return redirect()->back()
                ->with('message',  ' Bid updated SuccessFully...!');
        }

       }



  
    public function bidAdminDelete(Request $request)
    {
        $Auctionbid = Bidding::find($request->sub_id);
        $Auctionbid->update(['is_softdel' => 'yes']);
        if ($Auctionbid) {
            return response()->json(['status' => 'ok', 'id' => $request->auction_id]);
        } else {
            return response()
                ->json(['status' => 'error']);
        }
    }

    


}
