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
    <h1 class="h3 mb-0 text-gray-800"> View Auction Item: <strong class="text-danger">{{ $auction_Childs->title }}</strong></h1>
      <a href="{{ route('auction_item_dashboard') }}" class="btn-primary btn btn-sm shadow-lg border-0">Go Back</a>
  </div>
  <div class="card shadow mb-4">
    
    <div class="card-body">
 
      <form method="POST" action="{{ route('update_Auction_item') }}" enctype="multipart/form-data">

        @csrf

             @php
           CH::PostTypeAlreadySelected($auction_Childs->post_type); 
          @endphp
      
           <input type="hidden" name="aucitem_id" value='{{ Crypt::encrypt($auction_Childs->id) }}'>
          <div class="form-group">
          <div class="form-group"><label for="username"><strong>Assign Item to Auction:*</strong></label>

          <select name="ac_parent_id" class="form-control " readonly>
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
          <input class="form-control" type="text" placeholder="abc...." name="title" id="title" value="{{ $auction_Childs->title }}" readonly>
        </div>
      </div>
       <div class="form-group">
          <div class="form-group"><label for="username"><strong>Slug</strong></label>
        <input type="text" name="slug" id="post_slug" class="form-control" value="{{ $auction_Childs->slug }}" placeholder="Slug" readonly>
        </div>
      </div>
      <div class="form-group">
        <div class="form-group"><label for="username"><strong>Content</strong></label>

         
     {{!! $auction_Childs->description !!}}
      </div>
    </div>

     <div class="form-group">
        <div class="form-group"><label for="username"><strong>Start Price</strong></label>
         <input class="form-control" type="number" min="0" placeholder="123456" name="start_price" id="start_price" value="{{ $auction_Childs->start_price }}" readonly>
      </div>
    </div>

    <div class="form-group">
        <div class="form-group"><label for="username"><strong>Gallery </strong></label>
    
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
      <div class="form-group"><label for="username"><strong>Video </strong></label>
    
    </div>
    @isset ($auction_Childs->upload_video)
    @if (!empty($auction_Childs->upload_video))

    <video width="400" height="400"  controls>
   <source src="{{ asset('videos') }}/{{ $auction_Childs->upload_video}}">
</video> 
   <input type="hidden" name="hidden_video" value="{{ $auction_Childs->upload_video }}" />
    @endif
     @endisset
   

  </div>
    <div class="form-group">
      <div class="form-group"><label for="username"><strong>Video Link</strong></label>
      <input class="form-control" type="text" name="video_link" value="{{ $auction_Childs->video_link}}" placeholder="https://www.youtube.com/watch?v=8up_dNUqM2w&ab_channel=FasigTiptonCo" readonly>
    </div>
  </div>
  <div class="form-row">
    <div class="col">
      <div class="form-group"><label for="first_name"><strong>Start Date Time</strong></label><input class="form-control" type="text" placeholder="Start Date Time" name="start_datetime"  value="{{CH::GetCilentDatetime($auction_Childs->start_datetime)}}" readonly></div>
    </div>
    <div class="col">
      <div class="form-group"><label for="last_name"><strong>End Date Time</strong></label><input class="form-control" type="text" name="end_datetime"  value="{{CH::GetCilentDatetime($auction_Childs->end_datetime)}}" placeholder="End Date Time" readonly></div>
    </div>
  </div>

    <div class="form-group">
      <div class="form-group"><label for="username"><strong>Status</strong></label>
    <select name="status" class="form-control"  readonly>
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
  <a  href="{{ route('auction_item_dashboard') }}" class="btn btn-light btn-lg shadow-lg border border-dark" type="submit">Go Back To All Auction Items</a></div>
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

jQuery(function(){
jQuery('#date_timepicker_start').datetimepicker({
  format:'Y-m-d H:i:s',
 
onShow:function( ct ){
this.setOptions({
maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
}) 
},
timepicker:true
});
jQuery('#date_timepicker_end').datetimepicker({
  format:'Y-m-d H:i:s',

onShow:function( ct ){
this.setOptions({
minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
})
},
timepicker:true
});
});

$(document).ready(function(){


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
</script>

@endsection