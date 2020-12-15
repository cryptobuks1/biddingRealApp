{{-- extend  --}}
@extends('admin-layout.app')
@extends('includes-admin.header')
@extends('includes-admin.footer')
@extends('includes-admin.sidebar')
{{-- page titles --}}
@section('title', ' Update Auction Item ')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Update Auction Item</h1>
      <a href="{{ route('auction_item_dashboard') }}" class="btn-primary btn btn-sm shadow-lg border-0">Go Back</a>
  </div>
  <div class="card shadow mb-4">
    
    <div class="card-body">
 
      <form method="POST" action="{{ route('update_Auction_item') }}" enctype="multipart/form-data">

             @csrf   
 
            @php 
           CH::PostTypeAlreadySelected($auction_Childs->post_type); 
          CH::UserAlreadySelected($auction_Childs->user_id);
          @endphp

      
           <input type="hidden" name="aucitem_id" value='{{ Crypt::encrypt($auction_Childs->id) }}'>
          <div class="form-group">
          <div class="form-group"><label for="username"><strong>Assign Item to Auction:*</strong></label>

          <select name="ac_parent_id" class="form-control parient_auction" id="parient_auction">
            <option></option>
           
            @isset ($auctions)
            @foreach ($auctions as $auction)
                <option value="{{  $auction->id }}" @if($auction->id==$auction_Childs->ac_parent_id) selected="" @else  @endif>{{ $auction->title }}</option>
                @endforeach    
            @endisset
            </select>
      </div>
      </div>
        <div class="form-group">
          <div class="form-group"><label for="username"><strong>Title</strong></label>
          <input class="form-control" type="text" placeholder="abc...." name="title" id="title" value="{{ $auction_Childs->title }}">
        </div>
      </div>
       <div class="form-group">
          <div class="form-group"><label for="username"><strong>Slug</strong></label>
        <input type="text" name="slug" id="post_slug" class="form-control" value="{{ $auction_Childs->slug }}" placeholder="Slug">
        </div>
      </div>
      <div class="form-group">
        <div class="form-group"><label for="username"><strong>Content</strong></label>
        <textarea name="description" rows="4" id="content_auction" cols="50" class="form-control">{{ $auction_Childs->description }}</textarea>
      </div>
    </div>

     <div class="form-group">
        <div class="form-group"><label for="username"><strong>Start Price</strong></label>
         <input class="form-control" type="number" min="0" placeholder="123456" name="start_price" id="start_price" value="{{ $auction_Childs->start_price }}" step="any">
      </div>
    </div>

    <div class="form-group">
      <div class="form-group"><label for="username"><strong>Image Gallery (jpeg,png,jpg,gif,svg|max:2048') Only:</strong></label>
      <input class="form-control" type="file" name="gallery[]" multiple="multiple" accept="image/*">
    </div>

    <ul class="list-group list-group-horizontal">

    @isset ($auction_Childs->gallery)
    @if (!empty($auction_Childs->gallery))
    @foreach (explode(',', $auction_Childs->gallery) as $element)
    <li class="list-group-item">
    <img src="{{ asset('img') }}/{{ $element }}" alt="imggall" class="img-fluid" width="150" height="150">
  </li>  
    @endforeach
     <input type="hidden" name="hidden_gallery" value="{{ $auction_Childs->gallery }}" />
    @endif
    @endisset

</ul>
  </div>
    <div class="form-group">
      <div class="form-group"><label for="username"><strong>Upload Video (mp4,ogx,oga,ogv,ogg,webm) Only:</strong></label>
      <input class="form-control" type="file" name="upload_video"  onchange="ValidateSize(this)" accept="video/*">

    </div>
    @isset ($auction_Childs->upload_video)
    @if (!empty($auction_Childs->upload_video))

    <video width="320" height="240"  controls>
   <source src="{{ asset('videos') }}/{{ $auction_Childs->upload_video}}">
</video> 
   <input type="hidden" name="hidden_video" value="{{ $auction_Childs->upload_video }}" />
    @endif
     @endisset
   

  </div>
    <div class="form-group">
      <div class="form-group"><label for="username"><strong>Video Link</strong></label>
      <input class="form-control" type="text" name="video_link" value="{{ $auction_Childs->video_link}}" placeholder="https://www.youtube.com/watch?v=8up_dNUqM2w&ab_channel=FasigTiptonCo">
    </div>
  </div>
  <div class="form-row">
    <div class="col">
      <div class="form-group"><label for="first_name"><strong>Start Date Time</strong></label><input class="form-control" type="text" placeholder="Start Date Time" name="start_datetime" id="date_timepicker_start" value="{{CH::GetCilentDatetime($auction_Childs->start_datetime)}}"></div>
    </div>
    <div class="col">
      <div class="form-group"><label for="last_name"><strong>End Date Time</strong></label><input class="form-control" type="text" name="end_datetime" id="date_timepicker_end" value="{{CH::GetCilentDatetime($auction_Childs->end_datetime)}}" placeholder="End Date Time"></div>
    </div>
  </div>
    <input type="hidden" class="post_id"  value="{{ $auction_Childs->id }}">
 
  <div id="appendCustomFields">
    
  </div>
    <div class="form-group">
      <div class="form-group"><label for="username"><strong>Status</strong></label>
    <select name="status" class="form-control">
      @if ($auction_Childs->status=='on')
      <option value="on" selected="">Active</option>
      <option value="off">Deactive</option>
      @else
       <option value="on">Active</option>
      <option value="off" selected="">Deactive</option>
      @endif
   
    </select>
    </div>
  </div>

  <div class="form-group">
  <div class="form-group"><label for="username"><strong>Bidding Price Interval (Enabling this button will override the default conditions(age and is ridden) for bidding interval, and you can define your own bidding interval for this post.)</strong></label>
    <br> 
  <label class="switch">
  @if (!empty($auction_item_condition->status) && $auction_item_condition->status=='on')
  <input type="checkbox" id="checking" name="bidding_price_interval" checked="" value="on"/>
    @else
  <input type="checkbox" id="checking" name="bidding_price_interval"  value="off"/>
    @endif>
  <span class="slider"></span>
   </label>
    </div>  
  </div>
<div class="biddingIntervalfiled">
@if (!empty($auction_item_condition->status) && $auction_item_condition->status=='on')
  <div class="col-sm-6"><div class="form-group"><label for="username"><strong>Amount</strong></label> <input class="form-control" value="{{ $auction_item_condition->inc_amount }}" type="number" min="0" placeholder="123456" name="bidinterval_price" id="bidinterval_price"  step="any" required=""><div></div>

    @else

    @endif
</div>
</div>
</div>
</div>
  <div class="form-group"><button class="custompostionbtn btn btn-success btn-sm shadow-lg border border-success " type="submit">Update Auction Item</button>
  {{-- <a  href="{{ route('auction_item_dashboard') }}" class="btn btn-light btn-lg shadow-lg border border-dark" type="submit">Go Back To All Auction Items</a> --}}</div>
</form>
</div>

</div>
</div>
<!-- /.container-fluid -->
@endsection
@section("footer")
@parent
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
 <script src="{{ asset('js/select2.min.js') }}"></script>
 <link href="{{ asset('css/toaster.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/toaster.min.js') }}"></script>
<script>

  function ValidateSize(file) {

        var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 20) {
          
          toastr.options.closeButton = true;
          toastr.error('Uploaded File Size is Greater then 20 Mb','',{timeOut: 3000})
        } else {

        }
    }
