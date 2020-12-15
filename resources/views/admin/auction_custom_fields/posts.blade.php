{{-- extend  --}}
@extends('admin-layout.app')
@extends('includes-admin.header')
@extends('includes-admin.footer')
@extends('includes-admin.sidebar')
{{-- page titles --}}
@section('title', 'All Post Types')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">All Post Types</h1>
    
    <a href="{{ route('add_post') }}" class="btn-success btn btn-sm shadow-lg border-0"> Add New </a>
  </div>
  <div class="card shadow mb-4">
    
    <div class="card-body">
   
      <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
        
        <table  class="table dataTable my-0" id="dataTableAuction">
          <thead>
            <tr>
              <th>id</th>
              <th>Post Type</th>
              <th>Operations</th>
            </tr>
          </thead>
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
idp = $(this).attr('del-id');
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
url:"{{ route('delete_getall_post_ajax') }}",
type:"POST",
dataType:"json",
data:{idp:idp,_token:"{{ csrf_token() }}"},
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
format:'d-m-Y H:i',
//mask:true,
onShow:function( ct ){
this.setOptions({
maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
})
},
timepicker:true
});
$('#date_timepicker_end').datetimepicker({
format:'d-m-Y H:i',
//mask:true,
onShow:function( ct ){
this.setOptions({
minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
})
},
timepicker:true
});
function load_data(from_date = '', to_date = ''){
$('#dataTableAuction').DataTable({
processing: true,
serverSide: true,
responsive: true,
ajax:{
url: "{{ route('getall_post_ajax') }}",
data:{from_date:from_date, to_date:to_date}
},
columns:[

{ 
data: 'id',
name: 'id',
},
{
data: 'post_type',
name: 'post type'
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
if(from_date != '' &&  to_date != '')
{
$('#dataTableAuction').DataTable().destroy();
load_data(from_date, to_date);
}
else
{
alert('Both Date is required');
}
});
$('#refresh').click(function(){
$('#from_date').val('');
$('#to_date').val('');
$('#dataTableAuction').DataTable().destroy();
load_data();
});
});
</script>
@endsection