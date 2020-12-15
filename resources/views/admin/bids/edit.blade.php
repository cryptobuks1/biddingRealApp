{{-- extend  --}}
@extends('admin-layout.app')
@extends('includes-admin.header')
@extends('includes-admin.footer')
@extends('includes-admin.sidebar')
{{-- page titles --}}
@section('title', 'Edit Auction')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Edit Auction</h1>
       <a href="{{ route('bidAdmin') }}" class="btn-primary btn btn-sm shadow-lg border-0">Go Back</a>
  </div>
  <div class="card shadow mb-4">
    
    <div class="card-body">
 
      <form method="POST" action="{{ route('bidAdminUpdate') }}" enctype="multipart/form-data">

        @csrf


        

        <input type="hidden" name="bid_id" value='{{ Crypt::encrypt($bid->id) }}'>
        <div class="form-group">
          <div class="form-group"><label for="username"><strong>Amount</strong></label>
          <input class="form-control" type="number" name="amount" id="amount" value="{{ $bid->amount }}" step="any">
        </div>
      </div>

        <div class="form-group">
          <div class="form-group"><label for="username"><strong>Bid Time</strong></label>
          <input class="form-control" type="text" name="bdatetime" id="bdatetime" value="{{ $bid->bdatetime }}" readonly="">
        </div>
      </div>
     
     <div class="form-group">
      <div class="form-group"><label for="username"><strong>Winner</strong></label>
    <select name="win" class="form-control">

      @if ($bid->win=='on')
      <option value="on" selected="">Yes</option>
      <option value="off">No</option>
      @else
       <option value="on">Yes</option>
      <option value="off" selected="">No</option>
      @endif
     
   
    </select>
    </div>
  </div>
      <div class="form-group">
      <div class="form-group"><label for="username"><strong>Sold</strong></label>
    <select name="sold" class="form-control">

      @if ($bid->sold=='on')
      <option value="on" selected="">Yes</option>
      <option value="off">No</option>
      @else
       <option value="on">Yes</option>
      <option value="off" selected="">No</option>
      @endif
     
   
    </select>
    </div>
  </div>

    <div class="form-group">
      <div class="form-group"><label for="username"><strong>Status</strong></label>
    <select name="status" class="form-control">

      @if ($bid->status=='on')
      <option value="on" selected="">Active</option>
      <option value="off">Deactive</option>
      @else
       <option value="on">Active</option>
      <option value="off" selected="">Deactive</option>
      @endif
     
   
    </select>
    </div>
  </div>

   
  <div class="form-group"><button class=" custompostionbtn btn btn-success btn-sm shadow-lg border border-success" type="submit">Update </button>
{{--   <a  href="{{ route('auction_dashboard') }}" class="btn btn-light btn-lg shadow-lg border border-dark" type="submit">Go Back To All Auction</a> --}}</div>
</form>
</div>

</div>
</div>
<!-- /.container-fluid -->
@endsection
@section("footer")
@parent
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>

<script>
CKEDITOR.replace( 'content_auction', {
height: 300,
filebrowserUploadUrl: "upload.php"
});

jQuery(function(){
jQuery('#date_timepicker_start').datetimepicker({
  format:'Y-m-d H:i:s',

  mask:true,
onShow:function( ct ){
this.setOptions({
maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
}) 
},
timepicker:true
});
jQuery('#date_timepicker_end').datetimepicker({
 format:'Y-m-d H:i:s',

  mask:true,
onShow:function( ct ){
this.setOptions({
minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
})
},
timepicker:true
});
});

$(document).ready(function(){
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