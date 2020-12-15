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
    <h1 class="h3 mb-0 text-gray-800"> All Auctions</h1>
    
    <a href="{{ route('auction_addnew') }}" class="btn-success btn btn-sm shadow-lg border-0"> Add New Record</a>
  </div>
  <div class="card shadow mb-4">
    
    <div class="card-body">

      <form id="myform">
       <div class="row input-daterange">
        <div class="col-md-2">
          <input type="text" name="from_date" id="date_timepicker_start" class="form-control" placeholder="Start Date Time" readonly />
        </div>
        <div class="col-md-2">
          <input type="text" name="to_date" id="date_timepicker_end" class="form-control" placeholder="End Date Time" readonly />
        </div>
          <div class="col-md-2">
           {{ CH::PostType($label='no') }}
        
        </div>
          <div class="col-md-2">
          
          <select name="status" class="form-control" id="status">
           
                <option value="on" selected="">Active</option>
                <option value="off">Deactive</option>
            
            </select>
        </div>
        </form>
        <div class="col-md-2">
          <button type="button" name="filter" id="filter" class="btn btn-primary btn-block btn-block btn-sm shadow-lg border-0">Filter</button>
        </div>
        <div class="col-md-2">
          <button type="button" name="refresh" id="refresh" class="btn btn-danger btn-block btn-block btn-sm shadow-lg border-0"><i class="fas fa-sync-alt"></i></button>
        </div>
      </div>
      <div class="table-responsive table-striped table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
        
        <table  class="table dataTable my-0" id="dataTableAuction">
          <thead>
            <tr>
              <th>Image</th>
              <th>Title</th>
               <th>Type</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Status</th>
              <th>Operations</th>
            </tr>
          </thead>
          <tfoot>
    <tr>
     
              <th>Title</th>
               <th>Type</th>
  
              <th>Status</th>
    </tr>
</tfoot>
        </table>
        
      </div>
      
    </div>
    
  </div>
</div>
<!-- /.container-fluid -->
@endsection
@section("footer")
@parent
<!-- DataTables JavaScript -->
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<link href="{{ asset('css/toaster.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/toaster.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
$(document).on('click', '.deleteAuction', function(){
auction_id = $(this).attr('del-id');
swal({
title: "Are you sure?",
text: "Once deleted, you will not be able to recover this Record!",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((willDelete) => {
if (willDelete) {
$.ajax({
url:"{{ route('delete_Auctions_ajax') }}",
type:"POST",
dataType:"json",
data:{auction_id:auction_id,_token:"{{ csrf_token() }}"},
success:function(res)
{
if (res.status=='ok'){
$('#dataTableAuction').DataTable().destroy();
load_data();
toastr.options.closeButton = true;
toastr.success('Record Deleted SuccessFully...!','',{timeOut: 1000})
}else{
swal({
title: "Something Wrong",
text: "",
icon: "warning",
dangerMode: true,
timer: 3000
});
}
}
})
} else {
swal("Your Record is safe!");
}
})
});
// $('#dataTableAuction').DataTable({
// responsive: true
// });
// $('[data-toggle="tooltip"]').tooltip();
$('#date_timepicker_start').datetimepicker({
format:'Y-m-d H:i:s',
//mask:true,
onShow:function( ct ){
this.setOptions({
maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
})
},
timepicker:true
});
$('#date_timepicker_end').datetimepicker({
format:'Y-m-d H:i:s',
//mask:true,
onShow:function( ct ){
this.setOptions({
minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
})
},
timepicker:true
});
function load_data(from_date = '', to_date = '',status='', typep=''){



$('#dataTableAuction').DataTable({
processing: true,
serverSide: true,
responsive: true,
ajax:{
url: "{{ route('getall_Auctions_ajax') }}",
data:{from_date:from_date, to_date:to_date,status:status,typep:typep}
},
columns:[
{
data: 'featured_img',
name: 'image',
render: function(data, type, full, meta){
return "<img src={{ URL::to('/') }}/img/" + full.featured_img + " class='rounded-circle mr-1' width='60' height='60'/>";
},
orderable: false
},
{
data: 'title',
name: 'title',
},
{
data: 'post_type',
name: 'type',
},
{
data: 'start_datetime',
name: 'start_date',
render: function(data, type, full, meta){
return convertUTCDateToLocalDate(new Date(data));
},
},
{
data: 'end_datetime',
name: 'end_date',
render: function(data, type, full, meta){
return convertUTCDateToLocalDate(new Date(data));
},
},
{
data: 'status',
name: 'status'
},
{
data: 'action',
name: 'Operations',
orderable: false
}
]
});
}
load_data();
$('#filter').click(function(){
var from_date = $('#date_timepicker_start').val();
var to_date = $('#date_timepicker_end').val();
var status=$('#status').val();
var typep=$('#post_type').val();



function isEmpty(val){
    return (val === undefined || val == null || val.length <= 0) ? true : false;
}



if(!isEmpty(from_date) &&  !isEmpty(to_date)  && !isEmpty(status) && !isEmpty(typep))
{
$('#dataTableAuction').DataTable().destroy();
load_data(from_date, to_date,status,typep);
}
else
{
  toastr.options.closeButton = true;
toastr.error('Please Fill All Fields Of Filter', '', {timeOut: 3000});
}
});
$('#refresh').click(function(){

  document.getElementById("myform").reset();
//  $('#date_timepicker_start').val('');
//  $('#date_timepicker_end').val('');
// $('#status').val('');
// $('#post_type').val('');

$('#dataTableAuction').DataTable().destroy();
load_data();
});
});
</script>
@endsection