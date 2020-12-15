   {{-- <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#roleModal" style="margin-top: 3px">  <i class="fa fa-plus"></i> Add Role
   </button> --}}
   <!-- Modal -->
   <div class="modal fade" id="roleModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create New Role</h4>
        </div>
        <div class="modal-body">
         {{-- form start  --}} 
         <form method="post" action="{{ route('insert_user_role') }}" enctype="multipart/form-data">
           @csrf
           <div class="form-group">
            <label for="role">Role Name <span class="text-danger">*</span></label>
            <input type="text" name="role_name"  class="form-control" aria-describedby="role" placeholder="Role Name"required>
            <small id="name" class="form-text text-muted text-danger">{{$errors->first('role_name')}}</small>
          </div>
          <div class="form-group">
            <label for="status"> Status</label>
            <select name="status" class="form-control" aria-describedby="status" required>
              <option value="">Select Status</option>

              <option value="1">Active</option>
              <option value="0">Deactive</option>


            </select>
            <small id="unit_msg" class="form-text text-muted text-danger">{{$errors->first('status')}}</small>
          </div>
        </div>
        <div class="modal-footer">
         <button type="submit" class="btn btn-primary">Save</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </form>
       {{-- form end --}}  
   </div>
 </div>
</div>
</div>
<!--ends  Modal -->
<div class="panel panel-success" style="margin-top: 15px">
  <div class="panel-heading">Roles</div>
  <div class="panel-body">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
      <thead>
        <tr>
          <th>Sr #</th>
          <th>Role Name</th>
          <th>Status</th>
          <th>Action</th> 
        </tr>
      </thead>
      <tbody>  
        @foreach($allroles as $role)
        <tr class="odd gradeX">
          <td>{{ $role->id }}</td>
          <td>{{ $role->role }}</td>
          @if($role->status ==1)         
          <td><label class="label label-success">Active</label></td>         
          @else
          <td><label class="label label-danger">Deactive</label></td>        
          @endif
          <td>
            <a class="btn btn-xs btn-warning" type="button" class="" data-toggle="modal" data-target="#edit{{ $role->id }}">  <i class="fa fa-edit"></i>
            </a>
           {{--  <a class="btn btn-xs btn-danger" href="{{ route('delete_role',['id'=> $role->id]) }}" class=""> <i class="fa fa-trash"></i> </a> --}}
          </td>
        </tr>
        {{-- Edit Role Modal --}}
        <div class="modal fade" id="edit{{$role->id }}" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Role</h4>
              </div>
              <div class="modal-body">
               <form method="post" action="{{ route('edit_role',['id'=> $role->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="role">Role Name <span class="text-danger">*</span></label>
                  <input type="text" name="role_name"  class="form-control"  aria-describedby="role" placeholder="Role Name" value="{{ $role->role }}" required>
                  <small  class="form-text text-muted text-danger">{{$errors->first('role_name')}}</small>
                </div>
                <div class="form-group">
                  <label for="status"> Status</label>
                  <select name="status" class="form-control"  aria-describedby="status" required>
                    @if($role->status==1)
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                    @else
                    <option value="0">Deactive</option>
                    <option value="1">Active</option>
                    @endif
                  </select>
                  <small id="unit_msg" class="form-text text-muted text-danger">{{$errors->first('status')}}</small>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!--ends  Modal -->
      @endforeach
    </tbody>
    </table>
  </div>
</div>
