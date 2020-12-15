@section('footer')


    
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{ route('admin-logout') }}">Logout</a>
        </div>
      </div>
    </div>
  </div>
      <!-- jQuery -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
     <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
      <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
       {{-- <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
         <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
          <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script> --}}
      <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
      <script src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>
       <script src="{{ asset('js/select2.min.js') }}"></script>
         <script src="{{ asset('js/customAdmin.js') }}"></script>
     
  <script>

$(document).ready(function(){

   $('.loader').fadeOut();
   $('.overlay').fadeOut();
  $(".showloader").click(function(){
    $(".loader").fadeIn();
     $('.overlay').fadeIn();
  });    

$(".author").select2({
    placeholder: "Select User",
    allowClear: true
});
  
  $(".post_type").select2({
    placeholder: "Select Post Type",
    allowClear: true
});
  

  

});

  </script>
 
@endsection