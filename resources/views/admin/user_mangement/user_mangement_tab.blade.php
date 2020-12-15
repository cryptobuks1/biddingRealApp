
<button type="button" class="btn btn-primary  pull-right" data-toggle="modal" data-target="#userModal" style="margin-top: 3px">  <i class="fa fa-plus"></i> Add User
</button>
<!-- insert user Modal -->
<div class="modal fade" id="userModal" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content--> 
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Register New User</h4>
			</div>
			<div class="modal-body">
				{{-- form start  --}}
				<form method="POST" action="{{ route('insert_user') }}">
					@csrf
					<div class="form-group row">
						<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

						<div class="col-md-6">
							<input  type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

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
							<input type="email" class="form-control" name="email" value="{{ old('email') }}"  required/>

							@if ($errors->has('email')) 
							<span class="invalid-feedback" role="alert">
								<strong class="form-text text-muted text-danger">{{ $errors->first('email') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="form-group row">
						<label  class="col-md-4 col-form-label text-md-right">{{ __('Business Name') }}</label>

						<div class="col-md-6">
							<input type="text" class="form-control" name="business" value="{{ old('business') }}"  required/>

							@if ($errors->has('business')) 
							<span class="invalid-feedback" role="alert">
								<strong class="form-text text-muted text-danger">{{ $errors->first('business') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="form-group row">
						<label  class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="phone" value="{{ old('phone') }}"  required/>

							@if ($errors->has('phone')) 
							<span class="invalid-feedback" role="alert">
								<strong class="form-text text-muted text-danger">{{ $errors->first('phone') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="form-group row">
						<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

						<div class="col-md-6">
							<input  type="password" class="form-control" name="password" required>

							@if ($errors->has('password'))
							<span class="invalid-feedback" role="alert">
								<strong  class="form-text text-muted text-danger">{{ $errors->first('password') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="form-group row">
						<label for="password-confirm" class="col-md-4 col-form-label text-md-right">Select Role</label>

						<div class="col-md-6">
							<select name="role" class="form-control"  aria-describedby="group_msg" required>
								<option value="">Select Role</option>
								@foreach($allroles as $role)
								<option value="{{$role->id}}">{{ $role->role}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">
							Save
						</button>  
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
				{{-- end form --}}
			</div>
		</div>
	</div>
</div>
{{-- user insert modal ends here --}}
<div class="panel panel-success" style="margin-top: 15px">
  <div class="panel-heading">Users</div>
  <div class="panel-body">
	<table class="table table-striped table-bordered table-hover" id="dataTableAuction">
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Email</th>
				<th>Role</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		
		</tbody>
	</table>
  </div>
</div>



		