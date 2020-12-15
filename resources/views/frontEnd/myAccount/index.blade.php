{{-- extend  --}}
@extends('front-end-layout.app')
@extends('includes-frontend.header')
@extends('includes-frontend.footer')

{{-- page titles --}}
@section('title', 'Home')
@section('content')  
<main role="main">
 


   <div class="container ">
    <div class="row">
         @include('includes-frontend.accountSidebar')
        <!-- Profile Settings-->
        <div class="col-lg-8 pb-5">
               @include('includes-admin.alerts')
            <form class="row  shadow-sm p-3  bg-white rounded" method="POST" action="{{ route('myaccountUpdate') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-fn">Name</label>
                        <input class="form-control" name="name"
                        type="text" id="account-fn"   value="{{ Auth::user()->name }}">
                    </div>
                </div>

                 <div class="col-md-6">
                    <div class="form-group"> 
                        <label for="account-fn">Family Name</label>
                        <input class="form-control" name="fname"
                        type="text" id="account-fn"   value="{{ Auth::user()->fname }}">
                    </div>
                </div>
            
             <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-fn">Company Name</label>
                        <input class="form-control" name="cname"
                        type="text" id="account-fn"   value="{{ Auth::user()->cname }}">
                    </div>
                </div>
            
            
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-email">E-mail Address</label>
                        <input class="form-control" name="email" type="email" id="account-email"  value="{{ Auth::user()->email }}" disabled="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-phone">Phone Number</label>
                        <input class="form-control" name="phone" type="text" id="account-phone" placeholder="+7 (805) 348 95 72"  value="{{ Auth::user()->phone }}" required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-pass">Vat Number</label>
                        <input class="form-control" name="vat_number" type="text" id="account-pass" value="{{ Auth::user()->vat_number }}">
                    </div>
                </div>

                 
                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-pass">Business Name</label>
                        <input class="form-control" name="busname" type="text" id="account-pass" value="{{ Auth::user()->business_name }}">
                    </div>
                </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-pass">Country Name</label>
                        <select name="country" class="form-control country" required>
                             <option value="" selected="">Select Country</option>

                              @if($countries->count())
                             @foreach ($countries as $country)
                                  <option value="{!! $country->name->common !!}" @if($country->name->common== Auth::user()->country) selected @endif> <span style="padding: 5px;">  {!! $country->name->common !!} </span> </option>
                             @endforeach
                            @endif
                           </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-confirm-pass">Address</label>
                       <textarea name="address" class="form-control">{{ Auth::user()->address }}</textarea>
                    </div>
                </div>
                      <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-confirm-pass">Profile Image</label>
                         <input class="form-control" name="pfile" type="file" id="account-pass" accept="image/*"/>
                         <input class="form-control" name="pfilehidden" type="hidden" id="account-pass" value="{{ Auth::user()->image }}">
                    </div>
                </div>
                <div class="col-12">
                    <hr class="mt-2 mb-3">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                     {{--    <div class="custom-control custom-checkbox d-block">
                            <input class="custom-control-input" type="checkbox" id="subscribe_me" checked="">
                            <label class="custom-control-label" for="subscribe_me">Subscribe me to Newsletter</label>
                        </div> --}}
                        <button class="custom-button" type="submit" style="background: #036DB4 !important;">Update Profile</button>
                    </div>
                </div>
            </form> 
        </div>
    </div>

    
</div>
</main>
     
@endsection
@section("footer")
@parent
<style type="text/css">
 input[type="file"]::before {
        width: 100%;
        position: absolute;
    content: 'Upload File';
    display: inline-block;
    background: #036DB4;
    border: 1px solid #999;
    border-radius: 3px;
    padding: 7px 7px 7px 15px;
    color: white;
    outline: none;
    white-space: nowrap;
    -webkit-user-select: none;
    cursor: pointer;
    font-weight: 700;
    font-size: 10pt;
    margin-left: -12px;
    margin-top: -4px;
}
input[type="file"] {
    border: none !important;
}
</style>

@endsection
