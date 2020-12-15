{{-- extend  --}}
@extends('front-end-layout.app')
@extends('includes-frontend.header')
@extends('includes-frontend.footer')
{{-- page titles --}}
@section('title', 'Home')
@section('content')  
<main role="main">
   <div class="container p-0">
     

    {{--   <div class="auction-item-7 time p-0 mb-4 ">
      <div class="auction-inner ">
        <a href="{{ route('single-auction',['id'=>Crypt::encrypt($auction->id),'post_type'=>Crypt::encrypt($auction->post_type)]) }}" class="upcoming-badge-2" title="Upcoming Auction" style=" background:{{ ($auction->status == 'on') ? '#43B055' : 'rgb(150, 43, 37)' }}">
          <i class="fa fa-gavel"></i>
        </a>
        
        <div class=" col-sm-12 col-md-6 col-lg-6 auction-thumb bg_img mh-100" style="background-image: url({{ asset('/img') }}/{{$auction->featured_img }}" >
          
          
          
        </div>
        <div class=" col-sm-12 col-md-6 col-lg-6  p-3  align-items-center mx-auto" style="height: 300px; background-color:{{ ($auction->status == 'on') ? '#036EB5' : 'rgb(150, 43, 37)' }}">
          
          <span class="bid-title text-white text-center " style="display: block;">Auction Start <i class="fa fa-clock"></i></span>
          <div>
            <div  class="font-weight-light text-warning text-center">  @php
              echo CH::GetCilentDatetime($auction->start_datetime)->format('d M Y, h:i:s A');
            @endphp</div>
          </div>
          <span class="bid-title text-white text-center" style="display: block;">Auction ends <i class="fa fa-clock"></i></span>
          <div >
            <div class="font-weight-light text-warning text-center">  @php
              echo CH::GetCilentDatetime($auction->end_datetime)->format('d M Y, h:i:s A');
            @endphp</div>
          </div>
          
          
          <div class="text-center mt-2" >
            <label class="custom-button " style=" background:{{ ($auction->status == 'on') ? '#43B055' : 'rgb(150, 43, 37)' }}">  {{ ($auction->status == 'on') ? 'Runing Auction' : ' Ended Auction' }}</label>
            
          </div>
          @if (!empty($auction->org_name))
          <p class="text-white m-0 text-center  font-weight-light" style="font-size: 11px;"> {{ $auction->org_name }}</p>
          @else
          <p class="text-white"> </p>
          @endif
          @if (!empty($auction->org))
          <img class="text-center  img-fluid" src="{{ asset('/img') }}/{{$auction->org }}" height="40" style="display: block;
          margin-left: auto;
          margin-right: auto;
          width: 50%;
          margin-top: 10px;">
          @else
          <img class="text-center  img-fluid" src="{{ asset('/img') }}/no-preview-available.png" height="40" style="display: block;
          margin-left: auto;
          margin-right: auto;
          width: 50%;
          margin-top: 10px;">
          @endif
          
        </div>
        <div class="row ">
          <div class="col-sm-12 mx-auto">
            
            <div  class="content-box description-btn">
              <h5 class="font-weight-bolder">{{ $auction->title }} <code>/</code> {{ $auctionItem->title }} </h5>
            
             
            </div>
            
          </div>
          
        </div>
        
      </div>
    </div> --}}
      <div class="row">
         <div class="col-lg-8 shadow-sm p-3  bg-white rounded">
        
            <section id="lot-detail-content">
               <div class="row">
                  <div class="col-6">
                  <a href="{{ route('single-auction',['id'=>Crypt::encrypt($auction->id),'post_type'=>Crypt::encrypt($auction->post_type)]) }}" class="btn-success btn-sm border-0 shadow-lg"> Auction List</a>

                
                  </div>
                  <div class="col-6 text-right">
                     <div class="white-btn left-arrow">
                        <h6>
                           <a href="{{ route('single-auction',['id'=>Crypt::encrypt($auction->id),'post_type'=>Crypt::encrypt($auction->post_type)]) }}">
                           Lot {{ $auctionItem->id }}
                           </a>
                        </h6>
                     </div>
                  
                  </div>
               </div>
               <div class="lot-header">
                  <div class="row">
                     <div class="col-md-9">
                        <div class="lot-header-inner horse-wrap">
                           <div class="lot-number">{{ $auctionItem->id }}</div>
                           <div class="lot-summury">
                              <h2>{{ $auctionItem->title }}</h2>
                              <h6></h6>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3 text-right">
                      @if(Auth::user())
                  <div id="wishlist" class="share-wrap" item_Id_acu="{{ $auctionItem->id }}"><a href="#"   class="modal-tab-toggle"><span class="fa fa-heart"></span></a></div>
                   @endif
                        
                        <div class="share-wrap">
                           <a href="" target="_blank">
                           <span class="fa fa-facebook"></span>
                           </a>
                        </div>
                        <div class="share-wrap">
                           <a href="" target="_blank">
                           <span class="fa fa-twitter"></span>  
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="img-gallery m-0 white-bg side-thumb">
                  <div class="lSSlideOuter">
                     <div class="lSSlideWrapper usingCss">
                        <ul id="lot-gallery" data-thumbnails="side" class="lightSlider lsGrab lSSlide" style="width: 1740px; height: 580px; padding-bottom: 0%; transform: translate3d(0px, 0px, 0px);">
                           <!-- data-thumb = thumbnail; <img> = big image; data-src = big image -->
                          @if (!empty($auctionItem->gallery) && isset($auctionItem->gallery))
                             {{-- expr --}}
                        

                           <li class="lslide active" style="width: 580px; margin-right: 0px;">
                             
                              <img class="mainImage" src="{{ asset('/img') }}/{{explode(',', $auctionItem->gallery)[0] }}">
                             
                              <div class="caption">
                                 <h4>
                                 {{ $auctionItem->title }}
                                 </h4>
                                 <p>
                                 </p>
                              </div>
                           </li>
                          
                         
                        </ul>
                     </div>
                     <ul class="lSPager lSGallery" style="margin-top: 5px; transition-duration: 400ms; width: 251.214px; transform: translate3d(0px, 0px, 0px);">

                        @foreach (explode(',', $auctionItem->gallery) as $element)
                           {{-- expr --}}
                      
                        <li style="width:100%;width:78.57142857142857px;margin-right:5px" class="active"><img  class="subImage" src="{{ asset('/img') }}/{{ $element }}"></li>
                         @endforeach
                     </ul>
                     @else
                     <li class="lslide active" style="width: 580px; margin-right: 0px;">
                             
                              <img class="subImage" src="{{ asset('/img') }}/no-preview-available.png">
                             
                              <div class="caption">
                                 <h4>
                                 {{ $auctionItem->title }}
                                 </h4>
                                 <p>
                                 </p>
                              </div>
                           </li>
                     @endif
                  </div>
               </div>
               <div id="pedigree-view" class="lot-detail content-box">
                  <div class="row block">
                     <div class="col-md-6">
                        <div class="block">
                           <div id="lot-vid" class="video-gallery-wrap">
                              <ul id="video-gallery">
                                @if (!empty($auctionItem->upload_video))
                                  <li >
                                  <video width="320" height="240" controls="">
                                 <source src="{{ asset('videos') }}/{{ $auctionItem->upload_video }}">
                                </video>
                                  </li>
                                 @else

                                {{--  <h3 class="text-danger"> Uploaded Video Not Found</h3> --}}
                                 @endif

                                 @if(!empty($auctionItem->video_link))
                                   <li >
                                 <iframe src="{{ $auctionItem->video_link }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="allowfullscreen" class="auction_trailer_frame" style="width: 100%;"></iframe>
                         
                                   </li>

                                 @else
                              
                               {{--   <h3 class="text-danger">Video Link Not Found</h3> --}}
                                 @endif
                                
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="lot-info-wrap">
                           <div class="lot-info-row">
                              <h5>Gender</h5>
                              <p>   @php
                                       echo CH::get_Post_Meta_value($auctionItem->id,$field_type='gender',$meta_key='gender',$auctionItem->post_type,$status='on');
                                     @endphp

                                  </p>
                           </div>
                           <div class="lot-info-row">
                              <h5>Born</h5>
                              <p>
                                  @php
                                       echo CH::get_Post_Meta_value($auctionItem->id,$field_type='text',$meta_key='born',$auctionItem->post_type,$status='on');
                                     @endphp

                              </p>
                           </div>
                           <div class="lot-info-row">
                              <h5>Life ID</h5>
                              <p>DE 431310686318</p>
                           </div>
                           <div class="lot-info-row">
                              <h5>Breed</h5>
                              <p>
                                 
                                  @php
                                       echo CH::get_Post_Meta_value($auctionItem->id,$field_type='text',$meta_key='breed',$auctionItem->post_type,$status='on');
                                     @endphp

                              </p>
                           </div>
                           <div class="lot-info-row">
                              <h5>Color</h5>
                              <p>
                                 @php
                                       echo CH::get_Post_Meta_value($auctionItem->id,$field_type='text',$meta_key='color',$auctionItem->post_type,$status='on');
                                     @endphp

                                 &nbsp; 
                              </p>
                           </div>
                           <div class="lot-info-row">
                              <h5>Size</h5>
                              <p>
                            @php
                                       echo CH::get_Post_Meta_value($auctionItem->id,$field_type='text',$meta_key='size',$auctionItem->post_type,$status='on');
                                     @endphp

                              </p>
                           </div>
                           <div class="lot-info-row">
                              <h5>Dam By</h5>
                              <p>
                                 
                                  @php
                                       echo CH::get_Post_Meta_value($auctionItem->id,$field_type='text',$meta_key='dam_by',$auctionItem->post_type,$status='on');
                                     @endphp

                              </p>
                           </div>
                           <div class="lot-info-row mt-3">
                              <h5>
                                 Owner
                              </h5>
                              <p>
                               @php
                                       echo CH::get_Post_Meta_value($auctionItem->id,$field_type='text',$meta_key='owner',$auctionItem->post_type,$status='on');
                                     @endphp
                                                                                                   
                              </p>
                           </div>
                           <div class="lot-info-row">
                              <h5>Value added Tax rate</h5>
                              <p>
                                   @php
                                       echo CH::get_Post_Meta_value($auctionItem->id,$field_type='number',$meta_key='value_added_tax_rate',$auctionItem->post_type,$status='on');
                                     @endphp%</p>
                           </div>
                           <div class="lot-info-row">
                              <h5>
                                 Breeder
                              </h5>
                              <p>

                                @php
                                       echo CH::get_Post_Meta_value($auctionItem->id,$field_type='text',$meta_key='breeder',$auctionItem->post_type,$status='on');
                                     @endphp
                                
                              </p>
                           </div>
                           <hr>
                           <div class="lot-info-row docsxray-row">


                             


                              <div class="docsxray-item">

                                @if (CH::get_Post_Meta_value($auctionItem->id,$field_type='file',$meta_key='veterinary_documents',$auctionItem->post_type,$status='on')!=null)
                                 <a href="{{ asset('img') }}/{{ CH::get_Post_Meta_value($auctionItem->id,$field_type='file',$meta_key='veterinary_documents',$auctionItem->post_type,$status='on') }}" download>
                                 <div class="lot-details-icon ">
                                    <i class="fa fa-file"></i>
                                    <h6>Veterinary documents</h6>
                                 </div>
                                 </a>
                                @endif

                              
                              </div>
                        
                              <div class="docsxray-item"> 

                                @if (CH::get_Post_Meta_value($auctionItem->id,$field_type='file',$meta_key='auction_terms',$auctionItem->post_type,$status='on')!=null)
                                 <a href="{{ asset('img') }}/{{ CH::get_Post_Meta_value($auctionItem->id,$field_type='file',$meta_key='auction_terms',$auctionItem->post_type,$status='on') }}" >
                                 <div class="lot-details-icon "> 
                                    <i class="fa fa-file"></i>
                                    <h6 id="term__text">Auction Terms</h6>
                                 </div>
                                  </a>
                                    @endif
                              </div>
                           </div>
                         
                        </div>
                     
                   
                     </div>
                  </div>
                  <div data-v-5cfb810a="" class="hierarchical-tree-table" style="margin-bottom: 0px !important;">
                  
                  </div>
                  <div class="block" style="margin-top: 10px; margin-bottom: -15px;">
                     
                     <p>
                        
                   {!!  $auctionItem->description   !!}

                     </p>
                {{--      <table cellspacing="5" cellpadding="5" border="0" class="mt-2">
                        <tbody>
                           <tr>
                              <td valign="top"><b>Dam:</b></td>
                              <td valign="top"> Daisy</td>
                           </tr>
                           <tr>
                              <td valign="top"><b>ZL:</b></td>
                              <td valign="top">ZL: 10/8</td>
                           </tr>
                        </tbody>
                     </table> --}}
                    {{--  <table cellspacing="5" cellpadding="5" border="0" class="mt-3">
                        <tbody>
                           <tr>
                              <td valign="top"><b>Granddam:</b></td>
                              <td valign="top">St.Pr. Arabella</td>
                           </tr>
                           <tr>
                              <td valign="top"><b>Award:</b></td>
                              <td valign="top">4xIa.</td>
                           </tr>
                           <tr>
                              <td valign="top"><b>ZL:</b></td>
                              <td valign="top">ZL: 15/12</td>
                           </tr>
                           <tr>
                              <td valign="top"><b>Mare performance test:</b></td>
                              <td valign="top">7,00 7,00 7,00 / 6,33 / 8,25</td>
                           </tr>
                        </tbody>
                     </table> --}}
                  </div>
               </div>
            </section>
            {{-- <section id="related-lots" class="top-margin">
               <h4> Other suggestions </h4>
               <div class="grid-wrap">
                  <a data-v-2ed9434c="" href="https://horse24.com/en/auctions/details/137-verden-elite-auction-online-2-year-old-stallions-and-foals-58/lots/bogheri-555">
                     <div data-v-2ed9434c="" class="lot-wrap horse-wrap">
                        <div data-v-2ed9434c="" class="horse-img">
                           <!----> <!----> 
                           <div data-v-2ed9434c="" class="horse-img-inner lazy-loaded" data-src="https://horse24-medias.s3.amazonaws.com/prod_hannoveraner_cmy7a/lots/4531/lot-image_1600983544116_png" lazy="loaded" style="padding-top: 100% !important; background-image: url(&quot;https://horse24-medias.s3.amazonaws.com/prod_hannoveraner_cmy7a/lots/4531/lot-image_1600983544116_png&quot;);"></div>
                           <div data-v-2ed9434c="" class="lot-flag">
                              <h6 data-v-2ed9434c="" class=""><span data-v-2ed9434c="" class="icon-auction"></span>
                                 Ended Auction
                              </h6>
                           </div>
                        </div>
                        <div data-v-2ed9434c="" class="content-box">
                           <div data-v-2ed9434c="" class="top-row">
                              <div data-v-2ed9434c="" class="name-company">
                                 <h5 data-v-2ed9434c="" title="Bogheri" class="horse-name"> Bogheri</h5>
                              </div>
                              <div data-v-2ed9434c="" class="lot-number">Lot 219</div>
                           </div>
                           <div data-v-2ed9434c="" class="main-row">
                              <!----> 
                              <div data-v-2ed9434c="" class="details">
                                 <h6 data-v-2ed9434c="">Sire</h6>
                                 <p data-v-2ed9434c="" title="Belantis">Belantis</p>
                              </div>
                              <div data-v-2ed9434c="" class="details">
                                 <h6 data-v-2ed9434c="">Dam By</h6>
                                 <p data-v-2ed9434c="" title="Lauries Crusador xx">Lauries Crusador xx</p>
                              </div>
                              <div data-v-2ed9434c="" class="details">
                                 <h6 data-v-2ed9434c="">Gender</h6>
                                 <p data-v-2ed9434c="" title="Stallion">Stallion</p>
                              </div>
                              <div data-v-2ed9434c="" class="details">
                                 <h6 data-v-2ed9434c="">Born</h6>
                                 <p data-v-2ed9434c="">12.04.2018</p>
                              </div>
                              <div data-v-2ed9434c="" class="bid-price" style="visibility: visible;">
                                 <h6 data-v-2ed9434c="">
                                    Hammer Price
                                 </h6>
                                 <h4 data-v-2ed9434c="" class="company-primary">€ 16.000</h4>
                              </div>
                              <!----> 
                              <div data-v-2ed9434c="" class="bids-info d-flex">
                                 <!----> 
                                 <div data-v-2ed9434c="" class="bids-info-row">
                                    <div data-v-2ed9434c="" class="number-box">2</div>
                                    <h6 data-v-2ed9434c="">Bidders</h6>
                                 </div>
                                 <div data-v-2ed9434c="" class="bids-info-row">
                                    <div data-v-2ed9434c="" class="number-box">4</div>
                                    <h6 data-v-2ed9434c="">Bids</h6>
                                 </div>
                              </div>
                              <div data-v-2ed9434c="" class="bottom-row">
                                 <div data-v-2ed9434c="">
                                    <!----> 
                                    <div class="bidup-wrap" style="display: none;">
                                       <h6 class="top-countdown">
                                          <small></small> <!---->
                                       </h6>
                                       <div class="countdown__wrap position-relative">
                                          <!----> 
                                          <div id="555_container" class=""></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!----> <!----> 
                              <div data-v-2ed9434c="" class="stats" style="visibility: visible;">
                                 <div data-v-2ed9434c="" class="soldto">
                                    <h6 data-v-2ed9434c="">Sold to</h6>
                                    <div data-v-2ed9434c="" class="sold-country">
                                       <h5 data-v-2ed9434c="" style="display: flex; justify-content: center;"><span data-v-2ed9434c="" class="iti-flag de"></span> <span data-v-2ed9434c="">
                                          Germany
                                          </span>
                                       </h5>
                                    </div>
                                 </div>
                                 <!---->
                              </div>
                              <button data-v-2ed9434c="">See Details</button>
                           </div>
                        </div>
                     </div>
                  </a>
             
                  
               </div>
            </section> --}}
         </div>
         <div class="col-lg-4 ">
               @php
                


               $validateSidebar=CH::validateDisplayAcutionDataGlobal($auction->id,$auctionItem->id,$auctionItem->start_price,$auctionItem->start_datetime,$auctionItem->end_datetime);
               if( $validateSidebar=='startbid'){

                  CH::getFrontEndBiddingSidebar($auction->id,$auctionItem->id,$auctionItem->start_price,$auctionItem->start_datetime,$auctionItem->end_datetime);

               }elseif ( $validateSidebar=='endbid') {

                   CH::BidBoardNotBiddingSold($auction->id,$auctionItem->id,$auctionItem->start_price,$auctionItem->start_datetime,$auctionItem->end_datetime);
                  
               }elseif ( $validateSidebar=='endbid') {

                   CH::BidBoardNotBiddingSold($auction->id,$auctionItem->id,$auctionItem->start_price,$auctionItem->start_datetime,$auctionItem->end_datetime);
                  
               }elseif ($validateSidebar=='endauctionmain') {

                   CH::BidBoardNotBiddingUpcoming($auction->id,$auctionItem->id,$auctionItem->start_price,$auctionItem->start_datetime,$auctionItem->end_datetime);
               }else {

                  echo '<p class="text-danger">Sorry Currentally Bidding Is off This Item By Admin Start Soon ...!</p>';
                  
               }

                  // echo CH::validateDisplayAcutionDataGlobal($auction->id,$auctionItem->id,$auctionItem->start_price,$auctionItem->start_datetime,$auctionItem->end_datetime);

              

              
               @endphp
         </div>
      </div>
   </div>
