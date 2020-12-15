 {{-- extend  --}}
@extends('front-end-layout.app')
@extends('includes-frontend.header')
@extends('includes-frontend.footer') 
{{-- page titles --}}
@section('title', 'Home')
@section('content')
<div class="container h-100">
    <div class="row justify-content-center">
        <div class="col-md-8 m-5">
            <div class="card p-3">
                <div class="card-title">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline btn-danger  btn text-white shadow-lg px-2 btn-block">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

 @section("footer")
   @parent
   <style type="text/css">
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



