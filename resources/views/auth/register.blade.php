
{{-- extend  --}}
@extends('front-end-layout.app')
@extends('includes-frontend.header')
@extends('includes-frontend.footer') 
{{-- page titles --}}
@section('title', 'Home')
@section('content')

<section class="h-100 custombackgroundauth"  style=" background-image: url(https://horse24-medias.s3.amazonaws.com/prod_westfalen_fx7el/lots/4039/lot-image_1600645300048_png);">
      <div class="container h-100  ">
         <div class="row justify-content-md-center h-100">
            <div class="card-wrapper">
             
               <div class="card fat my-5">
                  <div class="card-body">
                    <h4 class="card-title">{{ __('Register') }}</h4>
                     <form method="POST" class="my-login-validation"  action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                           <label for="name">{{ __('Name') }}</label>


                             <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="John Doe">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        
                        </div>

                   

  

  

                        <div class="form-group">
                           <label for="email">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="johndoe123@gmail.com">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                       

                         <div class="form-group">
                            @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           <label for="email">Register As:</label>

                           <select name="role_id" class="form-control" required>
                             <option value="" selected="">Select </option>
                             @isset ($roles)
                             @foreach ($roles as $role)
                                  <option value="{{ $role->id }}">{{ $role->role }}</option>
                             @endforeach
                            @endisset
                           </select>

                              
                        </div>

                        
                          <div class="form-group">
                            @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           <label for="email">Country:</label>

                           <select name="country" class="form-control country" required>
                             <option value="" selected="">Select Country</option>

                              @if($countries->count())
                             @foreach ($countries as $country)
                                  <option value="{!! $country->name->common !!} "> 
                                 <span style="padding: 5px;"> {!! $country->flag['flag-icon'] !!} {!! $country->name->common !!} </span> 
                                  </option>
                             @endforeach
                            @endif
                           </select>

                              
                        </div>
 
                            <div class="form-group">
                           <label for="password">Vat Number:</label>
                           <input id="vat_number" type="text" class="form-control @error('vat_number') is-invalid @enderror" name="vat_number" value="{{ old('email') }}" placeholder="K99999999L">

                                @error('vat_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                           <label for="password">{{ __('Password') }}</label>
                           <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    
                          
                           <div class="form-group">
                           <label for="password">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                            <div class="form-group">
                           <label for="password">Address:</label>

                           <textarea name="address" id="address"  class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                          

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                           <div class="custom-checkbox custom-control">
                              <input type="checkbox" name="agree" id="agree" class="custom-control-input" required="">
                              <label for="agree" class="custom-control-label">I agree to the <a href="#">Terms and Conditions</a></label>
                              <div class="invalid-feedback">
                                 You must agree with our Terms and Conditions
                              </div>
                           </div>
                        </div>

                        <div class="form-group m-0">
                           <button  class="btn btn-success btn-block">
                              Register
                           </button>
                        </div>
                        <div class="mt-4 text-center">
                           Already have an account? <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
                        </div>
                     </form>
                  </div>
               </div>
             
            </div>
         </div>
      </div>

   
   </section>

   @endsection
   @section("footer")
   @parent

   <script type="text/javascript">
     
 $(document).ready(function(){

      $( ".country" ).select2({
 })
      });
   </script>
   <style type="text/css">
 

    .custombackgroundauth{
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
    }
      html,body {
    
   height: 100%;
}



body.my-login-page {
   background-color: #f7f9fb;
   font-size: 14px;
}

.my-login-page .brand {
   width: 90px;
   height: 90px;
   overflow: hidden;
   border-radius: 50%;
   margin: 40px auto;
   box-shadow: 0 4px 8px rgba(0,0,0,.05);
   position: relative;
   z-index: 1;
}

.my-login-page .brand img {
   width: 100%;
}

.my-login-page .card-wrapper {
   width: 50%;
}

.my-login-page .card {
   border-color: transparent;
   box-shadow: 0 4px 8px rgba(0,0,0,.05);
}

.my-login-page .card.fat {
   padding: 10px;
   background: #ffffff;
    opacity: 0.9;
}

.my-login-page .card .card-title {
   margin-bottom: 30px;
}

.my-login-page .form-control {
   border-width: 2.3px;
}

.my-login-page .form-group label {
   width: 100%;
}

.my-login-page .btn.btn-block {
   padding: 12px 10px;
}

.my-login-page .footer {
   margin: 40px 0;
   color: #888;
   text-align: center;
}

@media screen and (max-width: 425px) {
   .my-login-page .card-wrapper {
      width: 90%;
      margin: 0 auto;
   }
}

@media screen and (max-width: 320px) {
   .my-login-page .card.fat {
      padding: 0;
   }

   .my-login-page .card.fat .card-body {
      padding: 15px;
   }
}
   </style>
   @endsection