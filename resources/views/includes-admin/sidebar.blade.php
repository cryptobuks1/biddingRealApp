@section('sidebar')


 <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #181a1f !important;background-image:none;">
<div class="sidebar-brand-text mx-3 d-flex align-items-center justify-content-center my-2">
          
         <a href="/admin"> <img src="{{ asset('img/hsecondarysitebanner.jpg') }}" class=" img-fluid rounded-circle img-thumbnail" alt="img" width="100" height="100"></a>
        </div>
      <!-- Sidebar - Brand -->
    

      <!-- Divider -->
     

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="/admin">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>


     <li class="nav-item active">
        <a class="nav-link" href="{{ route('generals') }}">
          <i class="fa fa-tools"></i>
          <span>Generals</span></a>
      </li>
      

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseone" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>User Mangement</span>
        </a>
        <div id="collapseone" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
          
            <a class="collapse-item" href="{{ route('user_mangement_homepanel') }}">User Mangement</a>
              <a class="collapse-item" href="{{ route('allposts') }}">Create Posts</a>
            <a class="collapse-item" href="{{ route('acf_dashboard') }}">Posts Custom Fields</a>
            <a class="collapse-item" href="{{ route('addnew_customField') }}">Add Custom Field</a>
           
          </div>
        </div>
      </li>



      <hr class="sidebar-divider">
        <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
         <i class="fas fa-hourglass-start"></i>
          <span>Auctions</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
          
            <a class="collapse-item" href="{{ route('auction_dashboard') }}">All Auctions</a>
            <a class="collapse-item" href="{{ route('auction_addnew') }}">Add New Auction</a>
          </div>
        </div>
      </li>
        <hr class="sidebar-divider">

          <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapseTwo">
         <i class="fas fa-horse-head"></i>
          <span>Auctions Items</span>
        </a>
        <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
          
            <a class="collapse-item" href="{{ route('auction_item_dashboard') }}">All Auctions Items</a>
            <a class="collapse-item" href="{{ route('addnew_auction_item') }}">Add New Auction Items</a>
          </div>
        </div>
      </li>
     <hr class="sidebar-divider">
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
        <i class="fa fa-gavel"></i>
          <span>Bidding Record</span>
        </a>
        <div id="collapse4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('bidAdmin') }}">Bids</a>
          </div>
        </div>
      </li>
         <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse7" aria-expanded="true" aria-controls="collapse4">
        <i class="fa fa-exclamation-triangle"></i>
          <span>News </span>
        </a>
        <div id="collapse7" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('getallnews_admin') }}">All News</a>
             <a class="collapse-item" href="{{ route('addnews_admin') }}">Add New News</a>
          </div>
        </div>
      </li>
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse4">
      <i class="fa fa-phone-volume"></i>
          <span>Contacts Details </span>
        </a>
        <div id="collapse5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('contact_admin') }}">All Contacts Record</a>
          </div>
        </div>
      </li>
    
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapse4">
        <i class="fas fa-envelope-open"></i>
          <span>Subscriber </span>
        </a>
        <div id="collapse6" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('subscriber_admin') }}">All Suscribers</a>
          </div>
        </div>
      </li>
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
@endsection