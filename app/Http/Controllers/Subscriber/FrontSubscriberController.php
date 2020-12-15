<?php

namespace App\Http\Controllers\Subscriber;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Auction;
use DB;
use Auth;
use DataTables; 
use App\News; 
use App\Subscriber; 
use App\AuctionItem; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use CH;
use Mail;

class FrontSubscriberController extends Controller
{
    
 public function index()
    {
        //unlink(public_path('/img/').'1603980152.jpg');
        return view('admin.subscriber.dashboard');
    }



      public function subscriber_admin_ajax(Request $request)
    {
        if (!empty($request->status)  ||!empty($request->from_date) &&!empty($request->to_date)) {
           
          $acData=Subscriber::where('status',$request->status)->where('is_softdel','no');
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
                            $label = '<span class="label label-success">yes</span>';
                        } else {
                            $label = '<span class="label label-danger">No</span>';
                        }

                        return $label;
                    }
                )->setRowClass(function ($data) {
    return 'customvalueofemailget';
})->addColumn(
                    'action',
                    function ($data) {
                        $button = ' <div class="btn-group">
                  <button type="button" class="btn btn-danger btn-sm shadow-lg border-0 dropdown-toggle btn-block shadow-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Operations
                  </button>';

                        $button .= '<div class="dropdown-menu">
                         <a class="dropdown-item" href="' . route('edit_subscriber_admin', ['id' => Crypt::encrypt($data->id)]) . '">Edit</a>
                   
                    <button class="dropdown-item deleteAuction btn-danger btn-block"   del-id=' . $data->id . '>Delete</button>
                  </div>
                </div>
                 <>
                <input type="checkbox" name="selected_users[]"/>';
                        return $button;
                    }
                )->rawColumns(['action', 'status','check'])
                ->make(true);



        } else {
            return datatables()
                ->of(
                    Subscriber::where('is_softdel', 'no')
                        ->latest()
                        ->get()
                )->setRowClass(function ($data) {
    return 'customvalueofemailget';
})->addColumn(
                    'status',
                    function ($data) {
                        if ($data->status == 'on') {
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
                   
                
                    <a class="dropdown-item" href="' . route('edit_subscriber_admin', ['id' => Crypt::encrypt($data->id)]) . '">Edit</a>
                   
                    <button class="dropdown-item deleteAuction btn-danger btn-block"   del-id=' . $data->id . '>Delete</button>
                  </div>
                </div>';
                        return $button;
                    }
                )->rawColumns(['action', 'status'])
                ->make(true);
        }
    }


 

     public function add_subscriber_admin()
    {
        return view('admin.subscriber.add');
    }

    public function insert_subscriber_admin(Request $request)

 
 
    {

          // dd(CH::addUtc($request->end_datetime));

        $request->validate(
            [
                'email' =>'required|email|unique:subscriber','create_datetime' => 'required','status' => 'required',
            ]
        );

       
            $insert = Subscriber::create(
                [
                    'email' => $request->email,'description' => $request->description, 'create_datetime' => CH::addUtc($request->create_datetime),'status' =>$request->status
                ]
            );

            if ($insert) {
                return redirect()->back()
                    ->with('message', $insert->email . 'Add SuccessFully...!');
            }
       
    }

    public function edit_subscriber_admin($id)
    {
        $sub_id = Crypt::decrypt($id);

        $auction = Subscriber::findOrFail($sub_id);

        return view('admin.subscriber.edit')->with('subscriber', $auction);
    }


    
    public function update_subscriber_admin(Request $request)
    {
     

    $check=Subscriber::where('email',$request->email)->count();
   
     if ($check==0 || $check==1) {
     	
     

      $request->validate(
            [
                'email' =>'required','create_datetime' => 'required','status' => 'required',
            ]
        );

       
        $updateFind = Subscriber::find(Crypt::decrypt($request->sub_id));
        $updateFind->update(
            [
                   
                    'email' => $request->email,'description' => $request->description, 'create_datetime' => CH::addUtc($request->create_datetime),'status' =>$request->status
                ]
        );

        if ($updateFind) {
            return redirect()->back()
                ->with('message', $request->email . 'updated SuccessFully...!');
        }


    }else{

    return redirect()->back()
                ->with('error', $request->email . 'Alredy Exist Email must Be unique');
     

    }
    } 

    public function delete_subscriber_admin_ajax(Request $request)
    {
        $subscriber =Subscriber::findOrFail($request->sub_id);
        $subscriber->update(['is_softdel' => 'yes']);
        if ($subscriber) {
            return response()->json(['status' => 'ok', 'id' => $request->sub_id]);
        } else {
            return response()
                ->json(['status' => 'error']);
        }
    }



    public function sendmail_subscriber_admin_ajax(Request $request){


     foreach ($request->favorite as $value) {


         $to_name =$request->subject;
          $to_email =$value['email'];
          $data = array("body" =>$request->content,'subject'=>$request->subject,'app_url'=>config('custom_env_Variables.APP_URL'),'logo'=>config('custom_env_Variables.APP_URL').'/public/img/'.config('custom_env_Variables.SITE_LOGO'));
          
          Mail::send('emails.subscriber', $data, function($message) use ($to_name, $to_email,$request) {
          $message->to($to_email, $to_name) 
            ->subject($request->subject);
          $message->from( config('custom_env_Variables.MAIL_FROM_ADDRESS'),config('custom_env_Variables.MAIL_FROM_NAME'));
           });


       
     }

        return response()
                ->json(['status'=>'ok']); 
     

    }


}
