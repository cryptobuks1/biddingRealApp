{{-- extend  --}}
@extends('front-end-layout.app')
@extends('includes-frontend.header')
@extends('includes-frontend.footer')

{{-- page titles --}}
@section('title', 'Home')
@section('content')  
<main role="main">
 


   <div class="container ">
    <div class="row">
         @include('includes-frontend.accountSidebar')
        <!-- Profile Settings-->
        <div class="col-lg-8 pb-5 card rounded-md shadow-sm border-0 py-3">
               @include('includes-admin.alerts')


                   @if($whishListcount>0) 
               <div class="grid-wrap details-type"> 
                    @foreach ($whishList as $whishListitem)
                             {{-- expr --}}
                           
                        <a href="{{ route('single-auction-item',['id'=>Crypt::encrypt($whishListitem->getAuctionitem->id),'post_type'=>Crypt::encrypt($whishListitem->getAuctionitem->post_type),'auctionId'=>Crypt::encrypt($whishListitem->getAuctionitem->ac_parent_id)]) }}" class="arrow-left">
                           <div class="lot-wrap horse-wrap shadow-lg rounded">
                              <div class="horse-img">
                                 <!----> <!---->
                                  <div class="horse-img-inner" data-src="{{ asset('/img') }}/{{explode(',', $whishListitem->getAuctionitem->gallery)[0] }}" lazy="loading" style="padding-top: 100% !important; background-image: url({{ asset('/img') }}/{{explode(',', $whishListitem->getAuctionitem->gallery)[0] }});background-size: cover !important;"></div>
                                 <div class="lot-flag">
                                    <h6 class=""><span class="fa fa-gavel"></span>
                                 
                                    </h6>
                                 <label class="container ">
                            <input type="checkbox" checked="checked" class="rmwhisl" rmwhisl="{{ $whishListitem->item_id }}" >
                             <span class="checkmark rmwhisl2"></span>
                            </label>
                                 </div>

                              </div>
                                    <div  class="content-box">

                                 <div  class="top-row">


                                    <div  class="name-company">
                                       <h5  title="Saffron" class="horse-name"> {{ Str::limit($whishListitem->getAuctionitem->title,20) }}</h5>
                                    </div>
                                    <div  class="lot-number">Lot {{ $whishListitem->getAuctionitem->id }}</div>
                                 </div>
                                 <div  class="main-row">
                                    <!---->
                                    <div  class="details">
                                       <h6 >Sire</h6>
                                       <p title="Secret">
                                     
                                     @php
                                       echo CH::get_Post_Meta_value($whishListitem->getAuctionitem->id,$field_type='number',$meta_key='age',$whishListitem->getAuctionitem->post_type,$status='on');
                                     @endphp
                                     </p>
                                    </div>
                                    <div class="details">
                                       <h6 >Dam By</h6>
                                       <p  title="Hohenstein/T.">
                                         @php
                                       echo CH::get_Post_Meta_value($whishListitem->getAuctionitem->id,$field_type='text',$meta_key='dam_by',$whishListitem->getAuctionitem->post_type,$status='on');
                                     @endphp

                                       </p>
                                    </div>
                                    <div  class="details">
                                       <h6 >Gender</h6>
                                       <p  title="Stallion">
                                           @php
                                       echo CH::get_Post_Meta_value($whishListitem->getAuctionitem->id,$field_type='gender',$meta_key='gender',$whishListitem->getAuctionitem->post_type,$status='on');
                                     @endphp

                                       </p>
                                    </div>
                                    <div  class="details">
                                       <h6 >Born</h6>
                                       <p >
                                         
                                           @php
                                       echo CH::get_Post_Meta_value($whishListitem->getAuctionitem->id,$field_type='text',$meta_key='born',$whishListitem->getAuctionitem->post_type,$status='on');
                                     @endphp
                                       </p>
                                    </div>
                                    <div  class="bid-price" style="visibility: visible;">
                                       <h6>
                                      STARTING BID
                                       </h6>
                                       <h4  class="company-primary">$ {{ $whishListitem->getAuctionitem->start_price }}</h4>
                                    </div>
                                    <!---->
                                    <div  class="bids-info d-flex">
                                       <!---->
                                      {{--  <div class="bids-info-row">
                                          <div class="number-box">6</div>
                                          <h6 >Bidders</h6>
                                       </div> --}}
                                       <div  class="bids-info-row">
                                          <div  class="number-box">{{ CH::ItemBiddinCount($whishListitem->getAuctionitem->id) }}</div>
                                          <h6 >Bids</h6>
                                       </div>
                                    </div>

                                    <!----> <!---->
                                    <div  class="bidup-wrap" style="visibility: visible;">
                                       <div  class="top-countdown">
                                         <small class="text-dark">Bid  will start End</small>
                                          <p class="text-danger">
                                        @php
                                        echo CH::GetCilentDatetime($whishListitem->getAuctionitem->end_datetime)->format('d M Y, h:i:s A');
                                        @endphp
                                     </p>
                                    </div>
                                    <!---->
                                 </div>
                                   
                                   {{--  <!----> <!---->
                                    <div  class="stats" style="visibility: visible;">
                                       <div  class="soldto">
                                          <h6 >Sold to</h6>
                                          <div  class="sold-country">
                                             <h5 style="display: flex; justify-content: center;"><span  class="iti-flag fr"></span> <span >
                                             France
                                          </span>
                                          </h5>
                                       </div>
                                    </div>
                                    <!---->
                                 </div> --}}
                                 <button  class=" btn btn-block btn-success shadow-sm" style="
                                 text-align: center;
                                 width: 100%;
                                 margin-left: -13px;
                                 margin-bottom: 2px;
                                 ">
                                 See Details
                            
                    
                            

                           </button>
                              </div>
                           </div>
                        </div>
                     </a>
                         @endforeach

                       


                                               
                      
                      

                                      </div>

                         @else

                         <h2 class="text-center text-danger">Not Found</h2>
                       @endif   
            
        </div>
    </div>

    
