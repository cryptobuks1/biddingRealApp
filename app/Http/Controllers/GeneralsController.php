<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\General;
class GeneralsController extends Controller
{
    



 public function index(){
   




   return view('admin.general.edit')->with('generals', General::find(1));



 }


public function setEnvironmentValueandGenerals(Request $request){


   
        $hlogo = $request->file('hlogo');
        if (!empty($hlogo)) {
            $hlogo_image = $request->file('hlogo');
            $hlogo= time() . uniqid(). '.' .$hlogo_image->getClientOriginalExtension();
            $hlogo_destinationPath = public_path('/img/');
            $hlogo_image->move($hlogo_destinationPath, $hlogo);
        }else {
            
             $hlogo=$request->hlogohidden; 
        }

      

         $flogo = $request->file('flogo');
        if (!empty($flogo)) {
            $flogo_image = $request->file('flogo');
            $flogo= time() . uniqid(). '.' .$flogo_image->getClientOriginalExtension();
            $flogo_destinationPath = public_path('/img/');
            $flogo_image->move($flogo_destinationPath, $flogo);
        }else {
            
             $flogo=$request->flogohidden; 

        }



       

         $howbidimg = $request->file('howbidimg');
        if (!empty($howbidimg)) {
            $howbidimg_image = $request->file('howbidimg');
            $howbidimg= time() . uniqid(). '.' .$howbidimg_image->getClientOriginalExtension();
            $howbidimg_destinationPath = public_path('/img/');
            $howbidimg_image->move($howbidimg_destinationPath, $howbidimg);
        }else {
            
             $howbidimg=$request->howbimghidden; 

            
        }


    if (General::count()>0) {

        General::find(1)->update(['address'=>$request->address,'address2'=>$request->address2,'howtoBid'=>$request->howtoBid,'howtoBidimg'=>$howbidimg]);



    $values=['SITE_LOGO'=>$hlogo,'SITE_LOGO_FOOTER'=>$flogo,'MAIL_SUBJECT'=>$request->MAIL_SUBJECT,'MAIL_TO_CONTACT'=>$request->MAIL_TO_CONTACT,'MAIL_FROM_NAME'=>$request->MAIL_FROM_NAME,'APP_URL'=>$request->APP_URL,'MAIL_FROM_ADDRESS'=>$request->MAIL_FROM_ADDRESS,'APP_NAME'=>$request->APP_NAME];

    $envFile = app()->environmentFilePath();
    $str = file_get_contents($envFile);

    if (count($values) > 0) {
        foreach ($values as $envKey => $envValue) {

            $str .= "\n"; // In case the searched variable is in the last line without \n
            $keyPosition = strpos($str, "{$envKey}=");
            $endOfLinePosition = strpos($str, "\n", $keyPosition);
            $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

            // If key does not exist, add it
            if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                $str .= "{$envKey}={$envValue}\n";
            } else {
                $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
            }

        }
    }

    $str = substr($str, 0, -1);
     if (!file_put_contents($envFile, $str)) return false;
      \Artisan::call('config:cache');
    \Artisan::call('route:clear');
     \Artisan::call('cache:clear');
       \Artisan::call('view:clear');

  return 'Data Update SuccessFully Please Click Back Button of browser refresh page...!';
   

//          foreach ($values as $key => $value) {
//         $path = base_path('.env');

//         if (file_exists($path)) {

//             file_put_contents($path, str_replace(
//                 $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
//             ));
//         }
// }



    //  $envFile = app()->environmentFilePath();
    // $str = file_get_contents($envFile);

    // if (count($values) > 0) {
    //     foreach ($values as $envKey => $envValue) {

    //         $str .= "\n"; // In case the searched variable is in the last line without \n
    //         $keyPosition = strpos($str, "{$envKey}=");
    //         $endOfLinePosition = strpos($str, "\n", $keyPosition);
    //         $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

    //         // If key does not exist, add it
    //         if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
    //             $str .= "{$envKey}={$envValue}\n";
    //         } else {
    //             $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
    //         }

    //     }
    // }

    // $str = substr($str, 0, -1);
    // // if (!file_put_contents($envFile, $str)) return false;
    // //return true;


    //  /* php artisan migrate */
  
    //   \Artisan::call('config:cache');
    // \Artisan::call('route:clear');
    //  \Artisan::call('cache:clear');
    //    \Artisan::call('view:clear');
  

    	
    }else {


     General::create(['address'=>$request->address,'address2'=>$request->address2,'howtoBid'=>$request->howtoBid,'howtoBidimg'=>$howbidimg]);

    $values=['SITE_LOGO'=>$hlogo,'SITE_LOGO_FOOTER'=>$flogo,'MAIL_SUBJECT'=>$request->MAIL_SUBJECT,'MAIL_TO_CONTACT'=>$request->MAIL_TO_CONTACT,'MAIL_FROM_NAME'=>$request->MAIL_FROM_NAME,'APP_URL'=>$request->APP_URL,'MAIL_FROM_ADDRESS'=>$request->MAIL_FROM_ADDRESS,'APP_NAME'=>$request->APP_NAME];
     $envFile = app()->environmentFilePath();
    $str = file_get_contents($envFile);

    if (count($values) > 0) {
        foreach ($values as $envKey => $envValue) {

            $str .= "\n"; // In case the searched variable is in the last line without \n
            $keyPosition = strpos($str, "{$envKey}=");
            $endOfLinePosition = strpos($str, "\n", $keyPosition);
            $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

            // If key does not exist, add it
            if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                $str .= "{$envKey}={$envValue}\n";
            } else {
                $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
            }

        }
    } 

    $str = substr($str, 0, -1);
     if (!file_put_contents($envFile, $str)) return false;
      \Artisan::call('config:cache');
    \Artisan::call('route:clear');
     \Artisan::call('cache:clear');
       \Artisan::call('view:clear');


    return 'Data Update SuccessFully Please Click Back Button of browser refresh page...!';
    	
    }



  


}








}
