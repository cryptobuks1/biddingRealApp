{{-- extend  --}}
@extends('admin-layout.app')
@extends('includes-admin.header')
@extends('includes-admin.footer')
@extends('includes-admin.sidebar')
{{-- page titles --}}
@section('title', ' Roles Authority')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Add Auction</h1>
      <a href="{{ route('auction_dashboard') }}" class="btn-primary btn btn-sm shadow-lg border-0">Go Back</a>
  </div>
  <div class="card shadow mb-4">
    
    <div class="card-body">
 
      <form method="POST" action="{{ route('insert_Auction') }}" enctype="multipart/form-data">

        @csrf

       @php
        CH::PostType();
        CH::AllUserShow();
        @endphp


        <input type="hidden" name="slug" id="post_slug" value="{{ old('slug') }}">
        <div class="form-group">
          <div class="form-group"><label for="username"><strong>Title</strong></label>
          <input class="form-control" type="text" placeholder="abc...." name="title" id="title" value="{{ old('title') }}">
        </div>
      </div>
      <div class="form-group">
        <div class="form-group"><label for="username"><strong>Content</strong></label>
        <textarea name="description" rows="4" id="content_auction" cols="50" class="form-control">{{ old('description') }}</textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="form-group"><label for="username"><strong>Feature Image</strong></label>
      <input class="form-control " type="file" name="featured_img" accept="image/*">
    </div>
  </div>
  <div class="form-row">
    <div class="col">
      <div class="form-group"><label for="first_name"><strong>Start Date Time</strong></label><input class="form-control" type="text" placeholder="John" name="start_datetime" id="date_timepicker_start" value="{{ old('start_datetime') }}"></div>
    </div>
    <div class="col">
      <div class="form-group"><label for="last_name"><strong>End Date Time</strong></label><input class="form-control" type="text" name="end_datetime" id="date_timepicker_end" value="{{ old('end_datetime') }}"></div>
    </div>
  </div>


       <div class="form-group">
          <div class="form-group"><label for="username"><strong>Organization Name</strong></label>
          <input class="form-control" type="text" placeholder="abc...." name="org_name" id="org_name" value="{{ old('org_name') }}">
        </div>
      </div>

        <div class="form-group">
      <div class="form-group"><label for="username"><strong>Organization Image</strong></label>
      <input class="form-control " type="file" name="org" accept="image/*">
    </div>
  </div>


    <div class="form-group">
      <div class="form-group"><label for="username"><strong>Status</strong></label>
    <select name="status" class="form-control">
      <option value="on">Active</option>
      <option value="off">Deactive</option>
   
    </select>
    </div>
  </div>
  <div class="form-group"><button class="custompostionbtn btn btn-success btn-sm shadow-lg border border-success" type="submit">Save Auction</button>
  {{-- <a  href="{{ route('auction_dashboard') }}" class="btn btn-light btn-lg shadow-lg border border-dark" type="submit">Go Back To All Auction</a> --}}</div>
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