</div>
</main>
     
@endsection
@section("footer")
@parent
<style type="text/css">

/* The container */
.container {
 

}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 200;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
   content: "\274c";
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #c50d0d;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #c50d0d;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "X";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
 color: white;
    left: 4px;
    top: 8px;
    width: 5px;
  height: 10px;
 
 
  -webkit-transform:rotate(271deg);
  -ms-transform:rotate(271deg);
  transform: rotate(271deg);
}

 input[type="file"]::before {
        width: 100%;
        position: absolute;
    content: 'Upload File';
    display: inline-block;
    background: #00bcbe;
    border: 1px solid #999;
    border-radius: 3px;
    padding: 7px 7px 7px 15px;
    color: white;
    outline: none;
    white-space: nowrap;
    -webkit-user-select: none;
    cursor: pointer;
    font-weight: 700;
    font-size: 10pt;
    margin-left: -12px;
    margin-top: -4px;
}
input[type="file"] {
    border: none !important;
}
</style>
<script type="text/javascript">
  
$('.rmwhisl').click(function(){


let ItemIdauc=$(this).attr('rmwhisl');


let user_id={{ Auth::user()->id }}

$.ajax({
url:"{{ route('remWhishlist') }}",
type:"POST",
dataType:"json",
data:{user_id:user_id,ItemIdauc:ItemIdauc,_token:"{{ csrf_token() }}"},
success:function(res)
{ 

 if(res.status=='ok'){
toastr.success('Item Remove from Whislist SuccessFully', '', {timeOut: 3000});
 location.reload();
 }else{
toastr.warning('Item Already Remove from Whislist', '', {timeOut: 3000});

 }
},
 error: function(XMLHttpRequest, textStatus, errorThrown) { 
        console.log("Status: " + textStatus); console.log("Error: " + errorThrown);console.log("Error: " + errorThrown); 
    }   

});



});

</script>
@endsection
