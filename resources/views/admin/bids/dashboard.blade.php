{{-- extend  --}}
@extends('admin-layout.app')
@extends('includes-admin.header')
@extends('includes-admin.footer')
@extends('includes-admin.sidebar')
{{-- page titles --}}
@section('title', ' Biddding Record') 
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Biddding Record</h1>
    
   
  </div>
  <div class="card shadow mb-4">
    
    <div class="card-body">
 
       <div class="row input-daterange">
     
       <!-- The Modal -->
  <div class="modal fade" id="myFilterModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Filter</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <select name="auction" class="form-control  allauctions"  style='width: 100% !important;'>
                 <option value=""> Select Auction</option>
              
            </select>
            </div> 


            <div class="form-group">
            <select name="allauctionsItem" class="form-control allauctionsItem"   style='width: 100% !important;'>
                 <option value="" > Select Auction Items</option>
                
            </select>
            </div>

          <div class="form-group">
                 <input type="text" name="from_date" id="date_timepicker_start" class="form-control" placeholder="Start Date Time" readonly />
          </div>
    
              <div class="form-group">
           <input type="text" name="to_date" id="date_timepicker_end" class="form-control" placeholder="End Date Time" readonly />
            </div>

              <div class="form-group">

                <label>winner</label>
            <select name="status" class="form-control winner" >
                  <option value="off" selected="">No</option>
                <option value="on" >Yes</option>
              
            </select>
            </div>
              <div class="form-group"> 
                <label>Sold</label>
            <select name="status" class="form-control sold" >
              <option value="off" selected="">No</option>
                  <option value="on" >Yes</option>
               
            </select>
            </div>
             <div class="form-group">
            <select name="status" class="form-control status" id="status">
                 <option value="">Status</option>
                <option value="on"  selected>Active</option>
                <option value="off">Deactive</option>
            
            </select>
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
             <button type="button" name="filter" id="filter" class="btn btn-primary"  >Filter</button>
              <button type="button" name="refresh" id="refresh" class="btn btn-danger refresh"><i class="fas fa-sync-alt"></i></button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
        <div class="col-md-6">
          <button type="button" name="filter"  class="btn btn-primary btn-block btn-block btn-sm shadow-lg border-0" data-toggle="modal" data-target="#myFilterModal" >Filter</button>
        </div>
        <div class="col-md-6">
          <button type="button" name="refresh" id="refresh" class="btn btn-danger btn-block btn-block btn-sm shadow-lg border-0 refresh"><i class="fas fa-sync-alt"></i></button>
        </div>
      </div>
        <div class="row input-daterange">
           <div class="col-md-12 pt-3 pb-1">
        <button type="button" class="btn-block shadow-lg border-0 btn-success btn-sm sendmail" > Send Email To Bidders</button>
         </div >
        </div>
      <div class="table-responsive table-striped table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
        
        <table  class="table dataTable my-0" id="dataTableAuction">
          <thead>
            <tr>
              <th>Id</th>
              <th>Auction</th>
              <th>Auction Item</th>
              <th>Email</th>
               <th>Amount</th>
              <th>Created Date</th>
              <th>Winner</th>
              <th>Sold</th>
              <th>Status</th>
              <th>Operations</th>
            
            </tr>
          </thead>
   
        </table>
        
      </div>
      
    </div>
    
  </div>
</div>
<!-- /.container-fluid -->


  <!-- The Modal -->
  <div class="modal" id="sendemails">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          
        <button type="button" class="btn btn-success btn-block shadow-lg border-0 goSend " >Send </button>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <div class="tab customcontenttab">
      </div>

            <div class="form-group">
        <div class="form-group"><label for="username"><strong>Subject</strong></label>
        <input type="text" name="subject" class="subject form-control" >
      </div>
    </div>

        <div class="form-group">
        <div class="form-group"><label for="username"><strong>Content</strong></label>
        <textarea name="description" rows="4" id="content_auction" cols="50" class="form-control">{{ old('description') }}</textarea>
      </div>
    </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">

          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
@endsection
@section("footer")
@parent
<!-- DataTables JavaScript -->
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<link href="{{ asset('css/toaster.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/toaster.min.js') }}"></script>

<script type="text/javascript">





