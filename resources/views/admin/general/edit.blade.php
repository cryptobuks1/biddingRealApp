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
    <h1 class="h3 mb-0 text-gray-800"> Edit Generals</h1>
      
  </div>
  <div class="card shadow mb-4">
    
    <div class="card-body">


 
      <form method="POST" action="{{ route('setEnvironmentValueandGenerals') }}" enctype="multipart/form-data">

        @csrf



      
    <div class="form-group">
        <div class="form-group"><label for="username"><strong>Header Logo</strong></label>
        <input type="file" name="hlogo" class="form-control" accept="image/*" >

        <input type="hidden" name="hlogohidden" class="form-control" value="{{ config('custom_env_Variables.SITE_LOGO') }}" >
         <img src="{{ asset('img') }}/{{ config('custom_env_Variables.SITE_LOGO') }}" class="img-thumbnail" style="max-height:50px;" />
      </div>
    </div>



    <div class="form-group">
        <div class="form-group"><label for="username"><strong>Footer Logo</strong></label>
        <input type="file" name="flogo" class="form-control" accept="image/*" >
         <input type="hidden" name="flogohidden" class="form-control" value="{{ config('custom_env_Variables.SITE_LOGO_FOOTER') }}" >
         <img src="{{ asset('img') }}/{{ config('custom_env_Variables.SITE_LOGO_FOOTER') }}" class="img-thumbnail" style="max-height:50px;" />
      </div>
    </div>

     
      
      <div class="form-group">
        <div class="form-group"><label for="username"><strong>Address Contact Us</strong></label>
        <textarea name="address" rows="4" id="address_contact" cols="50" class="form-control" required>{{ $generals->address  }}</textarea>
      </div>
    </div>


  
      <div class="form-group">
        <div class="form-group"><label for="username"><strong>Address 2 Contact Us</strong></label>
        <textarea name="address2" rows="4" id="address_contact2" cols="50" class="form-control" required>{{ $generals->address2  }}</textarea>
      </div>
    </div>

     <div class="form-group">
        <div class="form-group"><label for="username"><strong>how To Bid</strong></label>
        <textarea name="howtoBid" rows="4" id="contenthowbid" cols="50" class="form-control" required>{{ $generals->howtoBid  }}</textarea>
      </div>
    </div>


    <div class="form-group">
        <div class="form-group"><label for="username"><strong>how To Bid Img</strong></label>
        <input type="file" name="howbidimg" class="form-control" accept="image/*">

        <input type="hidden" name="howbimghidden" value="{{ $generals->howtoBidimg  }}">
         <img src="{{ asset('img') }}/{{ $generals->howtoBidimg }}" class="img-thumbnail" style="max-height:50px;" />
      </div>
    </div>


    <div class="form-group">
        <div class="form-group"><label for="username"><strong>MAIL_FROM_ADDRESS</strong></label>
        <input type="text" name="MAIL_FROM_ADDRESS" class="form-control" value="{{ config('custom_env_Variables.MAIL_FROM_ADDRESS') }}" required>
      </div>
    </div>
 
   <div class="form-group">
        <div class="form-group"><label for="username"><strong>MAIL_FROM_NAME</strong></label>
        <input type="text" name="MAIL_FROM_NAME" class="form-control" value="{{ config('custom_env_Variables.MAIL_FROM_NAME') }}" required>
      </div>
    </div>

     <div class="form-group">
        <div class="form-group"><label for="username"><strong>MAIL_SUBJECT</strong></label>
        <input type="text" name="MAIL_SUBJECT" class="form-control"  value="{{ config('custom_env_Variables.MAIL_SUBJECT') }}" required>
      </div>
    </div>

      <div class="form-group">
        <div class="form-group"><label for="username"><strong>MAIL_TO_CONTACT</strong></label>
        <input type="text" name="MAIL_TO_CONTACT" class="form-control" value="{{ config('custom_env_Variables.MAIL_TO_CONTACT') }}" required>
      </div>
    </div>

     <div class="form-group">
        <div class="form-group"><label for="username"><strong>APP_URL</strong></label>
        <input type="text" name="APP_URL" class="form-control" value="{{ config('custom_env_Variables.APP_URL') }}" required> 
      </div>
    </div>

     <div class="form-group">
        <div class="form-group"><label for="username"><strong>APP_NAME</strong></label>
        <input type="text" name="APP_NAME" class="form-control" value="{{ config('custom_env_Variables.APP_NAME') }}" required> 
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
CKEDITOR.replace( 'contenthowbid', {
height: 200,

});

CKEDITOR.replace( 'address_contact2', {
height: 200,

});

CKEDITOR.replace( 'address_contact', {
height: 200,

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