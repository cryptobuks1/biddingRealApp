<?php
namespace App\Http\Controllers\AuctionItems;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Auction;
use App\AuctionItem;
use App\Conditions;
use DB; 
use Auth;
use CH;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
class AuctionItemController extends Controller
{

    public function index()
    {



             $count = Auction::where('is_softdel', 'no')->where('status','on')->count();
        if ($count < 1)
        {

            return redirect('admin/auction')->with('error', 'Please Add Minimumm 1 auction  First ...');
            
        }
       
     

            return view('admin.auction_child.dashboard')
                ->with('auctions', Auction::where('is_softdel', 'no')
                ->where('status', 'on')
                ->get());

        

        //unlink(public_path('/img/').'1603980152.jpg');
         
    }

    public function getall_Auctions_item_ajax(Request $request)
    {
          if (!empty($request->status) ||!empty($request->typep) ||!empty($request->from_date) &&!empty($request->parient_auction) &&!empty($request->to_date)) {
            // $fromDate = new Carbon($request->from_date);
            // $toDate = new Carbon($request->to_date);

          $acData=AuctionItem::where('status',$request->status)->where('is_softdel','no');
          if ($request->status) {
              
               $acData->where('status',$request->status)->where('is_softdel','no');
          }

          if ($request->typep) {
              
               $acData->where('post_type',$request->typep)->where('is_softdel','no');
          }
            if ($request->parient_auction) {
              
               $acData->where('ac_parent_id',$request->parient_auction)->where('is_softdel','no');
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
       

        }
        else
        {

            return datatables()
                ->of(AuctionItem::where('is_softdel', 'no')
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

    public function addnew_item()
    {


          $count = Auction::where('is_softdel', 'no')->where('status','on')->count();
        if ($count < 1)
        {

            return redirect('admin/auction')->with('error', 'Please Add Minimumm 1 auction  First ...');
            
        }
        return view('admin.auction_child.add')
            ->with('auctions', Auction::where('is_softdel', 'no')
            ->where('status', 'on')
            ->get());
    }

    public function insert_Auction_item(Request $request)
    {




        $request->validate(['title' => 'required|max:255', 'slug' => 'required', 'post_type' => 'required', 'description' => 'required', 'start_datetime' => 'required', 'end_datetime' => 'required', 'gallery' => 'required', 'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg', 'status' => 'required', 'upload_video' => 'mimes:mp4,ogx,oga,ogv,ogg,webm', 'ac_parent_id' => 'required', 'start_price' => 'required']);

        if (!empty($request->ac_parent_id))
        {

            $i = 0;
            $len = count($request->ac_parent_id);
            $namevid = '';
            foreach ($request->ac_parent_id as $item)
            {
                if ($i == 0)
                {

                    if ($request->hasfile('upload_video'))
                    {
                        $image = $request->file('upload_video');
                        $namevid = time(). uniqid().'.' . $image->getClientOriginalExtension();
                        $destinationPath = public_path('/videos/');
                        $image->move($destinationPath, $namevid);

                    }

                    if ($request->hasfile('gallery'))
                    {
                        foreach ($request->file('gallery') as $file)
                        {

                            $name =time(). uniqid().'.' . $file->extension();
                            $file->move(public_path() . '/img/', $name);
                            $data[] = $name;
                        }
                    }

                    $dataimg = implode(",", $data);

                    $insertAuctionitem = AuctionItem::create(['title' => $request->title, 'slug' => $request->slug, 'post_type' => $request->post_type, 'description' => $request->description, 'start_datetime' => CH::addUtc($request->start_datetime) , 'end_datetime' => CH::addUtc($request->end_datetime) , 'status' => $request->status, 'gallery' => $dataimg, 'user_id' =>$request->author, 'video_link' => $request->video_link, 'start_price' => $request->start_price, 'upload_video' => $namevid, 'ac_parent_id' => $item,

                    ]);

                }
                else
                {

                    $dataimg = implode(",", $data);
                    $insertAuctionitem = AuctionItem::create(['title' => $request->title, 'slug' => $request->slug, 'post_type' => $request->post_type, 'description' => $request->description, 'start_datetime' => CH::addUtc($request->start_datetime) , 'end_datetime' => CH::addUtc($request->end_datetime) , 'status' => $request->status, 'gallery' => $dataimg, 'user_id' =>$request->author, 'video_link' => $request->video_link, 'start_price' => $request->start_price, 'upload_video' => $namevid, 'ac_parent_id' => $item,

                    ]);

                }
                // …
                $i++;
          



             CH::insertCustomFields_meta($request->post_type, $insertAuctionitem->id,$request);
             if (array_key_exists("bidding_price_interval",$request->all()) && $request->bidding_price_interval=='on') {
              
                 Conditions::create(['inc_amount'=>$request->bidinterval_price,'status'=>$request->bidding_price_interval,'ac_parent_child_id'=>$insertAuctionitem->id,'ac_parent_id'=>$item]);
                 }
              
           
            }

        }

        if ($insertAuctionitem)
        {

         
           

            return redirect()->back()
                ->with('message', $insertAuctionitem->title . 'Add SuccessFully...!');
        }

    }









  public function view_auction_item($id)
    {

        $auction_item_id = Crypt::decrypt($id);

        $auctionch = AuctionItem::findOrFail($auction_item_id);

        return view('admin.auction_child.view')->with('auctions', Auction::where('is_softdel', 'no')
            ->where('status', 'on')
            ->get())->with('auction_Childs', $auctionch);
    }




    public function edit_auction_item($id)
    {

        $auction_item_id = Crypt::decrypt($id);

        $auctionch = AuctionItem::findOrFail($auction_item_id);

       $auction_item_condition= Conditions::where('ac_parent_child_id',$auction_item_id)->first();

        return view('admin.auction_child.edit')->with('auctions', Auction::where('is_softdel', 'no')
            ->where('status', 'on')
            ->get())->with('auction_Childs', $auctionch)->with('auction_item_condition',$auction_item_condition);
    }

    public function update_Auction_item(Request $request)
    {


     
    
     

        $hidden_video = $request->hidden_video;
        $hidden_gallery = $request->hidden_gallery;

        $gallery = $request->file('gallery');
        $upload_video= $request->file('upload_video');


        if (!empty($upload_video)) {

             $request->validate(['title' => 'required|max:255', 'slug' => 'required', 'post_type' => 'required', 'description' => 'required', 'start_datetime' => 'required', 'end_datetime' => 'required','status' => 'required', 'upload_video' => 'mimes:mp4,ogx,oga,ogv,ogg,webm', 'ac_parent_id' => 'required', 'start_price' => 'required']);
                        $image = $request->file('upload_video');
                        $hidden_video = time(). uniqid().'.' . $image->getClientOriginalExtension();
                        $destinationPath = public_path('/videos/');
                        $image->move($destinationPath, $hidden_video);
        }else {
             $hidden_video = $request->hidden_video; 
        }


        if (!empty($gallery))
        {
             $request->validate(['title' => 'required|max:255', 'slug' => 'required', 'post_type' => 'required', 'description' => 'required', 'start_datetime' => 'required', 'end_datetime' => 'required', 'gallery' => 'required', 'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg', 'status' => 'required', 'upload_video' => 'mimes:mp4,ogx,oga,ogv,ogg,webm', 'ac_parent_id' => 'required', 'start_price' => 'required']);

                       foreach ($request->file('gallery') as $file)
                        {

                            $name =time(). uniqid().'.' . $file->extension();
                            $file->move(public_path() . '/img/', $name);
                            $data[] = $name;
                        }

                         $hidden_gallery= implode(",", $data);

                      

        }
        else
        {

           $request->validate(['title' => 'required|max:255', 'slug' => 'required', 'post_type' => 'required', 'description' => 'required', 'start_datetime' => 'required', 'end_datetime' => 'required', 'status' => 'required', 'ac_parent_id' => 'required', 'start_price' => 'required']);

        }

        $updateAuctionitemFind = AuctionItem::find(Crypt::decrypt($request->aucitem_id));
        $updateAuctionitemFind->update(['title' => $request->title, 'slug' => $request->slug, 'post_type' => $request->post_type, 'description' => $request->description, 'start_datetime' => CH::addUtc($request->start_datetime) , 'end_datetime' => CH::addUtc($request->end_datetime) , 'status' => $request->status, 'gallery' => $hidden_gallery, 'user_id' =>$request->author, 'video_link' => $request->video_link, 'start_price' => $request->start_price, 'upload_video' => $hidden_video, 'ac_parent_id' =>$request->ac_parent_id]);

        if ($updateAuctionitemFind)
        {



        CH::UpdateCustomFields_meta($request->post_type,Crypt::decrypt($request->aucitem_id),$request);

         
        $condcheck= Conditions::where('ac_parent_child_id',Crypt::decrypt($request->aucitem_id))->count();


       
            
      
        if (array_key_exists("bidding_price_interval",$request->all())){


             if ($condcheck>0) {

         Conditions::where('ac_parent_child_id',Crypt::decrypt($request->aucitem_id))->update(['inc_amount'=>$request->bidinterval_price,'status'=>$request->bidding_price_interval,'ac_parent_child_id'=>Crypt::decrypt($request->aucitem_id),'ac_parent_id'=>$request->ac_parent_id]);

     }else {

         Conditions::create(['inc_amount'=>$request->bidinterval_price,'status'=>$request->bidding_price_interval,'ac_parent_child_id'=>Crypt::decrypt($request->aucitem_id),'ac_parent_id'=>$request->ac_parent_id]);
         
     } 
         

         }else {

         if ($condcheck>0) {

          Conditions::where('ac_parent_child_id',Crypt::decrypt($request->aucitem_id))->update(['status'=>'off']);
      }else {
          
      }

           }
            


                  
                
            

            return redirect()->back()
                ->with('message', $request->title . ' Auction Item updated SuccessFully...!');
        }

    }

    public function delete_Auctions_item_ajax(Request $request)
    {

        $Auction = AuctionItem::find($request->auction_id);
        $Auction->update(['is_softdel' => 'yes']);
        if ($Auction)
        {

            return response()->json(['status' => 'ok', 'id' => $request->auction_id]);
        }
        else
        {
            return response()
                ->json(['status' => 'error']);
        }
    }

}