$(document).on('click', '.sendmail', function(){

   
            var favorite = [];
            $.each($("input[name='subscribers']:checked"), function(){

              var emailval = $(this).closest('tr').find('td').eq(3).text();
       alert(emailval);

              
                favorite.push({'id':$(this).val(),'email':emailval});
            });
           
if (favorite === undefined || favorite.length == 0) {
  
  toastr.error('Please Select Minimumm 1 email address to sen mail', '', {timeOut: 3000});
}else{

toastr.success('Wait Email Template Prepare...ok !', '', {timeOut: 3000});
var tabtemp='';
favorite.map(function (valp ,index) {
  tabtemp=tabtemp+'<button class="tab">'+valp.email+'</button>'
})
$('.customcontenttab').html(tabtemp);
$('#sendemails').modal('show');
$('.goSend').click(function(){
$(this).text("Sending Wait......!");
function isEmpty(val){
    return (val === undefined || val == null || val.length <= 0) ? true : false;
}

var content_auction=$('#content_auction').val();

 

var subject=$('.subject').val();



if(!isEmpty(content_auction) &&  !isEmpty(subject) )
{

$.ajax({
url:"{{ route('sendmail_subscriber_admin_ajax') }}", 
type:"POST",
dataType:"json",
data:{favorite:favorite,content:content_auction,subject:subject,_token:"{{ csrf_token() }}"},
success:function(res)
{
console.log(res);
$('#sendemails').modal('hide');
$(this).text("Send");
}
})

}
else
{
  $(this).text("Send");
  toastr.options.closeButton = true;
toastr.error('Please Fill All Fields of Mail', '', {timeOut: 3000});
}



});

}
});
           


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
url:"{{ route('bidAdminDelete') }}", 
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
function load_data(from_date = '', to_date = '',status='', allauctionsItem='',allauctions='',winner='',sold=''){

 

$('#dataTableAuction').DataTable({
processing: true,
serverSide: true,
responsive: true,
ajax:{
url: "{{ route('bidAdmin_ajax') }}",
data:{from_date:from_date, to_date:to_date,status:status,allauctionsItem:allauctionsItem,allauctions:allauctions,winner:winner,sold:sold}
},
columns:[
{
data: 'id',
name: 'id',
render: function(data, type, full, meta){
return '<input type="checkbox" class="subscriber" name="subscribers" value="'+data+'"/>';
}
},
{
data: 'get_auction.title',
name: 'auction',
},
{
data: 'get_auction_item.title',
name: 'aution_item',

},
{
data: 'get_user.email',
name: 'email', 
searchable: true
},

{
data: 'amount',
name: 'amount', 
searchable: true  
},
{
data: 'bdatetime',
name: 'created_date',
render: function(data, type, full, meta){
return convertUTCDateToLocalDate(new Date(data));
},
},
{
data: 'win',
name: 'winner',
searchable: true
},
{
data: 'sold',
name: 'sold',
searchable: true
},
{
data: 'status',
name: 'verified'
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
var allauctionsItem=$('.allauctionsItem').val();
var allauctions=$('.allauctions').val();
var winner=$('.winner').val();
var sold=$('.sold').val();
var status=$('#status').val();


 

function isEmpty(val){
    return (val === undefined || val == null || val.length <= 0) ? true : false;
}



if(!isEmpty(from_date) &&  !isEmpty(to_date)  && !isEmpty(status) && !isEmpty(allauctionsItem) && !isEmpty(allauctions) && !isEmpty(winner) && !isEmpty(sold))
{
$('#dataTableAuction').DataTable().destroy();
load_data(from_date, to_date,status,allauctionsItem,allauctions,winner,sold);
}
else
{
  toastr.options.closeButton = true;
toastr.error('Please Fill All Fields Of Filter', '', {timeOut: 3000});
}
});
$('.refresh').click(function(){

$('#dataTableAuction').DataTable().destroy();
load_data();
});
});



    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

      $( ".allauctions" ).select2({
        ajax: { 
          url: "{{route('dataAjaxBiddingSelect2')}}",
          type: "post",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              _token: CSRF_TOKEN,
              search: params.term // search term
            };
          },
          processResults: function (response) {
            return {
              results: response
            };
          },
          cache: true
        }

      });

    


  

      $( ".allauctionsItem" ).select2({
        ajax: { 
          url: "{{route('dataAjaxAC_itemBiddingSelect2')}}",
          type: "post",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              _token: CSRF_TOKEN,
              search: params.term // search term
            };
          },
          processResults: function (response) {
            return {
              results: response
            };
          },
          cache: true
        }

      });






    });
    </script>
  


<style type="text/css" media="screen">
  .tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
 
  border: none;
  outline: none;
  cursor: pointer;
 
  transition: 0.3s;
 
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
@endsection