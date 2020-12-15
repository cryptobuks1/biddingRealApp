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


                   @if(count($winningAuctions)>0)
               <div class="grid-wrap details-type">
                    @foreach ($winningAuctions as $winningAuction)
                             {{-- expr --}}

                        <a href="{{ route('single-auction-item',['id'=>Crypt::encrypt($winningAuction->getAuctionItem->id),'post_type'=>Crypt::encrypt($winningAuction->getAuctionItem->post_type),'auctionId'=>Crypt::encrypt($winningAuction->getAuction->id)]) }}">
                           <div class="lot-wrap horse-wrap shadow-lg rounded">
                              <div class="horse-img">
                                 <!----> <!---->
                                 <div class="horse-img-inner" data-src="{{ asset('/img') }}/{{explode(',', $winningAuction->getAuctionItem->gallery)[0] }}" lazy="loading" style="padding-top: 100% !important; background-image: url({{ asset('/img') }}/{{explode(',', $winningAuction->getAuctionItem->gallery)[0] }});background-size: cover !important;"></div>
                                 <div class="lot-flag">
                                    <h6 class=""><span class="fa fa-gavel"></span>
                                  
                                    </h6>
                                 </div>
                              </div>
                            <div  class="content-box">
                                 <div  class="top-row">
                                    <div  class="name-company">
                                       <h5  title="Saffron" class="horse-name"> {{ Str::limit($winningAuction->getAuctionItem->title,20) }}</h5>
                                    </div>
                                    <div  class="lot-number">Lot {{ $winningAuction->getAuctionItem->id }}</div>
                                 </div>
                                 <div  class="main-row">
                                    <!---->
                                    <div  class="details">
                                       <h6 >Sire</h6>
                                       <p title="Secret">
                                     
                                     @php
                                       echo CH::get_Post_Meta_value($winningAuction->getAuctionItem->id,$field_type='number',$meta_key='age',$winningAuction->getAuctionItem->post_type,$status='on');
                                     @endphp
                                     </p>
                                    </div>
                                    <div class="details">
                                       <h6 >Dam By</h6>
                                       <p  title="Hohenstein/T.">
                                         @php
                                       echo CH::get_Post_Meta_value($winningAuction->getAuctionItem->id,$field_type='text',$meta_key='dam_by',$winningAuction->getAuctionItem->post_type,$status='on');
                                     @endphp

                                       </p>
                                    </div>
                                    <div  class="details">
                                       <h6 >Gender</h6>
                                       <p  title="Stallion">
                                           @php
                                       echo CH::get_Post_Meta_value($winningAuction->getAuctionItem->id,$field_type='text',$meta_key='gender',$winningAuction->getAuctionItem->post_type,$status='on');
                                     @endphp

                                       </p>
                                    </div>
                                    <div  class="details">
                                       <h6 >Born</h6>
                                       <p >
                                         
                                           @php
                                       echo CH::get_Post_Meta_value($winningAuction->getAuctionItem->id,$field_type='text',$meta_key='born',$winningAuction->getAuctionItem->post_type,$status='on');
                                     @endphp
                                       </p>
                                    </div>
                                    <div  class="bid-price" style="visibility: visible;">
                                       <h6>
                                      STARTING BID
                                       </h6>
                                       <h4  class="company-primary">$ {{ $winningAuction->getAuctionItem->start_price }}</h4>
                                    </div>
                                    <!---->
                                    <div  class="bids-info d-flex">
                                       <!---->
                                      {{--  <div class="bids-info-row">
                                          <div class="number-box">6</div>
                                          <h6 >Bidders</h6>
                                       </div> --}}
                                       <div  class="bids-info-row">
                                          <div  class="number-box">{{ CH::ItemBiddinCount($winningAuction->getAuctionItem->id) }}</div>
                                          <h6 >Bids</h6>
                                       </div>
                                    </div>

                                    <!----> <!---->
                                    <div  class="bidup-wrap" style="visibility: visible;">
                                       <div  class="top-countdown">
                                         <small class="text-dark">Bid Up will End On</small>
                                          <p class="text-danger">
                                        @php
                                        echo CH::GetCilentDatetime($winningAuction->getAuctionItem->end_datetime)->format('d M Y, h:i:s A');
                                        @endphp
                                     </p>
                                    </div>
                                    <!---->
                                 </div>
                                   
                                    <!----> <!---->
                                    <div  class="stats" style="visibility: visible;">
                                       <div  class="soldto">
                                          <h6 >Sold to</h6>
                                          &nbsp;&nbsp;
                                          <div  class="sold-country">
                                             <h5 class="text-dark" style="display: flex; justify-content: center;">
                                            {{ $winningAuction->getUser->country }}
                                          </span>
                                          </h5>
                                       </div>
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

                         @else

                         <h2 class="text-center text-danger"> you Have No Win Any Auction Yet....!</h2>
                       @endif   
            
        </div>
    </div>

    
</div>
</main>
     
@endsection
@section("footer")
@parent
<style type="text/css">
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

@endsection
