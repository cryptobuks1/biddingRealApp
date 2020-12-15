<?php

namespace App\Http\Controllers\CustomFields;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CustomField;
use Session;
use App\Auction;
use App\AuctionItem;
use App\PostMeta;
use App\Post;
use DB;
use Auth;
use CH;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class AuctionCustomFieldController extends Controller
{
   


  public function index(){

  return view('admin.auction_custom_fields.dashboard');

  }





      public function getall_Auctions_customFields_ajax(Request $request)
    {

       
        
        

            return datatables()
                ->of(CustomField::where('is_softdel', 'no')
                ->latest()
                ->get())->addColumn('status', function ($data)
            {

                if ($data->status == 'on')
                {
                    $label = '<span class="label label-success">On</span>';
                }
                else
                {

                    $label = '<span class="label label-danger">Off</span>';
                }

                return $label;
            })->addColumn('action', function ($data)
            {
                $button = ' <div class="btn-group">
                  <button type="button" class="btn btn-danger btn-sm shadow-lg border-0 dropdown-toggle btn-block shadow-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Operations
                  </button>';

                $button .= '<div class="dropdown-menu">
                    
                    <a class="dropdown-item" href="' . route('edit_auction_customFields', ['id' => Crypt::encrypt($data->id) ]) . '">Edit</a>
                   
                    <button class="dropdown-item deleteAuction btn-danger btn-block"   del-id=' . $data->id . '>Delete</button>
                  </div>
                </div>';
                return $button;
            })->rawColumns(['action', 'status'])
                ->make(true);

        

    }




     

     public function allposts(){

    
     return view('admin.auction_custom_fields.posts');

     }


      public function getall_post_ajax(Request $request)
    {

       
        
        

            return datatables()
                ->of(Post::where('is_softdel', 'no')
                ->latest()
                ->get())->addColumn('action', function ($data)
            {
                $button = ' <div class="btn-group">
                  <button type="button" class="btn btn-danger btn-sm shadow-lg border-0 dropdown-toggle btn-block shadow-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Operations
                  </button>';

                $button .= '<div class="dropdown-menu">
                   
                    <button class="dropdown-item deleteAuction btn-danger btn-block"   del-id=' . $data->id . '>Delete</button>
                  </div>
                </div>';
                return $button;
            })->rawColumns(['action', 'status'])
                ->make(true);

        

    }


    public function add_post(){

        return view('admin.auction_custom_fields.addPost');
    }



    public function insert_post(Request $request){
    
    $request->validate(['post_type' => 'required|max:255|unique:posts']);

    $post =Post::create(['post_type'=>$request->post_type]);
                  if ($post) {//CH::insertCustomFields_meta('horse',$insertAuctionField->id,$request);
                return redirect()->back()
                    ->with('message', $post->name . 'Add SuccessFully...!');
            }

    }


    public function addnew_customField(){

     return view('admin.auction_custom_fields.add');


    }



    public function insert_Auction_customField(Request $request){


               

    	  $request->validate(['name' => 'required|max:255', 'slug' => 'required', 'post_type' => 'required', 'field_type' => 'required']);

    	    $count=CustomField::where('slug',$request->slug)->where('post_type',$request->post_type)->where('is_softdel','no')->count();

    	    if ($count>0) {


                return redirect()->back()
                    ->with('error', 'Please Enter Unique Slug Value Against Post type Slug Value Already exist');
    	    	
    	    }

            $insertAuctionField = CustomField::create(['name' => $request->name, 'slug' => $request->slug,'post_type'=>$request->post_type,'css_class'=>$request->css_class,'css_id'=>$request->css_id,'field_type'=>$request->field_type,'status'=>$request->status,'placeholder'=>$request->placeholder,'required'=>$request->required]);
                  if ($insertAuctionField) {


                  	//CH::insertCustomFields_meta('horse',$insertAuctionField->id,$request);
                return redirect()->back()
                    ->with('message', $insertAuctionField->name . 'Add SuccessFully...!');
            }

 
               }
             

               public function edit_auction_customFields($id){


                 $auction_acf_id = Crypt::decrypt($id);

             $acfdata = CustomField::findOrFail($auction_acf_id);

              return view('admin.auction_custom_fields.edit')->with('acfdata',$acfdata);


               }


               

  
        
         public function delete_Auctions_customfields_ajax(Request $request)
    {
        $Auction = CustomField::find($request->auction_customFiled_id);
        $Auction->update(['is_softdel' => 'yes']);
        if ($Auction) {
            return response()->json(['status' => 'ok', 'id' => $request->auction_id]);
        } else {
            return response()
                ->json(['status' => 'error']);
        }
    }


         public function delete_getall_post_ajax(Request $request)
    {
        $idp = Post::find($request->idp);
        $idp->update(['is_softdel' => 'yes']);
        if ($idp) {
            return response()->json(['status' => 'ok', 'id' => $request->idp]);
        } else {
            return response()
                ->json(['status' => 'error']);
        }
    }



        public function Update_Acf_fields(Request $request)
    {

    
       $Update_Acf_f = CustomField::find($request->updateAcf_id);


        $Update_Acf_f->update(['name' => $request->name,'css_class'=>$request->css_class,'css_id'=>$request->css_id,'field_type'=>$request->field_type,'status'=>$request->status,'placeholder'=>$request->placeholder,'required'=>$request->required]);
        if ($Update_Acf_f) {


          if (!empty($request->already_field_type)) {
               $updatefields=PostMeta::where('meta_key',$request->acfslug)->where('post_type',$request->acfptype)->where('field_type',$request->already_field_type);

          }else {
              $updatefields=PostMeta::where('meta_key',$request->acfslug)->where('post_type',$request->acfptype)->where('field_type',$request->field_type);
          }
      


          $updatefields->update(['status'=>$request->status,'field_type'=>$request->field_type]);
        

        return redirect()->back()
                ->with('message', $request->title . 'Record updated SuccessFully...!');


      }

    }



    public function addnew_customFieldTo_Post_ajax(Request $request){

      return CH::addCustomFields($request->postType);
    }


  public function  edit_customFieldTo_Post_ajax(Request $request){

      return CH::editCustomFields($request->postType,$request->post_id);
    }



   


}
