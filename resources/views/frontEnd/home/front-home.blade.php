{{-- extend  --}}
@extends('front-end-layout.app')
@extends('includes-frontend.header')
@extends('includes-frontend.footer')
{{-- page titles --}}
@section('title', 'Home')
@section('content')
<main role="main">
  <section id="home-banner" class="top-banner lazy-loaded" style="background-image: url({{ asset('img/homebackgroungbaner.jpg') }});">
    <div class="container">
      <div class="row h-100 pt-4 pb-4">
        <div class="col-lg-6">
          <div class="headline-wrap">
            <div class="headline-inner">
              <h1>Lorem Ipsum is simply dummy text </h1>
              <big>
             Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              </big>
              <a href="{{ route('register') }}" class="modal-tab-toggle" data-target="login-register" data-tab-content="1">
                <button class="btn-primary-bg">Sign up now</button>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 d-lg-flex d-xl-flex d-none" style="min-height: 350px ">
          <img class="img-fluid img-thumbnail" src="{{ asset('img/homeBaner2.jpg') }}" style="max-height: 350px">
        </div>
      </div>
    </div>
  </section>
  <div class="container">
  {{--   <div class="row">
      
      <div class="col-sm-3 p-1">
        <form action="{{ route('frontAuctionFilter') }}" method="POST">
          @csrf
          <!-- First name -->
          <div class="form-group"><label for="username"><strong class="text-danger">Auctions</strong></label>
          <select  class=" form-control"  name="status">
            
            <option value="on" selected> Running Acutions</option>
            <option value="off" > Ended Acutions</option>
            
          </select>
        </div>
      </div>
      <div class="col-sm-3 p-1">
        <!-- Last name -->
        <div class="form-group"><label for="username"><strong class="text-danger">From Date</strong></label>
        <input type="text" name="from_date" class="form-control" id="startDatetime" placeholder="____-__-__ __:__:__" required="" value="{{ old('from_date') }}">
      </div>
    </div>
    <div class="col-sm-3 p-1">
      <div class="form-group"><label for="username"><strong class="text-danger">To Date</strong></label>
      <input type="text" name="to_date" class="form-control" id="endDatetime" placeholder="____-__-__ __:__:__" required="" value="{{ old('to_date') }}">
    </div>
  </div>
  <div class="col-sm-3 pt-4 ">
    <div class="modal-footer pt-2" style="justify-content: flex-start !important;">
      <button type="" class="btn-success btn-sm shadow-lg border-0">Filter</button>
      <a href="/" class="btn-danger btn-sm shadow-lg border-0">Reset</a>
    </div>
    
  </div>
  
</form>
</div> --}}
<div class="row">
<div class="col-lg-8">
  
  <h2>Online Auctions</h2>
  <div class="auction-wrapper-7 m--15">
    @foreach ($auctions as $auction)
    <div class="auction-item-7 time  ">
      <div class="auction-inner ">
        <a href="{{ route('single-auction',['id'=>Crypt::encrypt($auction->id),'post_type'=>Crypt::encrypt($auction->post_type)]) }}" class="upcoming-badge-2" title="Upcoming Auction" style=" background:{{ ($auction->status == 'on') ? '#43B055' : 'rgb(150, 43, 37)' }}">
          <i class="fa fa-gavel"></i>
        </a>
        
        <div class=" col-sm-12 col-md-6 col-lg-6 auction-thumb bg_img mh-100" style="background-image: url({{ asset('/img') }}/{{$auction->featured_img }}" >
          
          
          
        </div>
        <div class=" col-sm-12 col-md-6 col-lg-6  p-3  align-items-center mx-auto" style="height: 270px; background-color:{{ ($auction->status == 'on') ? '#036EB5' : 'rgb(150, 43, 37)' }}">
          
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
              <p class="auction-description" style="text-align: justify !important;">
                <div data-v-4b132609="">
                  
                  
                  {!! Str::limit($auction->description, 200) !!}
                  <span><a href="#" id="readmore">View more</a> <a href="#" id="readmore" style="display: none;">View less</a></span>
                </div>
              </p>
              <div  class="text-center "><a  href="{{ route('single-auction',['id'=>Crypt::encrypt($auction->id),'post_type'=>Crypt::encrypt($auction->post_type)]) }}" class="view-lot-btn " style=" background:{{ ($auction->status == 'on') ? '#43B055' : 'rgb(150, 43, 37)' }}">View lots</a></div>
            </div>
            
          </div>
          
        </div>
        
      </div>
    </div>
    @endforeach
    
    <div  class="d-flex justify-content-center align-items-center">
      {{ $auctions->links() }}
      
    </div>
    
  </div>
</div>
<div class="col-lg-4  mt-5 pt-2 ">
  
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
<style type="text/css">
@media (max-width: 991px){
.auction-item-7 {
width: 100% !important;
}
}
</style>
<script>

$('#startDatetime').datetimepicker({
format:'Y-m-d H:i:s',
// mask:true,
onShow:function( ct ){
this.setOptions({
maxDate:jQuery('#endDatetime').val()?jQuery('#endDatetime').val():false
})
},
timepicker:true
});
$('#endDatetime').datetimepicker({
format:'Y-m-d H:i:s',
// mask:true,
onShow:function( ct ){
this.setOptions({
minDate:jQuery('#startDatetime').val()?jQuery('#startDatetime').val():false
})
},
timepicker:true
});
</script>
@endsection