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
    <h1 class="h3 mb-0 text-gray-800"> Edit User</h1>
       <a href="{{ route('user_mangement_homepanel') }}" class="btn-primary btn btn-sm shadow-lg border-0">Go Back</a>
  </div>
  <div class="card shadow mb-4">
    
    <div class="card-body">
 
   <form method="POST" action="{{ route('edit_user',['id'=> $user->id]) }}">
                @csrf
                <div class="form-group row">
                  <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                  <div class="col-md-6">
                    <input  type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

                    @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                      <strong class="form-text text-muted text-danger">{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                  </div>
                </div> 
                <div class="form-group row">
                  <label  class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                  <div class="col-md-6">
                    <input type="email" class="form-control" name="email" value="{{$user->email}}"  required/>
                    @if ($errors->has('email')) 
                    <span class="invalid-feedback" role="alert">
                      <strong class="form-text text-muted text-danger">{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>

                   <div class="form-group row">
                  <label  class="col-md-4 col-form-label text-md-right">Password</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="password"  id="passwordchnage">
                    @if ($errors->has('password')) 
                    <span class="invalid-feedback" role="alert">
                      <strong class="form-text text-muted text-danger">{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>

                 <div class="form-group row">
                  <label  class="col-md-4 col-form-label text-md-right">Phone</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="phone" value="{{$user->phone}}"  required/>
                    @if ($errors->has('phone')) 
                    <span class="invalid-feedback" role="alert">
                      <strong class="form-text text-muted text-danger">{{ $errors->first('phone') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>


                 <div class="form-group row">
                  <label  class="col-md-4 col-form-label text-md-right">Vat Number</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="vat_number" value="{{$user->vat_number}}"  required/>
                    @if ($errors->has('vat_number')) 
                    <span class="invalid-feedback" role="alert">
                      <strong class="form-text text-muted text-danger">{{ $errors->first('vat_number') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>

                 <div class="form-group row">
                  <label  class="col-md-4 col-form-label text-md-right">Address</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="address" value="{{$user->address}}"  required/>
                    @if ($errors->has('address')) 
                    <span class="invalid-feedback" role="alert">
                      <strong class="form-text text-muted text-danger">{{ $errors->first('address') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>

                 <div class="form-group row">
                  <label  class="col-md-4 col-form-label text-md-right">Business Name</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="business_name" value="{{$user->business_name}}"  required/>
                    @if ($errors->has('business_name')) 
                    <span class="invalid-feedback" role="alert">
                      <strong class="form-text text-muted text-danger">{{ $errors->first('business_name') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
         
                <div class="form-group row">
                  <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Select Role</label>

                  <div class="col-md-6">
                    <select name="role" class="form-control user_assgine_role"  aria-describedby="group_msg" required>
                      <option value="">Select Role</option>
                      @foreach($allroles as $role)
                      <option value="{{$role->id}}" {{ ($user->role_id == $role->id) ? 'selected' : '' }}>{{ $role->role}}</option>
                      @endforeach
                    </select>
                  </div>
                  @if ($errors->has('role'))
                  <span class="invalid-feedback" role="alert">
                <strong class="form-text text-muted text-danger">{{ $errors->first('role') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                
                </div>
              </form>
</div>

</div>
</div>
<!-- /.container-fluid -->
@endsection
@section("footer")
@parent
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
 <script src="{{ asset('js/sweetalert.min.js') }}"></script>
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