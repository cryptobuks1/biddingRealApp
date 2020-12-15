
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
            <h1 class="h3 mb-0 text-gray-800">Users/Roles</h1>
            
          </div>
   <div class="card shadow mb-4">
      <div>
      <div class="card-body">
  
           
                 <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="pill" href="#users">Users</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#role">Roles </a>
    </li>
  {{--   <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#authority">Authority </a>
    </li> --}}
  </ul>
    {{-- main tab --}}
    <div class="tab-content">
      {{-- user tab --}}
      <div id="users" class="container tab-pane active">

       
        @include('admin.user_mangement.user_mangement_tab')
      </div>
      {{-- role tab  --}}
      <div id="role" class="container tab-pane ">
       
        @include('admin.user_mangement.role_mangement_tab')
      </div>
      <div id="authority" class="container tab-pane ">
        @include('admin.user_mangement.authority')
      </div>
      {{-- role tab  ends--}}
    </div>
  {{-- third tab start from there --}}
 
   
    <div>
   </div>
   </div> 

</div>
        <!-- /.container-fluid -->
@endsection
@section("footer")
@parent
<!-- DataTables JavaScript -->

//<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />

<link rel="stylesheet" href="{{ asset('cs/jstreebeautyfy.css') }}" rel="stylesheet"/> 
<script src="{{ asset('js/jstree.min.js') }}"></script>


 <script src="{{ asset('js/sweetalert.min.js') }}"></script>
<link href="{{ asset('css/toaster.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/toaster.min.js') }}"></script>
<script>
  {{-- js tree code start  --}}
    $('#html').jstree({
      'core' : {
        'data' : {
                "url" : "{{ route('getauthority') }}",
                "dataType" : "json" // needed only if you do not supply JSON headers
              }
            },
      "types" : {
          "default" : {
            "icon" : "glyphicon glyphicon-user"
          },
          "demo" : {
            "icon" : "glyphicon glyphicon-user"
          }
        },
        
      'plugins':["checkbox","types"]
    });
    /*check if role exsist load it in tree*/
    $('#role-auth').on('change',function(){
      var role = $(this).val();
      $.ajax({
        url:"{{route('checkrole')}}",
        type:"post",
        dataType:"json",
        data:{role:role,_token:"{{csrf_token()}}"},
        success:function(res){
          if(res.length > 0){
            $('#auth_id').val(res[0].id);
            $('#html').jstree(true).uncheck_all();
            $('#html').jstree(true).close_all();
            $('#html').jstree('select_node', res[0].selected_ids);
          }else{
            $('#auth_id').val('');
            $('#html').jstree(true).uncheck_all();
            $('#html').jstree(true).close_all();
          }
        }
      });
    })
    /*add authority to the database get from the js tree*/
    $('#addauthority').on('click',function(){
      var role = $('#role-auth').val();
      var parent_id = $('#auth_id').val();
      var selectedData = [];
      var selectedID = [];
      var selectedIndexes;
        selectedIndexes = $("#html").jstree("get_selected", true);
        jQuery.each(selectedIndexes, function (index, value) {
          selectedData.push(selectedIndexes[index].text);
          selectedID.push(selectedIndexes[index].id);
        });
      $.ajax({
        url:"{{ route('addauthority') }}",
        type:"post",
        dataType:"json",
        data:{parent_id:parent_id,role:role,roles:selectedData,id:selectedID,_token:"{{csrf_token()}}"},
        success:function(res){
          if(res.message){
            $.toast({
              heading: 'SUCCESS',
              text: res.message,
              icon: 'success',
              position: 'top-right', 
              loader: true,        // Change it to false to loader
              loaderBg: '#9EC600'  // To change the background
            })
          }
        }
      });
    })
    /*end js tree code*/
  /*end js tree code*/
  $(document).ready(function() {
      $('#dataTables-example1').DataTable({
              responsive: true
      });
      $('[data-toggle="tooltip"]').tooltip(); 
  });
  $(document).ready(function() {
      $('#dataTables-example2').DataTable({
              responsive: true
      });
      $('[data-toggle="tooltip"]').tooltip();
  });
// standard on load code goes here with $ prefix
// note: the $ is setup inside the anonymous function of the ready command

    $(document).ready(function() {
      $('#edituser').on('click',function(){
        var val = $(this).closest('tr').find('td').eq(3).text();
        console.log(val);
      })
     });


  </script>





 
<script type="text/javascript">



           

$(document).ready(function() {
$(document).on('click', '.deleteAuction', function(){





sub_id = $(this).attr('del-id');
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
url:"{{ route('delete_user_ajax') }}", 
type:"POST",
dataType:"json",
data:{sub_id:sub_id,_token:"{{ csrf_token() }}"},
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
function load_data(from_date = '', to_date = '',status=''){



$('#dataTableAuction').DataTable({
processing: true,
serverSide: true,
responsive: true,
ajax:{
url: "{{ route('getall_user_ajax') }}",
data:{from_date:from_date, to_date:to_date,status:status}
},
columns:[
{
data: 'id',
name: 'id',
},
{
data: 'name',
name: 'name',
searchable: true, 

},
{
data: 'email',
name: 'email',
searchable: true, 

},
{
data: 'status',
name: 'role',
searchable: true, 
},
{
data: 'action',
name: 'action',
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


 

function isEmpty(val){
    return (val === undefined || val == null || val.length <= 0) ? true : false;
}



if(!isEmpty(from_date) &&  !isEmpty(to_date)  && !isEmpty(status))
{
$('#dataTableAuction').DataTable().destroy();
load_data(from_date, to_date,status);
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






