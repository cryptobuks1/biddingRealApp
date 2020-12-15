<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Auction;
use DB;
use Auth;
use DataTables; 
use App\News; 
use App\AuctionItem; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use CH;

class FrontNewsController extends Controller
{
     public function index()
    {
        //unlink(public_path('/img/').'1603980152.jpg');
        return view('admin.news.dashboard');
    }



      public function getall_news_ajax(Request $request)
    {
        if (!empty($request->status)  ||!empty($request->from_date) &&!empty($request->to_date)) {
           
          $acData=News::where('status',$request->status)->where('is_softdel','no');
          if ($request->status) {
              
               $acData->where('status',$request->status);
          }

       
          if($request->from_date && $request->to_date){
          $acData->whereBetween('create_datetime', [CH::addUtc($request->from_date), CH::addUtc($request->to_date)]);

         //where('end_datetime','<=',CH::addUtc($request->to_date))->where('start_datetime','>=',CH::addUtc($request->from_date));


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
                         <a class="dropdown-item" href="' . route('editnews_admin', ['id' => Crypt::encrypt($data->id)]) . '">Edit</a>
                   
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
                    News::where('is_softdel', 'no')
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
                   
                
                    <a class="dropdown-item" href="' . route('editnews_admin', ['id' => Crypt::encrypt($data->id)]) . '">Edit</a>
                   
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
        return view('admin.news.add');
    }

    public function insert_news(Request $request)

 
 
    {

          // dd(CH::addUtc($request->end_datetime));

        $request->validate(
            [
                'title' => 'required|max:255', 'slug' => 'required|unique:news', 'post_type' => 'required',
                'description' => 'required', 'create_datetime' => 'required','featured_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status' => 'required',
            ]
        );

        if ($request->hasFile('featured_img')) {
            $image = $request->file('featured_img');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img/');
            $image->move($destinationPath, $name);

        

            $insertAuction = News::create(
                [
                    'title' => $request->title, 'slug' => $request->slug, 'post_type' => $request->post_type,
                    'description' => $request->description, 'create_datetime' => CH::addUtc($request->create_datetime),'status' => $request->status, 'featured_img' => $name,'org_name' =>$request->org_name,'author' =>$request->author,
                ]
            );

            if ($insertAuction) {
                return redirect()->back()
                    ->with('message', $insertAuction->title . 'Add SuccessFully...!');
            }
        }
    }

    public function edit_news($id)
    {
        $news_id = Crypt::decrypt($id);

        $auction = News::findOrFail($news_id);

        return view('admin.news.edit')->with('news', $auction);
    }


    
    public function update_news(Request $request)
    {
 
       
     
        $image_name = $request->hidden_image;
        $image = $request->file('featured_img');
        if ($image != '') {
            $request->validate(
            [
                'title' => 'required|max:255', 'slug' => 'required', 'post_type' => 'required',
                'description' => 'required', 'create_datetime' => 'required','featured_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status' => 'required',
            ]
        );


            $image = $request->file('featured_img');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img/');
            $image->move($destinationPath, $image_name);
        } else {
            $request->validate(
                [
                    'title' => 'required|max:255', 'slug' => 'required', 'post_type' => 'required',
                    'description' => 'required', 'create_datetime' => 'required', 'status' => 'required',
                ]
            );
        }

        $updateFind = News::find(Crypt::decrypt($request->news_id));
        $updateFind->update(
            [
                    'title' => $request->title, 'slug' => $request->slug, 'post_type' => $request->post_type,
                    'description' => $request->description, 'create_datetime' => CH::addUtc($request->create_datetime),'status' => $request->status, 'featured_img' =>$image_name,'org_name' =>$request->org_name,'author' =>$request->author,
                ]
        );

        if ($updateFind) {
            return redirect()->back()
                ->with('message', $request->title . 'updated SuccessFully...!');
        }
    }

    public function delete_news_ajax(Request $request)
    {
        $news = News::findOrFail($request->news_id);
        $news->update(['is_softdel' => 'yes']);
        if ($news) {
            return response()->json(['status' => 'ok', 'id' => $request->news_id]);
        } else {
            return response()
                ->json(['status' => 'error']);
        }
    }




}
