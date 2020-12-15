{{-- extend  --}}
@extends('front-end-layout.app')
@extends('includes-frontend.header')
@extends('includes-frontend.footer')
{{-- page titles --}}
@section('title', 'Single Lots')
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
              <h4 class="font-weight-bolder">{{ $auction->title }}</h4>
              
              
            </div>
            
          </div>
          
        </div>
        
      </div>
    </div> --}}
    <div class="row">
      <div class="col-lg-8 top-banner shadow-sm p-3 mt-1  bg-white rounded">
        
        <section id="lot-listing">
          <div class="row" >
            <div class="col-12">
              <div class="title-view-type">
                <h2 style="margin-bottom: 20px;" class="text-dark">Auctions</h2>
              </div>
              <form action="{{ route('postfilterFrontsSingleac') }}" method="Post">
                @csrf
                <input type="hidden" name="auction_id" value="{{ $auction->id}}">
                <input type="hidden" name="post_type" value="{{ $auction->post_type}}">
                <div class="form-row ">
                  <div class="col-sm-3 p-1">
                    <!-- First name -->
                    <div class="form-group"><label for="username"><strong class="text-danger">Auctions</strong></label>
                    <select  class=" form-control" name="auctionsRun" id="auctionsRun">
                      
                      <option value="on" selected> Running </option>
                      <option value="off" > Ended </option>
                    
                    </select>
                  </div>
                </div>
                <div class="col-sm-2 p-1">
                  <!-- Last name -->
                  <div class="form-group"><label for="username"><strong class="text-danger">Gender</strong></label>
                 <select name="gender" class="form-control">
                   <option value="male">Male</option>
                    <option value="female">FeMale</option>
                 </select>
                </div>
              </div> 
              <div class="col-sm-1 p-1">
                <div class="form-group"><label for="username"><strong class="text-danger">Age</strong></label>
                <input type="number" name="age" class="form-control"  placeholder="2" step="any" value="{{ old('age') }}">
              </div>
            </div>
            <div class="col-sm-3 p-1">
                <div class="form-group"><label for="username"><strong class="text-danger">Breed</strong></label>
               @php
              $breeds=CH::getBreedHorse('breed',$auction->post_type,'text');
            
            @endphp
              <select name="breed"  class="form-control">
                <option value="">Select Breed</option>
              
                @foreach ($breeds as $breed)
                 <option value="{{ $breed->meta_value }}">{{ $breed->meta_value }}</option>
                @endforeach
                 </select>
              </div>
            </div>
              <div class="col-sm-3 p-1"> 
                <div class="form-group"><label for="username"><strong class="text-danger">Bidding Price</strong></label>
                <select name="biddingprice" class="form-control">

                     <option value=""> Select Price</option>
                   <option value="ltoh"> lowest to highest</option>
                    <option value="htol">highest to lowest</option>
                 </select>
              </div>
            </div>


          </div>
          <div class="wrapper px-2" style="width:100%;" >
          {{--   <div class="range-slider">
              <input type="text" class="js-range-slider" value="" />
            </div> --}}
            <div class="row" >
            {{--   <div class="col-sm-4 p-1">
                <input type="number" name="start_price" id="start_price" class="js-input-from form-control" value="0" any />
              </div> --}}
             {{--  <div class="col-sm-4 p-1">
                <input type="number" name="end_price" id="end_price" class="js-input-to form-control" value="0" any />
              </div> --}}
              <div class="col-sm-4 p-1" style="margin-top: -28px;">
                <button type="submit" class="btn btn-primary btn-sm shadow-sm border-0" id="SignleAuctionfilterGo" >Filter</button>
                <a href="{{ route('single-auction',['id'=>Crypt::encrypt($auction->id),'post_type'=>Crypt::encrypt($auction->post_type)]) }} }}" class="btn btn-danger btn-sm shadow-sm border-0" id="SignleAuctionfilterReset" style="margin-top: 9px;">Reset</a>
              </div>
            </div>
          </div>
        </form>
        {{--  <div class="form-row">
          <button type="" class="btn-primary btn btn-block shadow-sm border-0 ">Filetr</button>
        </div> --}}
        
        
        
        <br> <!---->
        <section>
          
          <!---->
          
          <div class="grid-wrap details-type">
            @foreach ($auctionItems as $element)
            {{-- expr --}}
            
            <a  href="{{ route('single-auction-item',['id'=>Crypt::encrypt($element->id),'post_type'=>Crypt::encrypt($element->post_type),'auctionId'=>Crypt::encrypt($auction->id)]) }}">
              <div  class="lot-wrap horse-wrap shadow-lg rounded">
                <div class="horse-img">
                  <!----> <!---->
                  <div  class="horse-img-inner" data-src="{{ asset('/img') }}/{{explode(',', $element->gallery)[0] }}" lazy="loading" style="padding-top: 100% !important; background-image: url({{ asset('/img') }}/{{explode(',', $element->gallery)[0] }});background-size: cover !important;"></div>
                  <div  class="lot-flag">
                    <h6  class=""><span  class="fa fa-gavel"></span>
                    
                    </h6>
                  </div>
                </div>
                <div  class="content-box">
                  <div  class="top-row">
                    <div  class="name-company">
                      <h5  title="Saffron" class="horse-name"> {{ Str::limit($element->title,20) }}</h5>
                    </div>
                    <div  class="lot-number">Lot {{ $element->id }}</div>
                  </div>
                  <div  class="main-row">
                    <!---->
                    <div  class="details">
                      <h6 >Age</h6>
                      <p title="Secret">
                        
                        @php
                        echo CH::get_Post_Meta_value($element->id,$field_type='number',$meta_key='age',$element->post_type,$status='on');
                        @endphp
                      </p>
                    </div>
                    <div  class="details">
                      <h6 >Sire</h6>
                      <p title="Secret">
                        
                        @php
                        echo CH::get_Post_Meta_value($element->id,$field_type='text',$meta_key='sire',$element->post_type,$status='on');
                        @endphp
                      </p>
                    </div>
                    <div class="details">
                      <h6 >Dam By</h6>
                      <p  title="Hohenstein/T.">
                        @php
                        echo CH::get_Post_Meta_value($element->id,$field_type='text',$meta_key='dam_by',$element->post_type,$status='on');
                        @endphp
                      </p>
                    </div>
                    <div  class="details">
                      <h6 >Gender</h6>
                      <p  title="Stallion">
                        @php
                        echo CH::get_Post_Meta_value($element->id,$field_type='gender',$meta_key='gender',$element->post_type,$status='on');
                        @endphp
                      </p>
                    </div>
                    <div  class="details">
                      <h6 >Born</h6>
                      <p >
                        
                        @php
                        echo CH::get_Post_Meta_value($element->id,$field_type='text',$meta_key='born',$element->post_type,$status='on');
                        @endphp
                      </p>
                    </div>
                    <div  class="bid-price" style="visibility: visible;">
                      <h6>
                      STARTING BID
                      </h6>
                      <h4  class="company-primary">$ {{ $element->start_price }}</h4>
                    </div>
                    <div  class="bid-price" style="visibility: visible;">
                      <h5 class="text-success">
                      LAST BID
                      </h5>
                      <h4  class="company-primary text-success">$
                      @php
                      $currentBid=CH::ItemBiddinCurrent($element->id);
                      if(!empty($currentBid)){
                      echo $currentBid->amount;
                      }else {
                      echo 0;
                      }
                      @endphp
                      </h4>
                    </div>
                    @if (!empty($currentBid))
                    {{-- expr --}}
                    
                    @if($countries->count())
                    @foreach($countries as $country)
                    @if ($country->name->common==$currentBid->getUser->country)
                    <span style="padding: 5px;"> {!! $country->flag['flag-icon'] !!} {!! $country->name->common !!} </span>
                    @endif
                    
                    @endforeach
                    @endif
                    @endif
                    <!---->
                    <div  class="bids-info d-flex">
                      <!---->
                      {{--  <div class="bids-info-row">
                        <div class="number-box">6</div>
                        <h6 >Bidders</h6>
                      </div> --}}
                      <div  class="bids-info-row">
                        <div  class="number-box">{{ CH::ItemBiddinCount($element->id) }}</div>
                        <h6 >Bids</h6>
                      </div>
                    </div>
                    
                    <!---->
                    
                    <!----> <!---->
                    <div  class="bidup-wrap" style="visibility: visible;">
                      <div  class="top-countdown">
                        <small class="text-dark">Bidding Date Time</small>
                        <p class="text-danger">
                          @php
                          echo CH::GetCilentDatetime($element->start_datetime)->format('d M Y, h:i:s A');
                          @endphp
                        </p>
                      </div>
                      <!---->
                    </div>
                    
                    
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
          <div  class="d-flex justify-content-center align-items-center">
            
            @if($auctionItems instanceof \Illuminate\Pagination\LengthAwarePaginator )
            {{$auctionItems->links()}}
            @endif
          </div>
        </section>
        <!---->
      </div>
    </div>
  </section>
</div>
<div class="col-lg-4 ">
  @php
  CH::getSidebar();
  @endphp
  
</div>
</div>
</div>
</main>
@endsection
@section("footer")
@parent
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.8.0/css/flag-icon.min.css" />
<style type="text/css">
</style>
<script type="text/javascript">

$('.date_timepicker_start_filter').datetimepicker({
format:'Y-m-d H:i:s',
// mask:true,
onShow:function( ct ){
this.setOptions({
maxDate:jQuery('.date_timepicker_end_filter').val()?jQuery('.date_timepicker_end_filter').val():false
})
},
timepicker:true
});
$('.date_timepicker_end_filter').datetimepicker({
format:'Y-m-d H:i:s',
// mask:true,
onShow:function( ct ){
this.setOptions({
minDate:jQuery('.date_timepicker_start_filter').val()?jQuery('.date_timepicker_start_filter').val():false
})
},
timepicker:true
});
</script>
@endsection 