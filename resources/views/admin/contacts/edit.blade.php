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
    <h1 class="h3 mb-0 text-gray-800"> Edit Contact</h1>
       <a href="{{ route('contact_admin') }}" class="btn-primary btn btn-sm shadow-lg border-0">Go Back</a>
  </div>
  <div class="card shadow mb-4">
    
    <div class="card-body">
 
      <form method="POST" action="{{ route('update_contact_admin') }}" enctype="multipart/form-data">

        @csrf


        <input type="hidden" name="contact_id" value='{{ Crypt::encrypt($conatct->id) }}'>
          <div class="form-group">
          <div class="form-group"><label for="username"><strong>Name</strong></label>
          <input class="form-control" type="text" placeholder="Jhon deo" name="name" id="name" value="{{ $conatct->name }}">
        </div>
      </div>
      <div class="form-group">
          <div class="form-group"><label for="username"><strong>subject</strong></label>
          <input class="form-control" type="text" placeholder="abc" name="subject" id="subject" value="{{ $conatct->subject }}">
        </div>
      </div>
        <div class="form-group">
          <div class="form-group"><label for="username"><strong>Phone</strong></label>
          <input class="form-control" type="text" placeholder="+9234675878" name="phone" id="phone" value="{{ $conatct->phone }}">
        </div>
      </div>
        <div class="form-group">
          <div class="form-group"><label for="username"><strong>Email</strong></label>
          <input class="form-control" type="text" placeholder="abc@gamil.com" name="email" id="email" value="{{ $conatct->email }}">
        </div>
      </div>
      <div class="form-group">
        <div class="form-group"><label for="username"><strong>Content</strong></label>
        <textarea name="description" rows="4" id="content_auction" cols="50" class="form-control">{{ $conatct->description }}</textarea>
      </div>
    </div>

 

   <div class="form-group">
      <div class="form-group"><label for="username"><strong>Created Date</strong></label>
      <input class="form-control " type="text" name="create_datetime" id="date_timepicker_start" value="{{CH::GetCilentDatetime($conatct->create_datetime ) }}">
    </div>
  </div>


 <div class="form-group">
      <div class="form-group"><label for="username"><strong>Terms Agree</strong></label>
    <select name="is_agree" class="form-control">

      @if ($conatct->is_agree=='yes')
      <option value="yes" selected="">Yes</option>
      <option value="no">No</option>
      @else
       <option value="yes">Yes</option>
      <option value="no" selected="">No</option>
      @endif
     
   
    </select>
    </div>
  </div>

    <div class="form-group">
      <div class="form-group"><label for="username"><strong>Is Read</strong></label>
    <select name="status" class="form-control">

      @if ($conatct->status=='on')
      <option value="on" selected="">Yes</option>
      <option value="off">No</option>
      @else
       <option value="on">Yes</option>
      <option value="off" selected=""> No</option>
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