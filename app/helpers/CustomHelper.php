<?php
namespace App\helpers;
use App\rolesauthority;
use App\User;
use App\Post;
use Carbon\Carbon;
use DB;
use Auth;
use App\Bidding;
use DateTime;
use DateTimeZone;
use App\CustomField; 
use App\PostMeta;
use Session;
use Cookie;
use App\Conditions;
use App\Auction;
use App\AuctionItem;

use Illuminate\Support\Facades\Crypt;
class CustomHelper
{

 
public function  getBreedHorse($slugfiled='',$postype='' ,$type=''){

return PostMeta::where('post_type',$postype)->where('meta_key',$slugfiled)->where('field_type',$type)->distinct()->get(['meta_value']);

 

}


public function getFrontEndBiddingSidebar($post_ac_id='',$post_ac_Item_id='',$bidStartPrice='' ,$startDate='',$endDate=''){

$currentBid=200;

$conditionCount=Conditions::where('ac_parent_id',$post_ac_id)->where('ac_parent_child_id',$post_ac_Item_id)->where('status','on')->where('is_softdel','no');




$bidCurrent=Bidding::where('ac_parent_id',$post_ac_id)->where('ac_parent_child_id',$post_ac_Item_id)->where('status','on')->where('is_softdel','no')->orderBy('amount', 'desc');


$auctionItem=AuctionItem::where('id',$post_ac_Item_id)->where('status','on')->where('is_softdel','no')->first();




?>  
<div class="shadow-sm bg-white rounded">
  <div class="content-box">
  <h3 class="text-capitalize pb-0 font-weight-bold">BID BOARD</h3>
  <div class="row mt-3">
  <div class="col-lg-6">
   <h5 class="text-capitalize text-dark font-weight-bold"><span class="fa fa-gavel"></span>Start PRICE
  </h5>
  </div>
  <div class="col-lg-6">
  <p class="text-danger font-weight-bold float-right" style="font-size: 18px;">$<?php echo $bidStartPrice; ?></p>
  </div>
  </div>

  <div class="row text-center">
  <button  class="bg-dark p-2  text-white font-weight-bolder btn-block border-0 shadow-sm">Last Bid Price : <strong>$<?php echo (!empty($bidCurrent->first()->amount))? $bidCurrent->first()->amount : 0 ;?></strong></button>
  
  </div>
  <hr>

  <div  class="tab-outter">

    <?php
if (Auth::check()) {
  echo '<button class="btn-success btn btn-block shadow-lg border-0 mb-4" data-toggle="modal" data-target="#BiddinModalCenter">Bid Now</button>';
}else{

echo ' <a href="/login" class="btn-danger btn btn-block shadow-lg border-0 mb-4">Login/Register</a>';

}
    ?>
    
   
  </div>

    <div class="row ">

      <div class="col-lg-12 text-center">
        <p id="countDownTimer" class="text-danger font-weight-bolder"></p>
      </div>
    
    </div>
    <div class="row text-center">

      <ul class="list-group list-group-flush">
 
     <li class="list-group-item text-capitalize"></i>Ended &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-dark float-right countDownDatetimeval"><?php

     echo $this->convertTimeToUSERzone($auctionItem->end_datetime, Session::get('ClientTimezone'), $format = 'd M Y, h:i:s A');?></span></li>

      <li class="list-group-item text-capitalize text-dark font-weight-bold">Total Bids <span class="text-center text-success font-weight-bolder float-right pr-4 pl-4  rounded  bg-inverse shadow-lg" style="font-size: 17px;"><?php echo $bidCurrent->count();?></span></li>
     
   </ul>
  </div>
   </div>
</div>

<div class="shadow-sm bg-white rounded mt-4">
  <div class="content-box">
  <h4 class="text-capitalize pb-0 font-weight-bold text-success">RECENTS BIDS</h4>

    <ul class="list-group list-group-flush">

   <?php
   foreach ($bidCurrent->limit(10)->get() as $bidCurrentvalue) {
     ?>

    <li class="list-group-item "><i class="fa fa-calendar"></i>&nbsp;&nbsp; <?php echo $this->convertTimeToUSERzone($bidCurrentvalue->bdatetime, Session::get('ClientTimezone'), $format = 'd M Y, h:i:s A');?> &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger float-right">$<?php echo $bidCurrentvalue->amount;?></span></li>
     <?php
   }
   ?>

  
 
</ul>
   </div>
</div>
<aside>
  <style>
  .lot-vid ul li {
  list-style-type: none;
  }
  .lot-vid ul {
  padding-left: 0px;
  }
  </style>
</aside>

<!-- Bidding Modal -->
  <!-- Modal --> 
<div class="modal fade" id="BiddinModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-body">

        <div id="biddingConditions">

          <?php

          if ($conditionCount->count()>0) {
          $conditionCountdata =$conditionCount->first();
           ?>

      <ul class="list-group list-group-flush " >
      <li class="list-group-item text-danger p-1 font-weight-light text-capitalize" style="border: 0 !important;">The minimun increment you can make in the last bid is <strong class="font-weight-bolder" style="font-size: 17px;
    font-weight: 900 !important;">$ <?php echo $conditionCountdata->inc_amount; ?></strong>
   and the new minimum bid you can do is <strong class="font-weight-bolder text-warning" style="font-size: 17px;
    font-weight: 900 !important;">
  <?php echo (!empty($bidCurrent->first()->amount))? $bidCurrent->first()->amount : $auctionItem->start_price;?>+<?php echo $conditionCountdata->inc_amount;?>=<?php $calcu=(!empty($bidCurrent->first()->amount))? $bidCurrent->first()->amount : $auctionItem->start_price; echo $calcu+$conditionCountdata->inc_amount;?>
  
</strong> </li>  
     

     </ul> 
            
         <?php }else { 
 
       $age=$this->get_Post_Meta_value($post_ac_Item_id,'number','age','horse',$status='on'); 


       $isRidden=$this->get_Post_Meta_value($post_ac_Item_id,'isridden','is_ridden','horse',$status='on');


     if ($bidCurrent->count()<1) {
  
$currentBid=$auctionItem->start_price;
}else {
  $currentBid=(!empty($bidCurrent->first()->amount))? $bidCurrent->first()->amount : 0 ;
}


          ?>
           
      <ul class="list-group list-group-flush " >
      
     <?php
    if($age <= 1){
    
    ?>
     <li class="list-group-item text-danger p-1 font-weight-light text-capitalize" style="border: 0 !important;">The minimun increment you can make in the last bid is <strong class="font-weight-bolder" style="font-size: 17px;
    font-weight: 900 !important;">$50</strong>
   and the new minimum bid you can do is <strong class="font-weight-bolder text-warning" style="font-size: 17px;
    font-weight: 900 !important;">


  (<?php  echo (!empty($bidCurrent->first()->amount))? $bidCurrent->first()->amount : $auctionItem->start_price;?>+50=<?php echo $currentBid+50;?>)
  
</strong> </li>  
    <?php
  }elseif ($age <= 2 && $age > 1) {
    ?>
       <li class="list-group-item text-danger p-1 font-weight-light text-capitalize" style="border: 0 !important;">The minimun increment you can make in the last bid is <strong class="font-weight-bolder" style="font-size: 17px;
    font-weight: 900 !important;">$100</strong>
   and the new minimum bid you can do is <strong class="font-weight-bolder text-warning" style="font-size: 17px;
    font-weight: 900 !important;">
  (<?php  echo (!empty($bidCurrent->first()->amount))? $bidCurrent->first()->amount : $auctionItem->start_price;?>+100=<?php echo $currentBid+100;?>)
  
</strong> </li>   

   <?php }elseif ($age > 2 && $isRidden =='yes') { ?>
        <li class="list-group-item text-danger p-1 font-weight-light text-capitalize" style="border: 0 !important;">The minimun increment you can make in the last bid is <strong class="font-weight-bolder" style="font-size: 17px;
    font-weight: 900 !important;">$300</strong>
   and the new minimum bid you can do is <strong class="font-weight-bolder text-warning" style="font-size: 17px;
    font-weight: 900 !important;">
  (<?php  echo (!empty($bidCurrent->first()->amount))? $bidCurrent->first()->amount : $auctionItem->start_price;?>+300=<?php echo $currentBid+300;?>)
  
</strong> </li>  
     <?php
    }else { ?>

   <li class="list-group-item text-danger p-1 font-weight-light text-capitalize" style="border: 0 !important;">The minimun increment you can make in the last bid is <strong class="font-weight-bolder" style="font-size: 17px;
    font-weight: 900 !important;">$200</strong>
   and the new minimum bid you can do is <strong class="font-weight-bolder text-warning" style="font-size: 17px;
    font-weight: 900 !important;">
  (<?php  echo (!empty($bidCurrent->first()->amount))? $bidCurrent->first()->amount : $auctionItem->start_price;?>+200=<?php echo $currentBid+200;?>)
  
</strong> </li>  
    <?php  
    }



     ?>
   
     </ul>

     <?php
     }
     ?>

       
              
        </div>
    
     <div class="row text-center">
       <div class="col-6"><h2 class="font-weight-bolder text-success">Last Bid</h2></div>
        <div class="col-6"><h2 class="font-weight-bolder  text-success lastPriceval">$<?php echo(!empty($bidCurrent->first()->amount))? $bidCurrent->first()->amount : 0 ;?></h2></div>
     </div>

     <form action="CustomHelper_submit" method="Post" >
     
     <div class="validationStatus text-center text-capitalize">
       
     </div>
     <input type="hidden" name="auction_parient_id"  id="auction_parient_id" value='<?php echo Crypt::encrypt($post_ac_id);?>'/>

    <input type="hidden" name="auction_item_id" id="auction_item_id" value='<?php echo Crypt::encrypt($post_ac_Item_id);?>'/>
    
     <div class="row text-center px-5">
     <input type="number" name="bidPrice" id="bidPrice" class="form-control bidPrice" step="any"/ style="border: 2px solid #036eb5;" required="" placeholder="Bid Amount">
     </div>

      </div>
      <div class="modal-footer">

        <div id="loaderbs4" style="display:none;" >
      
      Please Wait.....!&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
       <div class="spinner-grow text-warning"> </div>
       <div class="spinner-grow text-warning"></div>
      <div class="spinner-grow text-warning"></div>
   
        </div> 


        <div id="areyouSure">
        <button type="button" class="btn btn-secondary btn-sm shadow-lg border-0" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm shadow-lg border-0 SubMitBidGo">Submit</button>
      </div>

      </form>
      </div>
    </div>
  </div>
</div>  

<?php
}



public function BidBoardNotBiddingUpcoming($post_ac_id='',$post_ac_Item_id='',$bidStartPrice='' ,$startDate='',$endDate='')

{



$auctionItem=AuctionItem::where('id',$post_ac_Item_id)->where('status','on')->where('is_softdel','no')->first();

  ?>





<div class="shadow-sm bg-white rounded">
  <div class="content-box">
  <h3 class="text-capitalize pb-0 font-weight-bold">BID BOARD</h3>
  <div class="row mt-3">
  <div class="col-lg-6">
   <h5 class="text-capitalize text-dark font-weight-bold"><span class="fa fa-gavel"></span>Start PRICE
  </h5>
  </div>
  <div class="col-lg-6">
  <p class="text-danger font-weight-bold float-right" style="font-size: 18px;">$<?php echo $bidStartPrice;?></p>
  </div>
  </div>

 
  <hr>

  <div class="tab-outter">
   
  <h4 class="text-center font-weight-bolder bg-warning rounded shadow-lg p-3">  Bidding Start On  Date <br> !
 <div class="col-lg-12 text-center">
        <p id="countDownTimer" class="text-danger font-weight-bolder"> </p>
      </div>
  </h4>

<?php
if (Auth::check()) {
 
}else{

echo ' <a href="/login" class="btn-danger btn btn-block shadow-lg border-0 mb-4">Login/Register</a>';

}
?>
        
   
  </div>


    <div class="row text-center">

      <ul class="list-group list-group-flush" style="width: 100%;">
 
     <li class="list-group-item text-capitalize" style="font-size: 14px;">Start &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-dark float-right countDownDatetimeval">
       
        <?php echo $this->convertTimeToUSERzone($startDate, Session::get('ClientTimezone'), $format = 'd M Y, h:i:s A');?>
     </span></li>
    
   </ul>
  </div>
    </div>
</div>


<?php
}