</main> 
@endsection
@section("footer")
@parent
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<style type="text/css">

</style>
<script type="text/javascript">

function CountDownTimer(inputDate=''){

// Set the date we're counting down to
var countDownDate = new Date(inputDate).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  $("#countDownTimer").text( days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ");
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    $("#countDownTimer").text('Expired');
  }
}, 1000);

}


  
 $('.subImage').click(function(){
  
 $('.mainImage').attr('src',$(this).attr('src'));
})  



$( document ).ready(function() {

 


 CountDownTimer($('.countDownDatetimeval').text().trim());

function isEmpty(val){
    return (val === undefined || val == null || val.length <= 0) ? true : false;
}  

function GoBid(bidPrice='',create_datetimefooter='',auction_item_id='',auction_parient_id=''){
  
   var currentUrl=window.location.href;

$.ajax({
url:"{{ route('GO_Bidding') }}",
type:"POST",
dataType:"json",
data:{bidPrice:bidPrice,create_datetimefooter:create_datetimefooter,auction_item_id:auction_item_id,auction_parient_id:auction_parient_id,currentUrl:currentUrl,_token:"{{ csrf_token() }}"},
success:function(res2)
{
 

 if(res2.status=='ok'){


var resdata=res2.data;
   $.ajax({
url:"{{ route('GO_BiddingSendMails') }}",
type:"POST",
dataType:"json",
data:{data:resdata,_token:"{{ csrf_token() }}"},
success:function(res3)
{ 
  
console.log(res3);
}

   })


$('#loaderbs4').fadeOut();
$('#BiddinModalCenter').modal('hide');
swal({
   title: "Congratulations...!",
    text: "You Bid is Submit SuccessFully...!",
  icon: "success",

  }).then(function(){ 
   location.reload();
   });

 }else{
swal({
   title: "Sorry..!",
    text: "You Bid Is Not Submt Because Date Time Is Up...! ",
  icon: "error",

  }).then(function(){ 
   location.reload();
   });

 }



},
 error: function(XMLHttpRequest, textStatus, errorThrown) { 
        console.log("Status: " + textStatus); console.log("Error: " + errorThrown);console.log("Error: " + errorThrown); 
    }   

});


  }


 function ValidateBiddInput(){

 $('#loaderbs4').fadeIn();
  var auction_item_id=$('#auction_item_id').val();
  var auction_parient_id=$('#auction_parient_id').val();
  var bidPrice=$('#bidPrice').val();
  var create_datetimefooter=$('#create_datetimefooter').val();

  if(!isEmpty(auction_item_id) && !isEmpty(auction_parient_id)  && !isEmpty(create_datetimefooter)){


if(!isEmpty(bidPrice)){

$('.validationStatus').html('');

$.ajax({
url:"{{ route('Validate_Bidding_Conditions') }}",
type:"POST",
dataType:"json",
data:{bidPrice:bidPrice,create_datetimefooter:create_datetimefooter,auction_item_id:auction_item_id,auction_parient_id:auction_parient_id,_token:"{{ csrf_token() }}"},
success:function(res)
{ 
    
    //console.log(res);
   if(!isEmpty(res)){


   let intailPrice=bidPrice;

   let intailcurrentBidPrice = +res.currentBidPrice + +res.increement;

    //alert(intailcurrentBidPrice);
$('#biddingConditions').html(`<ul class="list-group list-group-flush " >
      <li class="list-group-item text-danger p-1 font-weight-light text-capitalize" style="border: 0 !important;">The minimun increment you can make in the last bid is <strong class="font-weight-bolder" style="font-size: 17px;
    font-weight: 900 !important;">$${res.increement} </strong>
   and the new minimum bid you can do is <strong class="font-weight-bolder text-warning" style="font-size: 17px;
    font-weight: 900 !important;">(${res.currentBidPrice}+${res.increement}=${intailcurrentBidPrice})</strong> </li>  
     </li>

     </ul>`);
   $('.lastPriceval').text('$'+res.currentBidPrice);


   console.log([intailPrice,intailcurrentBidPrice]);

  if(intailPrice < intailcurrentBidPrice){

    $('.validationStatus').html('<p class="text-danger">Please Add Correct Amount According to above Rule Try Again...! <i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i></p>');
  }else{

    GoBid(bidPrice,create_datetimefooter,auction_item_id,auction_parient_id)
  
  }
   
  

   }else{

    $('.validationStatus').html('<p class="text-danger">GO Some Thing Wrong Maintaince Requrie Do Not bid Now..! <i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i></p>');

   }

  
  
},
 error: function(XMLHttpRequest, textStatus, errorThrown) { 
        console.log("Status: " + textStatus); console.log("Error: " + errorThrown);console.log("Error: " + errorThrown); 
    }   

});

}else{

   $('.validationStatus').html('<p class="text-danger"> Please Fill The Field Of Bid Amount..! <i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i></p>');

$('#loaderbs4').fadeOut();
}
}else{

alert('post data Missing..!');
}


 }






  
$('.SubMitBidGo').click(function(){

ValidateBiddInput();

})

$('#wishlist').click(function(){


let ItemIdauc=$(this).attr('item_Id_acu');
  @if(Auth::user())
let user_id={{ Auth::user()->id }}
@endif

$.ajax({
url:"{{ route('addWhishlist') }}",
type:"POST",
dataType:"json",
data:{user_id:user_id,ItemIdauc:ItemIdauc,_token:"{{ csrf_token() }}"},
success:function(res)
{ 

 if(res.status=='ok'){
toastr.success('Item Added To Whislist SuccessFully', '', {timeOut: 3000});
 }else{
toastr.warning('Item Already into Whislist', '', {timeOut: 3000});

 }
},
 error: function(XMLHttpRequest, textStatus, errorThrown) { 
        console.log("Status: " + textStatus); console.log("Error: " + errorThrown);console.log("Error: " + errorThrown); 
    }   

});



})


  

});




 
</script>

@endsection






