  

 {{-- extend  --}}
@extends('front-end-layout.app')
@extends('includes-frontend.header')
@extends('includes-frontend.footer') 
{{-- page titles --}}
@section('title', 'Home')
@section('content')
<section class="h-100 custombackgroundauth"  style=" background-image: url(https://horse24-medias.s3.amazonaws.com/prod_westfalen_fx7el/lots/4039/lot-image_1600645300048_png);">
      <div class="container h-100 ">
         <div class="row justify-content-md-center h-100">
            <div class="card-wrapper">
             
               <div class="card fat my-5">
                  <div class="card-body">
                     <h4 class="card-title">{{ __('Login') }}</h4>
                     <form method="POST" class="my-login-validation" novalidate="" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                           <label for="email">E-Mail Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="johndoe123@gmail.com">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                           <label for="password">Password
                              <a href="{{ route('password.request') }}" class="float-right">
                                 Forgot Password?
                              </a>
                           </label>
                           <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                           <div class="custom-checkbox custom-control">
                              <input type="checkbox" name="remember" id="remember" class="custom-control-input">
                              <label for="remember" class="custom-control-label">Remember Me</label>
                           </div>
                        </div>

                        <div class="form-group m-0">
                           <button type="submit" class="btn btn-success btn-block">
                              Login
                           </button>
                        </div>
                        <div class="mt-4 text-center">
                           Don't have an account? <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a>
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