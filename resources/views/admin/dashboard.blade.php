{{-- extend  --}}
@extends('admin-layout.app')
@extends('includes-admin.header')
@extends('includes-admin.footer')
@extends('includes-admin.sidebar')
{{-- page titles --}}
@section('title', 'Register')
@section('content') 
{{-- {!! Charts::assets() !!}  --}}
 <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                     <a href="{{ route('user_mangement_homepanel') }}">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </a>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                     <a href="{{ route('auction_dashboard') }}">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Auctions</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAuction }}</div>
                    </div>
                    <div class="col-auto">
                      <i class=" fas fa-horse-head fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </a>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                     <a href="{{ route('auction_item_dashboard') }}">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Auctions Items</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $totalAuctionItem }}</div>
                        </div>
                     
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-list-alt fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </a>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                     <a href="{{ route('bidAdmin') }}">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Bids</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBidding }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-gavel fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </a>
                </div>
              </div>
            </div>
          </div>

            <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                     <a href="{{ route('getallnews_admin') }}">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total News</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalNews }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-newspaper fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </a>
                </div>
              </div>
            </div>

              <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                     <a href="{{ route('subscriber_admin') }}">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Subscriber</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSubscriber }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-bell fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </a>
                </div>
              </div>
            </div>

              <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <a href="{{ route('contact_admin') }}">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Contact us</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalContact }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-envelope  fa-2x text-gray-300"></i>
                    </div>
                  </div>
                  </a>
                </div>
              </div>
            </div>

             <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                     <a href="{{ route('user_mangement_homepanel') }}">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Roles</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalRole }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </a>
                </div>
              </div>
            </div>
          </div>
          {{--  <div class="card-body">
     <div style="width: 50%">
    {!! $usersChart->container() !!}
</div>
                    <h1>{{ $chart1->options['chart_title'] }}</h1>
                   

                <hr />

                    <h1>{{ $chart2->options['chart_title'] }}</h1>
                    {!! $chart2->renderHtml() !!}

                    <hr />

                    <h1>{{ $chart3->options['chart_title'] }}</h1>
                    {!! $chart3->renderHtml() !!}

                </div> --}}



<div class="row">
  
  <div class="col-sm-12 setrenderButtonResult">

    <form action="{{ route('auctionResult_admin_ajax') }}" method="get">
  <label for="fname">Select Auction</label>
<select name="acution_id" class="form-control" required="" id="windecauction">
<option value="">Select Auction</option>
 
</select> 
<br>
<button type="submit" class="btn-block btn-success btn-lg text-capitalize mt-3">Declare Winners of Ended Auctions Item Whos end But not Declare Winner Yet Click This Button And Wait For success status...!</button>

</form>

   
    
  </div>
</div>            
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Graphs</h1>
    
  </div>
  <div class="card shadow mb-4">
  <div class="card-body">

    <div class="row">
<div class="col-sm-12">
<p class=" mb-0 text-danger">Biddings</p>
{!! $chart7->renderHtml() !!}
</div>
    </div>
  <div class="row">
  <div class="col-sm-4">
     <p class=" mb-0 text-danger">Users</p>
      {!! $chart1->renderHtml() !!}
       
  </div>
  <div class="col-sm-4">
   <p class=" mb-0 text-danger">Auctions</p>
       {!! $chart2->renderHtml() !!}
  </div>

  <div class="col-sm-4">
  <p class=" mb-0 text-danger">Auctions Items</p>
   {!! $chart3->renderHtml() !!}
  </div>
    </div>  

    <div class="row">
  <div class="col-sm-4">
     <p class=" mb-0 text-danger">News</p>
      {!! $chart4->renderHtml() !!}
       
  </div>
  <div class="col-sm-4">
   <p class=" mb-0 text-danger">Subscriber</p>
       {!! $chart5->renderHtml() !!}
  </div>

  <div class="col-sm-4">
  <p class=" mb-0 text-danger">Contact Us</p>
   {!! $chart6->renderHtml() !!}
  </div>
    </div> 
       </div>
        </div>
        </div>
        <!-- /.container-fluid -->
@endsection
@section("footer")
@parent
<style type="text/css">
  .label{
        font-size: 94% !important;
  }
</style>

{!! $chart1->renderChartJsLibrary() !!}
 
{!! $chart1->renderJs() !!}
{!! $chart2->renderJs() !!}
{!! $chart3->renderJs() !!}
 
{!! $chart4->renderJs() !!}
{!! $chart5->renderJs() !!}
{!! $chart6->renderJs() !!}
{!! $chart7->renderJs() !!}
{{--   @if($usersChart)
    {!! $usersChart->script() !!}
    @endif

@endsection --}}

<script>
  $(document).ready(function(){
$('.checkgo').click(function(){

  var Tem=' <button type="" class="btn-block btn-danger btn-lg text-capitalize ">Wait Proccess is Running Behind.....! <i class="fas  fa-refresh"></i></button>';

   $('.setrenderButtonResult').html(Tem);

// var Tem2=' <button type="" class="btn-block btn-danger btn-lg text-capitalize goforresult">Error Please Click Again...!</button>';
// var Tem3=' <button type="" class="btn-block btn-success btn-lg text-capitalize">Task Done SuccessFully Thanks Next Try Refresh Page First...!</button>';


// $('.setrenderButtonResult').html(Tem);

//  $.ajax({ 
// url:"", 
// type:"POST",
// dataType:"json",
// data:{do_OP:'go',_token:""},
// success:function(res)
// {
// if (res.status=='ok'){
// $('.setrenderButtonResult').html(Tem3);


// }else{

// $('.setrenderButtonResult').html(Tem2);

// }
// }
})



var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

      $( "#windecauction" ).select2({
        ajax: { 
          url: "{{ route('get_Auctions_for_winner_ajax') }}",
          type: "post",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              _token: CSRF_TOKEN,
              search: params.term // search term
            };
          },
          processResults: function (response) {
  

           
            return {
              results: response
            };
          },
          cache: true
        }

      });

    });
 
});
</script>
@endsection