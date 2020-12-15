<div class="panel panel-success" style="margin-top: 15px">
  <div class="panel-heading">Roles</div>
  <div class="panel-body">
	<form method="post" action="{{ url('user_mangement/addauthority') }}">
		<div class="form-group">
		  @csrf
		  <input type="hidden" name="parent_id" id="auth_id">
		  <label for="role-auth">Select Role <span class="text-danger">*</span></label>
		  <select name="role" class="form-control" id="role-auth" aria-describedby="role_msg">
		  	<option value="">Select role</option>
		  	@foreach($allroles as $role)
		  		<option value="{{$role->id}}">{{$role->role}}</option>
		  	@endforeach
		  </select>
		  <small id="role_msg" class="form-text text-muted text-danger">{{$errors->first('role')}}</small>
		</div>
		<div id="html"></div>
		<button type="button" id="addauthority" class="btn btn-primary">Submit</button>
	</form>
  </div>
</div>