  public function BidBoardNotBiddingSold($post_ac_id='',$post_ac_Item_id='',$bidStartPrice='' ,$startDate='',$endDate='')
{ 
$bidCurrent=Bidding::with('getUser')->where('ac_parent_id',$post_ac_id)->where('ac_parent_child_id',$post_ac_Item_id)->where('status','on')->where('sold','on')->where('win','on')->where('is_softdel','no')->orderBy('amount', 'desc')->first();



$auctionItem=AuctionItem::where('id',$post_ac_Item_id)->where('status','on')->where('is_softdel','no')->first();


$bidCurrentlatest=Bidding::where('ac_parent_child_id',$post_ac_Item_id)->where('status','on')->where('is_softdel','no')->orderBy('amount', 'desc');

 ?> 


 


<div class="shadow-sm bg-white rounded">
  <div class="content-box">
  <h3 class="text-capitalize pb-0 font-weight-bold">BID BOARD</h3>
  <div class="row mt-3">
  <div class="col-lg-6">
   <h5 class="text-capitalize text-dark font-weight-bold"></span>Start PRICE
  </h5>
  </div>
  <div class="col-lg-6">
  <p class="text-danger font-weight-bold float-right" style="font-size: 18px;">$<?php echo $bidStartPrice;?></p>
  </div>

   <div class="col-lg-6">
   <h5 class="text-capitalize text-success font-weight-bold"><span class="fa fa-gavel"></span>Winner 
  </h5>
  </div>
  <div class="col-lg-6">
  <p class="text-success font-weight-bold float-right" style="font-size: 20px;"><?php 

  

  if (!empty($bidCurrent)) {
    $existwiner =$bidCurrent->count();


  if ($existwiner>0) {
    echo '$'.$bidCurrent->amount;
  }else {
    echo "</p class='text-dark'>Pending</p>";
   
  }
  }else {
     $existwiner=0;
       echo "</p class='text-dark'>Pending</p>";
  }
  
  ?></p>
  </div>
<?php

  if ($existwiner>0) {
?>
  <div class="col-lg-6">
   <h5 class=" text-warning font-weight-bold"></span>Sold To
  </h5>
  </div>
  <div class="col-lg-6">
  <p class="text-warning font-weight-bold float-right"><?php

   if (!empty($bidCurrent->getUser->country)) {
     echo $bidCurrent->getUser->country;
   }else{

    echo 'Anonymous ';
   }

  ?></p>
  </div>
<?php } ?>


  </div>

 
  <hr>


    <div class="row text-center">

      <ul class="list-group list-group-flush" style="width: 100%;">
 
     <li class="list-group-item text-capitalize" style="font-size: 14px;">Ended &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-dark float-right ">
 <?php echo $this->convertTimeToUSERzone($endDate, Session::get('ClientTimezone'), $format = 'd M Y, h:i:s A');?>
    </span></li>
     
   </ul>
  </div>

  <div class="tab-outter">
  <h4 class="text-center font-weight-bolder  rounded shadow-lg p-3"> 

   <img src="<?php echo asset('img').'/'.'sold.png';?>" class="img-fluid ">  
  <h4>  
   
  </div>


    </div>
</div>
<div class="shadow-sm bg-white rounded mt-4">
  <div class="content-box">
  <h4 class="text-capitalize pb-0 font-weight-bold text-success">RECENTS BIDS</h4>

    <ul class="list-group list-group-flush">

   <?php

   if (!empty($bidCurrentlatest)) {
     
   
   foreach ($bidCurrentlatest->limit(10)->get() as $bidCurrentvalue) {
     ?>

    <li class="list-group-item "><i class="fa fa-calendar"></i>&nbsp;&nbsp; 

      <?php echo $this->convertTimeToUSERzone($bidCurrentvalue->bdatetime, Session::get('ClientTimezone'), $format = 'd M Y, h:i:s A');?>

     &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger float-right">$<?php echo $bidCurrentvalue->amount;?></span></li>
     <?php
   }
    }
   ?>

  
 
</ul>
   </div>
</div>

<?php
}




public function validateDisplayAcutionDataGlobal($post_ac_id='',$post_ac_Item_id='',$bidStartPrice='' ,$startDate='',$endDate=''){


date_default_timezone_set(session('ClientTimezone'));
$currentdate = $this->addUtc(date('Y-m-d H:i:s'));



$bidCurrent=Bidding::where('ac_parent_id',$post_ac_id)->where('ac_parent_child_id',$post_ac_Item_id)->where('status','on')->where('is_softdel','no')->orderBy('amount', 'desc');


$auctionItem=AuctionItem::where('id',$post_ac_Item_id)->where('is_softdel','no')->first();

$auction=Auction::where('id',$post_ac_id)->where('is_softdel','no')->first();



// Auction Start End Date

$auctionStart_datetime=$auction->start_datetime;

$auctionEnd_datetime=$auction->end_datetime;

$auctionStatus=$auction->status;

// Auction Item Start End Date

$auctionItemStart_datetime=$auctionItem->start_datetime;

$auctionItemEnd_datetime=$auctionItem->end_datetime;

$auctionItemStatus=$auctionItem->status;
// Auction Item Bidding Record

$biddingonacutionItem=$bidCurrent->where('sold','on')->where('win','on')->count();

 


if ($auctionStatus!="off" && $auctionStart_datetime < $auctionEnd_datetime && $auctionEnd_datetime > $currentdate) {


  
if ( $auctionItemStatus!="off" && $auctionItemStart_datetime < $auctionItemEnd_datetime)


 {

 
  if ($auctionItemStart_datetime > $currentdate ) {
    return 'upcoming';
  }elseif ($auctionItemStart_datetime < $currentdate && $auctionItemEnd_datetime > $currentdate ) {
     return 'startbid';
  }else {
     return 'endbid';
  }

 }else {
   return 'endbid';

 }

}else {


  return 'endauctionmain';


}

// end  Auction Start End Date





}


public function getSidebar(){
?>

<aside class="shadow-sm bg-white rounded">
  
  <div  class="tab-outter p-2 ">
   <!--  <button type="" class="btn-primary btn btn-block shadow-lg border-0 mb-4" data-toggle="modal" data-target="#sidebarModalCenter">Filetr</button> -->
    
   
      <div id="dataappendFilter">
        
      </div>
   
  </div>
</aside>
<aside>
  <style>
  .lot-vid ul li {
  list-style-type: none;
  }
  .lot-vid ul {
  padding-left: 0px;
  }
  </style>
</aside>
<!-- Modal -->
<div class="modal fade" id="sidebarModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
       <!-- Default form register -->
<form class="text-center border border-light p-2" action="#!">

  

    <div class="form-row ">
        <div class="col-sm-4 p-1">
            <!-- First name -->
         <div class="form-group"><label for="username"><strong>Auctions</strong></label>
           <select name="" class=" form-control" name="auctionsRun" id="auctionsRun">
            
              <option value="on" selected> Running Acutions</option>
              <option value="off" > Ended Acutions</option>
             option
           </select>
        </div>
        </div>
        <div class="col-sm-4 p-1">
            <!-- Last name -->
             <div class="form-group"><label for="username"><strong>From Date</strong></label>
           <input type="text" name="" class="form-control" id="date_timepicker_start_filter" placeholder="____-__-__ __:__:__">
        </div>
        </div>

         <div class="col-sm-4 p-1">
            <div class="form-group"><label for="username"><strong>To Date</strong></label>
           <input type="text" name="" class="form-control" id="date_timepicker_end_filter" placeholder="____-__-__ __:__:__">
        </div>
        </div>
    </div>

   <div class="form-row ">
       <div class="wrapper" style="width:100%;" >

<div class="range-slider">
    <input type="text" class="js-range-slider" value="" />
</div>
    
<div class="extra-controls form-inline" >
  <div class="form-group">
    <input type="number" name="start_price" id="start_price" class="js-input-from form-control" value="0" any />
    <input type="number" name="end_price" id="end_price" class="js-input-to form-control" value="0" any />
   </div>

  </div> 
  

 <button type="button" class="btn btn-secondary btn-sm shadow-sm border-0" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm shadow-sm border-0" id="SidebarfilterGo">Filter</button>
</div>
</div>
 
    
    </div>

</form>
<!-- Default form register -->
      </div>
   
    </div>
  </div>
</div>
<style type="text/css">
  
  /* Ion.RangeSlider
// css version 2.0.3
// Â© 2013-2014 Denis Ineshin | IonDen.com
// ===================================================================================================================*/

/* =====================================================================================================================
// RangeSlider */

.irs {
    position: relative; display: block;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
     -khtml-user-select: none;
       -moz-user-select: none;
        -ms-user-select: none;
            user-select: none;
}
    .irs-line {
        position: relative; display: block;
        overflow: hidden;
        outline: none !important;
    }
        .irs-line-left, .irs-line-mid, .irs-line-right {
            position: absolute; display: block;
            top: 0;
        }
        .irs-line-left {
            left: 0; width: 11%;
        }
        .irs-line-mid {
            left: 9%; width: 82%;
        }
        .irs-line-right {
            right: 0; width: 11%;
        }

    .irs-bar {
        position: absolute; display: block;
        left: 0; width: 0;
    }
        .irs-bar-edge {
            position: absolute; display: block;
            top: 0; left: 0;
        }

    .irs-shadow {
        position: absolute; display: none;
        left: 0; width: 0;
    }

    .irs-slider {
        position: absolute; display: block;
        cursor: default;
        z-index: 1;
    }
        .irs-slider.single {

        }
        .irs-slider.from {

        }
        .irs-slider.to {

        }
        .irs-slider.type_last {
            z-index: 2;
        }

    .irs-min {
        position: absolute; display: block;
        left: 0;
        cursor: default;
    }
    .irs-max {
        position: absolute; display: block;
        right: 0;
        cursor: default;
    }

    .irs-from, .irs-to, .irs-single {
        position: absolute; display: block;
        top: 0; left: 0;
        cursor: default;
        white-space: nowrap;
    }

.irs-grid {
    position: absolute; display: none;
    bottom: 0; left: 0;
    width: 100%; height: 20px;
}
.irs-with-grid .irs-grid {
    display: block;
}
    .irs-grid-pol {
        position: absolute;
        top: 0; left: 0;
        width: 1px; height: 8px;
        background: #000;
    }
    .irs-grid-pol.small {
        height: 4px;
    }
    .irs-grid-text {
        position: absolute;
        bottom: 0; left: 0;
        white-space: nowrap;
        text-align: center;
        font-size: 9px; line-height: 9px;
        padding: 0 3px;
        color: #000;
    }

.irs-disable-mask {
    position: absolute; display: block;
    top: 0; left: -1%;
    width: 102%; height: 100%;
    cursor: default;
    background: rgba(0,0,0,0.0);
    z-index: 2;
}
.lt-ie9 .irs-disable-mask {
    background: #000;
    filter: alpha(opacity=0);
    cursor: not-allowed;
}

.irs-disabled {
    opacity: 0.4;
}


.irs-hidden-input {
    position: absolute !important;
    display: block !important;
    top: 0 !important;
    left: 0 !important;
    width: 0 !important;
    height: 0 !important;
    font-size: 0 !important;
    line-height: 0 !important;
    padding: 0 !important;
    margin: 0 !important;
    outline: none !important;
    z-index: -9999 !important;
    background: none !important;
    border-style: solid !important;
    border-color: transparent !important;
}


/* Ion.RangeSlider, Simple Skin
// css version 2.0.3
// Â© Denis Ineshin, 2014    https://github.com/IonDen
// Â© guybowden, 2014        https://github.com/guybowden
// ===================================================================================================================*/

/* =====================================================================================================================
// Skin details */

.irs {
    height: 55px;
}
.irs-with-grid {
    height: 75px;
}
.irs-line {
    height: 10px; top: 33px;
    background: #EEE;
    background: linear-gradient(to bottom, #DDD -50%, #FFF 150%); /* W3C */
    border: 1px solid #CCC;
    border-radius: 16px;
    -moz-border-radius: 16px;
}
    .irs-line-left {
        height: 8px;
    }
    .irs-line-mid {
        height: 8px;
    }
    .irs-line-right {
        height: 8px;
    }

.irs-bar {
    height: 10px; top: 33px;
    border-top: 1px solid #428bca;
    border-bottom: 1px solid #428bca;
    background: #428bca;
    background: linear-gradient(to top, rgba(66,139,202,1) 0%,rgba(127,195,232,1) 100%); /* W3C */
}
    .irs-bar-edge {
        height: 10px; top: 33px;
        width: 14px;
        border: 1px solid #428bca;
        border-right: 0;
        background: #428bca;
        background: linear-gradient(to top, rgba(66,139,202,1) 0%,rgba(127,195,232,1) 100%); /* W3C */
        border-radius: 16px 0 0 16px;
        -moz-border-radius: 16px 0 0 16px;
    }

.irs-shadow {
    height: 2px; top: 38px;
    background: #000;
    opacity: 0.3;
    border-radius: 5px;
    -moz-border-radius: 5px;
}
.lt-ie9 .irs-shadow {
    filter: alpha(opacity=30);
}

.irs-slider {
    top: 25px;
    width: 27px; height: 27px;
    border: 1px solid #AAA;
    background: #DDD;
    background: linear-gradient(to bottom, rgba(255,255,255,1) 0%,rgba(220,220,220,1) 20%,rgba(255,255,255,1) 100%); /* W3C */
    border-radius: 27px;
    -moz-border-radius: 27px;
    box-shadow: 1px 1px 3px rgba(0,0,0,0.3);
    cursor: pointer;
}

.irs-slider.state_hover, .irs-slider:hover {
    background: #FFF;
}

.irs-min, .irs-max {
    color: #333;
    font-size: 12px; line-height: 1.333;
    text-shadow: none;
    top: 0;
    padding: 1px 5px;
    background: rgba(0,0,0,0.1);
    border-radius: 3px;
    -moz-border-radius: 3px;
}

.lt-ie9 .irs-min, .lt-ie9 .irs-max {
    background: #ccc;
}

.irs-from, .irs-to, .irs-single {
    color: #fff;
    font-size: 14px; line-height: 1.333;
    text-shadow: none;
    padding: 1px 5px;
    background: #428bca;
    border-radius: 3px;
    -moz-border-radius: 3px;
}
.lt-ie9 .irs-from, .lt-ie9 .irs-to, .lt-ie9 .irs-single {
    background: #999;
}

.irs-grid {
    height: 27px;
}
.irs-grid-pol {
    opacity: 0.5;
    background: #428bca;
}
.irs-grid-pol.small {
    background: #999;
}

.irs-grid-text {
    bottom: 5px;
    color: #99a4ac;
}

.irs-disabled {
}
</style>
<?php
}

public function get_Post_Meta_value($post_id='',$field_type='',$meta_key='',$post_type='',$status=''){

  if (!empty($post_id)) {
  $returnData=PostMeta::where('post_id',$post_id);

if (!empty($field_type)) {
$returnData->where('field_type',$field_type);
}
if (!empty($meta_key)) {
  $returnData->where('meta_key',$meta_key);
}
if (!empty($post_type)) {
  $returnData->where('post_type',$post_type);
}
if (!empty($status)) {
  $returnData->where('status',$status);
}

if (empty($returnData->first())) {
  return false;
}else {
  $val=$returnData->first();
  return $val->meta_value;
}

  }else {
    return false;
  }
}
public function Image_exist($img){
  if (!empty($img)){
echo ' <img src="'.asset("img").'/'.$img.'" alt="" class="img-thumbnail img-fluid mt-2" width="150" height="150">';
  }else{
echo '<img src="'.asset("img").'/'.'no-preview-available.png" alt="" class="img-thumbnail img-fluid mt-2" width="150" height="150">';
}
}



function ItemBiddinCount($postIdItem){
   
 
   return Bidding::where('ac_parent_child_id',$postIdItem)->where('status','on')->where('is_softdel','no')->count();
}


function ItemBiddinCurrent($postIdItemcurent){

return Bidding::with('getUser')->where('ac_parent_child_id',$postIdItemcurent)->where('status','on')->where('is_softdel','no')->orderBy('amount', 'desc')->first();
}

function convertTimeToUSERzone($str, $userTimezone, $format = 'Y-m-d H:i:s'){
    if(empty($str)){
        return '';
    }
        
    $new_str = new DateTime($str, new DateTimeZone('UTC') );
    $new_str->setTimeZone(new DateTimeZone( $userTimezone ));
    return $new_str->format($format);
}

public function GetCilentDatetime($datetimeCli){



// echo  $datetimeCli;
//  $userTimezone=Session::get('ClientTimezone');

// return Carbon::parse($datetimeCli)->timezone($userTimezone);





 


 

 

//format the datetime

$dt = Carbon::parse($datetimeCli)->timezone(Session::get('ClientTimezone'));


$toDay = $dt->format('d');
$toMonth = $dt->format('m');
$toYear = $dt->format('Y');
$dateUTC = Carbon::createFromDate($toYear, $toMonth, $toDay, 'UTC');
 $datePST = Carbon::createFromDate($toYear, $toMonth, $toDay,Session::get('ClientTimezone'));
 $difference = $dateUTC->diffInHours($datePST);

return $date = $dt->addHours($difference);



// $input='';
// return $input.='<input type="hidden" class="originalDateTimeCilentFormate" name="originalDateTimeCilentFormate" value="'.$date.'">'.$date->format('d F Y, h:i:s');

}
public function AllUserShow()
  {
    
    $allpost=User::all();
$temp='<option value="'. Auth::user()->id.'" selected>'. Auth::user()->name.'</option>';
    foreach ($allpost as $value) {
      $temp.=' <option value="'.$value->id.'">'.$value->name.'('.$value->email.')</option>';
    }
    echo' <div class="form-group">
  <div class="form-group"><label for="author"><strong>User (Author)*</strong></label>
  <select name="author" class="form-control post_type" id="author" required="">
    '.$temp.'
  </select></div></div>';
    }
  public function UserAlreadySelected($user_id)
    {
      
  
      //   if (empty($user_id) || $user_id==1) {
          //      echo $temp=' <div class="form-group">
    //       <div class="form-group"><label for="author"><strong>User (Author)*</strong></label>
    //       <select name="author" class="form-control author" id="author"  readonly><option value="'. Auth::user()->id.'" selected>'. Auth::user()->name.'</option> </select>
      // </div>
      // <div>';
        //   }else {
          
        
        $allpost=User::all();
    ?>
    <div class="form-group">
      <div class="form-group"><label for="author"><strong>User (Author)*</strong></label>
      <select name="author" class="form-control author" id="author"  readonly>
        
        <?php
            foreach ($allpost as $value) {
        if ($value->id!=1) {
          
          echo $temp='<option value="'. Auth::user()->id.'" selected>'. Auth::user()->name.'</option>';
        }
        ?>
        <option value="<?php echo $value->id; ?>"<?php  echo ($value->id==$user_id)  ? "selected" : "";  ?>><?php echo $value->name; ?>(<?php echo $value->email; ?>)</option>
        <?php
            }
        ?>
      </select>
    </div>
    <div>
      
      <?php
          // }
        }
      public function PostTypeAlreadySelected($postype)
        {
          
          $allpost=Post::all();
      ?>
      <div class="form-group">
        <div class="form-group"><label for="post_type"><strong>Post Type</strong></label>
        <select name="post_type" class="form-control post_type" id="post_type"  readonly>
          
          <?php
              foreach ($allpost as $value) {
          ?>
          <option value="<?php echo $value->post_type; ?>"<?php  echo ($value->post_type==$postype)  ? "selected" : "";  ?>><?php echo $value->post_type; ?></option>
          <?php
              }
          ?>
        </select>
      </div>
      <div>
        
        <?php
            
          }
        public function PostType($label='')
          {
          if (empty($label)) {
              echo ' <div class="form-group">
          <div class="form-group"><label for="post_type"><strong>Post Type</strong></label>';
              }
              $allpost=Post::all();
          $temp='';
              foreach ($allpost as $value) {
                $temp.=' <option value="'.$value->post_type.'">'.$value->post_type.'</option>';
              }
          echo'<select name="post_type" class="form-control post_type" id="post_type" required="">
            '.$temp.'
          </select>';
          if (empty($label)) {
              echo '</div></div>';
            }
          }
          public function addUtc($dateTime)
          {
        $date = Carbon::createFromFormat('Y-m-d H:i:s',$dateTime, Session::get('ClientTimezone'));
        $date->setTimezone('UTC');
        // $hh=Timezone::convertToUTC($dateTime, $timezone, $format);
        //  dd($hh);
            // $dt = Carbon::parse($dateTime)->setTimezone('UTC');
            
            // $toDay = $dt->format('d');
            // $toMonth = $dt->format('m');
            // $toYear = $dt->format('Y');
            // $time=$dt->format('');
            //  $dateUTC = Carbon::createFromDate($toYear, $toMonth, $toDay, 'UTC');
            return $date;
          }
        public function insertCustomFields_meta($post_type='', $post_id='',$request=''){
        
        $fields=CustomField::where('post_type',$post_type)->where('status','on')->where('is_softdel','no')->get();
        
        if(isset($fields) && !empty($fields)){
        $requestArray= $request->all();
        
        foreach ($fields as $field) {
          $slugpas=$field->slug;
          $field_type=$field->field_type;
        $fieldVal=$request->$slugpas;
        if ($field_type=='file') {
          if ($request->hasfile($slugpas))
        {
          $image = $request->file($slugpas);
        $nameimg = time(). uniqid().'.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/img/');
        $image->move($destinationPath, $nameimg);
        
        }else {
          $nameimg='';
        }
        PostMeta::create(['post_id'=>$post_id,'meta_key'=>$slugpas,'meta_value'=>$nameimg,'post_type'=>$post_type,'field_type'=>$field_type]);
        }else{
        PostMeta::create(['post_id'=>$post_id,'meta_key'=>$slugpas,'meta_value'=>$fieldVal,'post_type'=>$post_type,'field_type'=>$field_type]);
        }
        
        }
        }else {
          
        return false;
        }
        }
        public function UpdateCustomFields_meta($post_type='', $post_id='',$request=''){
        
        
        $fields=CustomField::where('post_type',$post_type)->where('status','on')->where('is_softdel','no')->get();
        
        
        if(isset($fields) && !empty($fields)){
        $aa=[];
        
        foreach ($fields as $field) {



          $slugpas=$field->slug;
        
          $field_type=$field->field_type;
        $fieldVal=$request->$slugpas;

      $updateCheck=PostMeta::where('post_id',$post_id)->where('post_type',$post_type)->where('field_type',$field_type)->where('meta_key',$slugpas)->count();
 

        
    if ($updateCheck>0) {
   

        if ($field_type=='file') {
          $hiddenfile='hidden_'.$slugpas;
        $nameimg=$request->$hiddenfile;
          if ($request->hasfile($slugpas))
        {
          $image = $request->file($slugpas);
        $nameimg =time(). uniqid().'.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/img/');
        $image->move($destinationPath, $nameimg);
        
        }
        $update=PostMeta::where('post_id',$post_id)->where('post_type',$post_type)->where('field_type',$field_type)->where('meta_key',$slugpas);
        $update->update(['meta_value'=>$nameimg,'post_type'=>$post_type]);
        }else {
          
          $update=PostMeta::where('post_id',$post_id)->where('post_type',$post_type)->where('field_type',$field_type)->where('meta_key',$slugpas);
        $update->update(['meta_value'=>$fieldVal,'post_type'=>$post_type]);
        }
        //$aa[]= $fieldVal;
        
        
       }else{

         if ($field_type=='file') {
          if ($request->hasfile($slugpas))
        {
        $image = $request->file($slugpas);
        $nameimg = time(). uniqid().'.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/img/');
        $image->move($destinationPath, $nameimg);
        
        }else {
          $nameimg='';
        }
        PostMeta::create(['post_id'=>$post_id,'meta_key'=>$slugpas,'meta_value'=>$nameimg,'post_type'=>$post_type,'field_type'=>$field_type]);
        }else{
        PostMeta::create(['post_id'=>$post_id,'meta_key'=>$slugpas,'meta_value'=>$fieldVal,'post_type'=>$post_type,'field_type'=>$field_type]);
        }

       }


        
        }
        
