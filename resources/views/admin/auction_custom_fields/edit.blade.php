{{-- extend  --}}
@extends('admin-layout.app')
@extends('includes-admin.header')
@extends('includes-admin.footer')
@extends('includes-admin.sidebar')
{{-- page titles --}}
@section('title', 'Edit Post Custom Field')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Edit Post Custom Field</h1>
      <a href="{{ route('acf_dashboard') }}" class="btn-primary btn btn-sm shadow-lg border-0">Go Back</a>
  </div>
  <div class="card shadow mb-4">
    
    <div class="card-body">
 
      <form method="POST" action="{{ route('Update_Acf_fields') }}" enctype="multipart/form-data">

        @csrf

         <input type="hidden" name="updateAcf_id" value="{{ $acfdata->id }}">
         <input type="hidden" name="acfslug" value="{{ $acfdata->slug }}">
          <input type="hidden" name="acfptype" value="{{ $acfdata->post_type }}">
        <div class="form-group">
          <div class="form-group"><label for="username"><strong>Name</strong></label>
      <input class="form-control" type="text" placeholder="abc...!" name="name" value="{{ $acfdata->name }}">
        </div>
      </div>

    

        <div class="form-group">
          <div class="form-group"><label for="username"><strong>Field Type</strong></label>
          <select name="field_type" class="form-control">
           <option value="">Select Field Type </option>
           <option value="text"@if ($acfdata->field_type=='text') selected="" @endif>Text Field</option>
            <option value="file"@if ($acfdata->field_type=='file') selected="" @endif>File</option>
             <option value="gender"@if ($acfdata->field_type=='gender') selected="" @endif>Gender</option>
           <option value="textarea"@if ($acfdata->field_type=='textarea') selected="" @endif>Text Area</option>
           <option value="number"@if ($acfdata->field_type=='number') selected="" @endif>Number</option>
           <option value="email"@if ($acfdata->field_type=='email') selected="" @endif>Email</option>

            <option value="isridden" @if ($acfdata->field_type=='isridden') selected="" @endif>IS Ridden</option>
           
    </select>
        </div>
      </div>

        <div class="form-group">
          <div class="form-group"><label for="username"><strong>Already Type Replace Meta with</strong></label>
          <select name="already_field_type" class="form-control">
           <option value="">Select Field Type</option>
           <option value="gender">Gender</option>
            <option value="file">File</option>
             <option value="isridden">IS Ridden</option>
           <option value="text">Text Field</option>
           <option value="textarea">Text Area</option>
           <option value="number">Number</option>
           <option value="email">Email</option>
          
    </select>
        </div>
      </div>

        <div class="form-group">
          <div class="form-group"><label for="username"><strong> Css Class</strong></label>
          <input class="form-control" type="text" placeholder="abc...." name="css_class"  value="{{ $acfdata->css_class }}">
        </div>
      </div>
        <div class="form-group">
          <div class="form-group"><label for="username"><strong>Css Id</strong></label>
          <input class="form-control" type="text" placeholder="abc...." name="css_id"  value="{{ $acfdata->css_id }}">
        </div>
      </div>
      <div class="form-group">
          <div class="form-group"><label for="username"><strong>Placeholder</strong></label>
          <input class="form-control" type="text" placeholder="Placeholder value" name="placeholder"  value="{{ $acfdata->placeholder }}">
        </div>
      </div>

        <div class="form-group">
          <div class="form-group"><label for="username"><strong>Requried</strong></label>
         <select name="required" class="form-control">
         <option value="no"@if ($acfdata->required=='no') selected="" @endif>no</option>
         <option value="required"@if ($acfdata->required=='required') selected="" @endif>yes</option>
   
    </select>
        </div>
      </div>
    
    <div class="form-group">
      <div class="form-group"><label for="username"><strong>Status</strong></label>
    <select name="status" class="form-control">
      <option value="on"@if ($acfdata->status=='on') selected="" @endif>Active</option>
      <option value="off"@if ($acfdata->status=='off') selected="" @endif>Deactive</option>
   
    </select>

    </div>
  </div>
  <div class="form-group"><button class="custompostionbtn btn btn-success btn-sm shadow-lg border border-success" type="submit">Update Custom Field</button>
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