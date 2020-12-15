<?php
namespace App\Http\Controllers\Auction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Auction;
use DB;
use Auth;
use DataTables; 
use App\AuctionItem; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
// use Camroncade\Timezone\Facades\Timezone;
use CH;

class AuctionController extends Controller
{
    public function index()
    {
        //unlink(public_path('/img/').'1603980152.jpg');
        return view('admin.auction.dashboard');
    }

    public function getall_Auctions_ajax(Request $request)
    {
        if (!empty($request->status) ||!empty($request->typep) ||!empty($request->from_date) &&!empty($request->to_date)&&!empty($request->to_date)) {
            // $fromDate = new Carbon($request->from_date);
            // $toDate = new Carbon($request->to_date);

          $acData=Auction::where('status',$request->status)->where('is_softdel','no');
          if ($request->status) {
              
               $acData->where('status',$request->status);
          }

          if ($request->typep) {
              
               $acData->where('post_type',$request->typep);
          }
          if($request->from_date && $request->to_date){
          $acData->where('end_datetime','<=',CH::addUtc($request->to_date))->where('start_datetime','>=',CH::addUtc($request->from_date));

          }
          
            return datatables()
                ->of($acData->latest()
                        ->get())->addColumn(
                    'status',
                    function ($data) {
                        if ($data->status == 'on') {
                            $label = '<span class="label label-success">Active</span>';
                        } else {
                            $label = '<span class="label label-danger">Deactive</span>';
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
                    <a class="dropdown-item" href="' .route('ItemFromAuction', ['id' => Crypt::encrypt($data->id)]) . '">View All Items</a>
                    <a class="dropdown-item" href="' .route('addItemFromAuction', ['id' => Crypt::encrypt($data->id)]) . '">Add Item</a>
                    <a class="dropdown-item" href="' . route('edit_auction', ['id' => Crypt::encrypt($data->id)]) . '">Edit</a>
                   
                    <button class="dropdown-item deleteAuction btn-danger btn-block"   del-id=' . $data->id . '>Delete</button>
                  </div>
                </div>';
                        return $button;
                    }
                )->rawColumns(['action', 'status'])
                ->make(true);



        } else {
            return datatables()
                ->of(
                    Auction::where('is_softdel', 'no')
                        ->latest()
                        ->get()
                )->addColumn(
                    'status',
                    function ($data) {
                        if ($data->status == 'on') {
                            $label = '<span class="label label-success">Active</span>';
                        } else {
                            $label = '<span class="label label-danger">Deactive</span>';
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
                    <a class="dropdown-item" href="' .route('ItemFromAuction', ['id' => Crypt::encrypt($data->id)]) . '">View All Items</a>
                    <a class="dropdown-item" href="' .route('addItemFromAuction', ['id' => Crypt::encrypt($data->id)]) . '">Add Item</a>
                    <a class="dropdown-item" href="' . route('edit_auction', ['id' => Crypt::encrypt($data->id)]) . '">Edit</a>
                   
                    <button class="dropdown-item deleteAuction btn-danger btn-block"   del-id=' . $data->id . '>Delete</button>
                  </div>
                </div>';
                        return $button;
                    }
                )->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    public function addnew()
    {
        return view('admin.auction.add');
    }

    public function insert_Auction(Request $request)

 
 
    {

          // dd(CH::addUtc($request->end_datetime));

        $request->validate(
            [
                'title' => 'required|max:255', 'slug' => 'required|unique:auctions', 'post_type' => 'required',
                'description' => 'required', 'start_datetime' => 'required', 'end_datetime' => 'required', 'featured_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status' => 'required',
            ]
        );

        if ($request->hasFile('featured_img')) {
            $image = $request->file('featured_img');
            $name = time() . uniqid().'.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img/');
            $image->move($destinationPath, $name);

            $orgimage = $request->file('org');
            $org = time() . uniqid().'.' . $orgimage->getClientOriginalExtension();
            $destinationPath = public_path('/img/');
            $orgimage->move($destinationPath, $org);

            $insertAuction = Auction::create(
                [
                    'title' => $request->title, 'slug' => $request->slug, 'post_type' => $request->post_type,
                    'description' => $request->description, 'start_datetime' => CH::addUtc($request->start_datetime), 'end_datetime' => CH::addUtc($request->end_datetime),
                    'status' => $request->status, 'featured_img' => $name,'org_name' =>$request->org_name,'org' =>$org, 'author' =>$request->author,
                ]
            );

            if ($insertAuction) {
                return redirect()->back()
                    ->with('message', $insertAuction->title . 'Add SuccessFully...!');
            }
        }
    }

    public function edit_auction($id)
    {
        $auction_id = Crypt::decrypt($id);

        $auction = Auction::findOrFail($auction_id);

        return view('admin.auction.edit')->with('auction', $auction);
    }


   public function addItemFromAuction($id)
    {
        $auction_id = Crypt::decrypt($id);

        $auction = Auction::findOrFail($auction_id);

        return view('admin.auction.add_ac_item')->with('auction', $auction);
    }


     public function ItemFromAuction($id)
    {
        $auction_id = Crypt::decrypt($id);

        $auction = Auction::findOrFail($auction_id); 

        return view('admin.auction.auction_items')->with('auction', $auction);
    }


     public function get_specific_Auctions_item_ajax(Request $request)
    {




     
        if (!empty($request->ac_parent_id)) {
            // $fromDate = new Carbon($request->from_date);
            // $toDate = new Carbon($request->to_date);

          $acData=AuctionItem::where('ac_parent_id',$request->ac_parent_id)->where('is_softdel','no');
          if ($request->status) {
              
               $acData->where('status',$request->status)->where('is_softdel','no');
          }

          if ($request->typep) {
              
               $acData->where('post_type',$request->typep)->where('is_softdel','no');
          }
            if ($request->ac_parent_id) {
              
               $acData->where('ac_parent_id',$request->ac_parent_id)->where('is_softdel','no');
          }
          if($request->from_date && $request->to_date){
          $acData->where('end_datetime','<=',CH::addUtc($request->to_date))->where('start_datetime','>=',CH::addUtc($request->from_date));

          }
          
            return datatables()
                ->of($acData->latest()
                        ->get())->addColumn(
                    'status',
                    function ($data) {
                        if ($data->status == 'on') {
                            $label = '<span class="label label-success">Active</span>';
                        } else {
                            $label = '<span class="label label-danger">Deactive</span>';
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
                    <a class="dropdown-item" href="' . route('view_auction_item', ['id' => Crypt::encrypt($data->id) ]) . '">View</a>
                    <a class="dropdown-item" href="' . route('edit_auction_item', ['id' => Crypt::encrypt($data->id) ]) . '">Edit</a>
                   
                    <button class="dropdown-item deleteAuction btn-danger btn-block"   del-id=' . $data->id . '>Delete</button>
                  </div>
                </div>';
                        return $button;
                    }
                )->rawColumns(['action', 'status'])
                ->make(true);
       

        }else
        {

            return datatables()
                ->of(AuctionItem::where('is_softdel', 'no')->where('ac_parent_id',$request->auction_id)
                ->latest()
                ->get())->addColumn('status', function ($data)
            {

                if ($data->status == 'on')
                {
                    $label = '<span class="label label-success">Active</span>';
                }
                else
                {

                    $label = '<span class="label label-danger">Deactive</span>';
                }

                return $label;
            })->addColumn('action', function ($data)
            {
                $button = ' <div class="btn-group">
                  <button type="button" class="btn btn-danger btn-sm shadow-lg border-0 dropdown-toggle btn-block shadow-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Operations
                  </button>';

                $button .= '<div class="dropdown-menu">
                    <a class="dropdown-item" href="' . route('view_auction_item', ['id' => Crypt::encrypt($data->id) ]) . '">View</a>
                    <a class="dropdown-item" href="' . route('edit_auction_item', ['id' => Crypt::encrypt($data->id) ]) . '">Edit</a>
                   
                    <button class="dropdown-item deleteAuction btn-danger btn-block"   del-id=' . $data->id . '>Delete</button>
                  </div>
                </div>';
                return $button;
            })->rawColumns(['action', 'status'])
                ->make(true);

        }

    }




  


    
    public function update_Auction(Request $request)
    {
 
       
        $org = $request->file('org');
        if (!empty($org)) {
            $org_image = $request->file('featured_img');
            $org= time() . uniqid(). '.' .$org_image->getClientOriginalExtension();
            $destinationPath = public_path('/img/');
            $org_image->move($destinationPath, $org);
        }else {
            
             $org=$request->hidden_org; 
        }
      
        $image_name = $request->hidden_image;
        $image = $request->file('featured_img');
        if ($image != '') {
            $request->validate( 
                [
                    'title' => 'required|max:255', 'slug' => 'required', 'post_type' => 'required',
                    'description' => 'required', 'start_datetime' => 'required', 'end_datetime' => 'required', 'featured_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'status' => 'required',
                ]
            );

            $image = $request->file('featured_img');
            $image_name = time() . uniqid(). '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img/');
            $image->move($destinationPath, $image_name);
        } else {
            $request->validate(
                [
                    'title' => 'required|max:255', 'slug' => 'required', 'post_type' => 'required',
                    'description' => 'required', 'start_datetime' => 'required', 'end_datetime' => 'required', 'status' => 'required',
                ]
            );
        }

        $updateAuctionFind = Auction::find(Crypt::decrypt($request->auc_id));
        $updateAuctionFind->update(
            [
                'title' => $request->title, 'slug' => $request->slug, 'post_type' => $request->post_type,
                'description' => $request->description, 'start_datetime' => CH::addUtc($request->start_datetime), 'end_datetime' => CH::addUtc($request->end_datetime),
                'status' => $request->status, 'featured_img' => $image_name,'org_name' =>$request->org_name,'org' =>$org, 'author' =>$request->author,
            ]
        );

        if ($updateAuctionFind) {
            return redirect()->back()
                ->with('message', $request->title . 'updated SuccessFully...!');
        }
    }

    public function delete_Auctions_ajax(Request $request)
    {
        $Auction = Auction::find($request->auction_id);
        $Auction->update(['is_softdel' => 'yes']);
        if ($Auction) {
            return response()->json(['status' => 'ok', 'id' => $request->auction_id]);
        } else {
            return response()
                ->json(['status' => 'error']);
        }
    }





    public function get_specific_Auctions_Date_Time_ajax(Request $request){

    return json_encode($Auction = Auction::find($request->parient_auction));

    }


public function get_Auctions_for_winner_ajax(Request $request){

 $search = $request->search;

      if($search == ''){
         $employees = Auction::orderby('title','asc')->select('id','title')->limit(5)->get();
      }else{
         $employees = Auction::orderby('title','asc')->select('id','title')->where('title', 'like', '%' .$search . '%')->limit(5)->get();
      }

      $response = array();
       $response[]= array("id"=>'all',
              "text"=>'All');
      foreach($employees as $employee){
         $response[] = array(
              "id"=>$employee->id,
              "text"=>$employee->title
         );
      }
    
      echo json_encode( $response);
      exit;

}




}