        // dd($aa);
        }else {
          
        return false;
        }
        }
        
        public function editCustomFields($post_type='',$post_id=''){
        $fields=CustomField::where('post_type',$post_type)->where('status','on')->where('is_softdel','no')->get();
        
        if(isset($fields) && !empty($fields)){
        $returnFields='<div class="form-row">';
          foreach ($fields as $field) {
          
          
          if ($field->field_type=='text') {
          
          $returnFields.='<div class="col-sm-6"><div class="form-group"><label for="username"><strong>'.$field->name.'</strong></label>
          <input class="form-control '.$field->css_class.'" type="'.$field->field_type.'" placeholder="'.$field->placeholder.'" name="'.$field->slug.'"  id="'.$field->css_id.'" '.$field->required.' value="'.$this->get_Post_Meta_value($post_id,$field->field_type,$field->slug,$post_type,$status='on').'">
        </div></div>';
        }elseif ($field->field_type=='textarea') {
          $returnFields.='<div class="col-sm-6"><div class="form-group"><label for="username"><strong>'.$field->name.'</strong></label>
        <textarea id="'.$field->css_id.'" name="'.$field->slug.'" rows="4" cols="50"  placeholder="'.$field->placeholder.'" class="form-control '.$field->css_class.'" '.$field->required.'>'.$this->get_Post_Meta_value($post_id,$field->field_type,$field->slug,$post_type,$status='on').'</textarea>
      </div></div>';
      }elseif ($field->field_type=='isridden') {
        $returnFields.='<div class="col-sm-6"><div class="form-group"><label for="username"><strong>'.$field->name.'</strong></label>
      <select name="'.$field->slug.'" class="form-control '.$field->css_class.'" id="'.$field->css_id.'" '.$field->required.'> 
        <option value="yes"'. ($this->get_Post_Meta_value($post_id,$field->field_type,$field->slug,$post_type,$status='on') == 'yes' ? 'selected' : '').'>Yes</option>
        <option value="no" '. ($this->get_Post_Meta_value($post_id,$field->field_type,$field->slug,$post_type,$status='on') == 'no' ? 'selected' : '').'>No</option>
      </select>
    </div></div>';
    
    }elseif ($field->field_type=='gender') {
        $returnFields.='<div class="col-sm-6"><div class="form-group"><label for="username"><strong>'.$field->name.'</strong></label>
      <select name="'.$field->slug.'" class="form-control '.$field->css_class.'" id="'.$field->css_id.'" '.$field->required.'>
        <option value="male"'. ($this->get_Post_Meta_value($post_id,$field->field_type,$field->slug,$post_type,$status='on') == 'male' ? 'selected' : '').'>Male</option>
        <option value="female" '. ($this->get_Post_Meta_value($post_id,$field->field_type,$field->slug,$post_type,$status='on') == 'female' ? 'selected' : '').'>Female</option>
      </select>
    </div></div>';
    
    }elseif ($field->field_type=='file') {
      $returnFields.='<div class="col-sm-6"><div class="form-group"><label for="username"><strong>'.$field->name.'</strong></label>
    <input class="form-control '.$field->css_class.'" type="'.$field->field_type.'" placeholder="'.$field->placeholder.'" name="'.$field->slug.'"  id="'.$field->css_id.'" '.$field->required.'>
    <input type="hidden" name="hidden_'.$field->slug.'" value="'.$this->get_Post_Meta_value($post_id,$field->field_type,$field->slug,$post_type,$status='on').'">
    <p>'.asset('img').'/'.$this->get_Post_Meta_value($post_id,$field->field_type,$field->slug,$post_type,$status='on').'</p>
  </div></div>';
  }elseif ($field->field_type=='email') {
    $returnFields.='<div class="col-sm-6"><div class="form-group"><label for="username"><strong>'.$field->name.'</strong></label>
  <input class="form-control '.$field->css_class.'" type="'.$field->field_type.'" placeholder="'.$field->placeholder.'" name="'.$field->slug.'"  id="'.$field->css_id.'" '.$field->required.' value="'.$this->get_Post_Meta_value($post_id,$field->field_type,$field->slug,$post_type,$status='on').'"></div></div>';
  }elseif ($field->field_type=='number') {
    
    $returnFields.='<div class="col-sm-6"><div class="form-group"><label for="username"><strong>'.$field->name.'</strong></label>
  <input class="form-control '.$field->css_class.'" type="'.$field->field_type.'" placeholder="'.$field->placeholder.'" name="'.$field->slug.'"  id="'.$field->css_id.'" min="0" step="any" '.$field->required.' value="'.$this->get_Post_Meta_value($post_id,$field->field_type,$field->slug,$post_type,$status='on').'">
</div></div>';
}else{
  $returnFields.='Not Assign Custom Fields yet this post type...';
}
  
}

return  $returnFields.='</div>';
}


  }
  public function addCustomFields($post_type=''){
$fields=CustomField::where('post_type',$post_type)->where('status','on')->where('is_softdel','no')->get();

if(isset($fields) && !empty($fields)){
$returnFields='<div class="form-row">';
foreach ($fields as $field) {

if ($field->field_type=='text') {

$returnFields.='<div class="col-sm-6"><div class="form-group"><label for="username"><strong>'.$field->name.'</strong></label>
<input class="form-control '.$field->css_class.'" type="'.$field->field_type.'" placeholder="'.$field->placeholder.'" name="'.$field->slug.'"  id="'.$field->css_id.'" '.$field->required.'>
</div></div>';
}elseif ($field->field_type=='textarea') {
  $returnFields.='<div class="col-sm-6"><div class="form-group"><label for="username"><strong>'.$field->name.'</strong></label>
<textarea id="'.$field->css_id.'" name="'.$field->slug.'" rows="4" cols="50"  placeholder="'.$field->placeholder.'" class="form-control '.$field->css_class.'" '.$field->required.'>

</textarea>
</div></div>';
}elseif ($field->field_type=='isridden'){
$returnFields.='<div class="col-sm-6"><div class="form-group"><label for="username"><strong>'.$field->name.'</strong></label>
<select name="'.$field->slug.'" class="form-control '.$field->css_class.'" id="'.$field->css_id.'" '.$field->required.'>
<option value="yes">Yes</option>
<option value="no">No</option>

</select>
</div></div>';
}elseif ($field->field_type=='gender') {
  $returnFields.='<div class="col-sm-6"><div class="form-group"><label for="username"><strong>'.$field->name.'</strong></label>
<select name="'.$field->slug.'" class="form-control '.$field->css_class.'" id="'.$field->css_id.'" '.$field->required.'>
<option value="male">Male</option>
<option value="female">Female</option>

</select>
</div></div>';

}elseif ($field->field_type=='file') {
  $returnFields.='<div class="col-sm-6"><div class="form-group"><label for="username"><strong>'.$field->name.'</strong></label>
<input class="form-control '.$field->css_class.'" type="'.$field->field_type.'" placeholder="'.$field->placeholder.'" name="'.$field->slug.'"  id="'.$field->css_id.'" '.$field->required.'></div></div>';
}elseif ($field->field_type=='email') {
  $returnFields.='<div class="col-sm-6"><div class="form-group"><label for="username"><strong>'.$field->name.'</strong></label>
<input class="form-control '.$field->css_class.'" type="'.$field->field_type.'" placeholder="'.$field->placeholder.'" name="'.$field->slug.'"  id="'.$field->css_id.'" '.$field->required.'></div></div>';
}elseif ($field->field_type=='number') {
  
  $returnFields.='<div class="col-sm-6"><div class="form-group"><label for="username"><strong>'.$field->name.'</strong></label>
<input class="form-control '.$field->css_class.'" type="'.$field->field_type.'" placeholder="'.$field->placeholder.'" name="'.$field->slug.'"  id="'.$field->css_id.'" min="0" step="any" '.$field->required.'>
</div></div>';
}else{
  $returnFields.='Not Assign Custom Fields yet this post type...';
}
  
}

return  $returnFields.='</div>';
}
  }
  public function getauthorities()
  {
    $user = User::find(\Auth::user()->id);
    $authority = rolesauthority::where('role_id', $user->role_id)->first();
    if ($authority != null) {
      $authority->authority = unserialize($authority->authority);
      $authority->selected_ids = unserialize($authority->selected_ids);
    }
    return $authority;
  }
  public function getVendorAuthorities($value = '')
  {
  // return Auth::user()->role_id;
    // if(\Auth::user()->type != 'superadmin'){
      //  $role_id = \Auth::user()->role_id;
    //     $roles = rolesauthority::where('role_id',2)->first();
    //     $roles->authority = unserialize($roles->authority);
    // }
    $data = array();
    /* arrays of all menu's in future these menu's will come from database*/
                                                              $empreporting = array("Empolye Reporting");
    $usermanagement = array("User management");
    $applicants = array("Applicants");
    $shortlisting = array("Shortlisting");
    $allshortlisted = array("All Shortlisted");
    $securityclearance = array("Security Clearance", "All Selected Applicants", "Security Clearance Events");
    $saleInfo = array("Add Receipt", "Receipt Ledger", "Receipt Receivable", "Direct Out");
    $allsecuritycleared = array("All Security Cleared", "Add Designation", "All Security Cleared / Contracts", "Employment / Joining Form");
    $clients = array("Clients", "Clients Registration", "Clients Contracts", "Deployement Type");
    $accountInfo = array("Accounts", "Cash Deposit", "Accounts Ledger", "Financial Year");
    $expenditure = array("Heads", "Months");
    $dashboard = array("Dashboard");
    /*check id user is superadmin then all menus show*/
    if (\Auth::user()->type != 'superadmin') {
      /*js tree json parent*/
                                                                                              $data[0]["text"] = "Empolye Reporting";
      /*js tree json child*/
                                                                                              $data[0]["children"] = $empreporting;
      $data[1]["text"] = "User management";
      $data[1]["children"] = $usermanagement;
      $data[2]["text"] = "Applicants";
      $data[2]["children"] = $applicants;
      $data[3]["text"] = "Shortlisting";
      $data[3]["children"] = $shortlisting;
      $data[4]["text"] = "All Shortlisted";
      $data[4]["children"] = $allshortlisted;
      $data[5]["text"] = "Security Clearance";
      $data[5]["children"] = $securityclearance;
      $data[6]["text"] = "All Security Cleared";
      $data[6]["children"] = $allsecuritycleared;
      $data[7]["text"] = "Clients";
      $data[7]["children"] = $clients;
      $data[8]["text"] = "Dashboard";
    } else {
    // define all parent menu also define its childs empty array
      $data[0]["text"] = "Item Info";
      $data[0]["children"] = [];
      $data[1]["text"] = "Voucher Info";
      $data[1]["children"] = [];
      $data[2]["text"] = "Sale Info";
      $data[2]["children"] = [];
      $data[3]["text"] = "Customer";
      $data[3]["children"] = [];
      $data[4]["text"] = "Payment Info";
      $data[4]["children"] = [];
      $data[5]["text"] = "Account Info";
      $data[5]["children"] = [];
      $data[6]["text"] = "Expenditure";
      $data[6]["children"] = [];
      $data[7]["text"] = "Expenditure2";
      $data[7]["children"] = [];
    }
  // if(\Auth::user()->type != 'superadmin'){
    //  /*all authority coming from database*/
    //  foreach ($roles->authority as $key => $role) {
      //    /*check that role is realted to which menu and push it in its parent*/
    //      if(in_array($role, $empreporting)){
    //          array_push($data[0]["children"],["text"=>$role]);
    //      }
    //      if(in_array($role, $usermanagement)){
    //          array_push($data[1]["children"],["text"=>$role]);
    //      }
    //      if(in_array($role, $applicants)){
    //          array_push($data[2]["children"],["text"=>$role]);
    //      }
    //      if(in_array($role, $shortlisting)){
    //          array_push($data[3]["children"],["text"=>$role]);
    //      }
    //      if(in_array($role,  $allshortlisted)){
    //          array_push($data[4]["children"],["text"=>$role]);
    //      }
    //      if(in_array($role, $securityclearance)){
    //         array_push($data[5]["children"],["text"=>$role]);
    //      }
    //      if(in_array($role, $allsecuritycleared)){
    //         array_push($data[6]["children"],["text"=>$role]);
    //      }
    //       if(in_array($role, $clients)){
    //         array_push($data[7]["children"],["text"=>$role]);
    //      }
    //      // if(in_array($role, $usermanagement)){
    //      //    $data[7]["text"] = "User management";
    //      // }
    //      if(in_array($role, $dashboard)){
    //         $data[8]["text"] = "Dashboard";
    //      }
    //  }
  // }
    /*data variable is the js tree json*/
                                                              return $data;
  }
}