CKEDITOR.replace( 'content_auction', {
height: 300,

});



$(document).ready(function(){


 
var parient_auction=$('#parient_auction').val();




 $.ajax({
url:"{{ route('get_specific_Auctions_Date_Time_ajax') }}",
type:"POST",
dataType:"json",
data:{parient_auction:parient_auction,_token:"{{ csrf_token() }}"},
success:function(res)
{


console.log(res);

var str=convertUTCDateToLocalDate(new Date(res.start_datetime));

var end=convertUTCDateToLocalDate(new Date(res.end_datetime));




jQuery('#date_timepicker_start').datetimepicker({
  format:'Y-m-d H:i:s',
 
onShow:function( ct ){
this.setOptions({
minDate:str,
maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false,
}) 
},
timepicker:true
});
jQuery('#date_timepicker_end').datetimepicker({
  format:'Y-m-d H:i:s',

onShow:function( ct ){
this.setOptions({
minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false,
maxDate:end
})
},
timepicker:true
});


},
 error: function(XMLHttpRequest, textStatus, errorThrown) { 
        console.log("Status: " + textStatus); console.log("Error: " + errorThrown);console.log("Error: " + errorThrown); 
    }   

});





 $(".parient_auction").change(function() {


  $('#date_timepicker_start').val('');
  $('#date_timepicker_end').val('');
 
var parient_auction=$(this).val()


 $.ajax({
url:"{{ route('get_specific_Auctions_Date_Time_ajax') }}",
type:"POST",
dataType:"json",
data:{parient_auction:parient_auction,_token:"{{ csrf_token() }}"},
success:function(res)
{


var str=convertUTCDateToLocalDate(new Date(res.start_datetime));

var end=convertUTCDateToLocalDate(new Date(res.end_datetime));

jQuery('#date_timepicker_start').datetimepicker({
  format:'Y-m-d H:i:s',
 
onShow:function( ct ){
this.setOptions({
minDate:str,
maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false,
}) 
},
timepicker:true
});
jQuery('#date_timepicker_end').datetimepicker({
  format:'Y-m-d H:i:s',

onShow:function( ct ){
this.setOptions({
minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false,
maxDate:end
})
},
timepicker:true
});

$('#born').datetimepicker({
  datepicker:true,
  format:'Y-m-d'
});

},
 error: function(XMLHttpRequest, textStatus, errorThrown) { 
        console.log("Status: " + textStatus); console.log("Error: " + errorThrown);console.log("Error: " + errorThrown); 
    }   

});

});




   var post_type=$('.post_type').val();
   var post_id=$('.post_id').val();
function isEmpty(str) {
    return (!str || 0 === str.length);
}
 

function getupdateCustomFields(postType,post_id) 
{


  $.ajax({
url:"{{ route('edit_customFieldTo_Post_ajax') }}",
type:"POST",
dataType:"html",
data:{postType:postType,post_id:post_id,_token:"{{ csrf_token() }}"},
success:function(res)
{
$('#appendCustomFields').html(res);
$('#born').datetimepicker({
  datepicker:true,
  format:'Y-m-d'
});
},
 error: function(XMLHttpRequest, textStatus, errorThrown) { 
        console.log("Status: " + textStatus); console.log("Error: " + errorThrown);console.log("Error: " + errorThrown); 
    }   

});


}
if(!isEmpty(post_type)){

getupdateCustomFields(post_type,post_id);


}

$('.post_type').on("change", function() {


 var post_id=$('.post_type').val();
if(!isEmpty($(this).val())){

getupdateCustomFields($(this).val(),post_id);

}


});


  $('.parient_auction').select2({ placeholder: "Select Parient Auction",
    allowClear: true});
  function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/[^\w ]+/g,'')
        .replace(/ +/g,'_')
        ;
}
  $("#title").change(function(){
    var slug=convertToSlug($(this).val());

    $('#post_slug').val(slug);

  });
});



$("#checking").change(function() {
    if($(this).prop('checked')) {
       $(this).val('on')
   var temp='<div class="col-sm-6"><div class="form-group"><label for="username"><strong>Amount</strong></label> <input class="form-control" type="number" min="0" placeholder="123456" name="bidinterval_price" id="bidinterval_price"  step="any" required></div></div>';

   $('.biddingIntervalfiled').html(temp);

    } else {
       $(this).prop('checked', false);
       $(this).val('off');
        var temp2='';
         $('.biddingIntervalfiled').html(temp2);

    }
});

 $('.born').datetimepicker();
</script>
<style type="text/css" media="screen">
  .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
@endsection