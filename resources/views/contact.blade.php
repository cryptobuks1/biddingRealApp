{{-- extend  --}}
@extends('front-end-layout.app')
@extends('includes-frontend.header')
@extends('includes-frontend.footer')

{{-- page titles --}}
@section('title', 'Home')
@section('content')  
<section id="page-header">
<section id="page-header">
   <style>
      section#page-header .page-title::before {
      content: ' ';
      background: #222f39;
      opacity: 0.63
      ;
      z-index: 1;
      }
   </style>
   <div id="page-title" class="page-title">
      <div class="page-title-background" style="background-image: url({{ asset('img/hternarysitebanner.jpg') }});
         /*-moz-filter: none;
         -ms-filter: none;
         -o-filter: none;
         filter: none;
         filter: none; */ /* IE 6-9 */">
      </div>
      <div class="container">
         <h1>
           Contact Us
         </h1>
      </div>
   </div>
   <div class="breadcrumb-wrap shadow-sm p-3  bg-white rounded" style="background: #036EB5 !important;">
      <div class="container">
         <ul class="breadcrumbs">
            <li class="page-item">
               <a href="/" class="page-link text-white">
               Home
               </a>
            </li>
            <li class="page-item text-white">Contact</li>
         </ul>
      </div>  
   </div>
</section>
<main role="main">
    <div class="container">
        <section id="user-request">
            <h2>Get in touch with us</h2>
            <div id="ajax-alert"></div>
            <div class="row no-padding block shadow-sm p-3 mb-3 bg-white rounded">
                <div class="col-lg-4">
                    <div class="content-box">
                        <h3>Address</h3>
                       
                        <p>

                          {!! $general->address !!}
                        
                        </p>
                        <hr class="small-margin" />
                        <p class="no-margin">
                            {!! $general->address2 !!}
                        </p>
                       
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="map-wrap">
                        <iframe
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAALq-ZX4lr-1Te4koD0-U3WLpmjjF4G8U&amp;zoom=12&amp;q=L%c3%bctke%20Venn%201%20%2049536%20Lienen"
                            allowfullscreen="allowfullscreen"
                            width="600"
                            height="450"
                            frameborder="0"
                            style="border: 0px;"
                        ></iframe>
                    </div>
                </div>
            </div>
            <div data-v-026dc719="">
                <!---->
                <div data-v-026dc719="" id="registration-loading" class="progress-wrap d-none shadow-sm p-3 mb-2 bg-white rounded">
                    <div data-v-026dc719="" class="progress"><div data-v-026dc719="" class="indeterminate"></div></div>
                </div>
                <div data-v-026dc719="" class="content-box shadow-sm p-3 mb-2 bg-white rounded">
                    <h2 data-v-026dc719="">
                        Send a message
                    </h2>
                    <div class="container ">
    

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible bg-danger">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- success message display --}}
@if(session('message'))
<div class="alert alert-success alert-dismissible bg-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> {{ session('message') }}
</div>
@endif
<div id="digital-clock"></div>
{{-- error message display if company added --}}
@if(session('error'))
<div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Alert!</strong> {{ session('error') }}
</div>
@endif
 </div>
                    <form  id="req-form" class="request-form" action="{{ route('postContactFront') }}" method="POST">
                        @csrf 

                       <input type="hidden" name="create_datetime" id="create_datetime">
                        <div class="row">
                        <div class="col-sm-6">
                               <div class="form-group">
                           <label for="name">Name</label>
                            <input id="name" type="text" class="form-control " name="name"   value="{{ old('name') }}" autocomplete="name" autofocus="" placeholder="johndoe123">

                                                        </div>
                        </div>
                        <div class="col-sm-6">
                               <div class="form-group">
                           <label for="email">Email</label>
                            <input id="email" type="email" class="form-control " name="email" value="{{ old('email') }}" autocomplete="email" autofocus="" placeholder="johndoe123@gmail.com">

                                                        </div>
                        </div>
                        <div class="col-sm-6">
                               <div class="form-group">
                           <label for="email">Subject</label>
                            <input id="email" type="text" class="form-control " name="subject" value="{{ old('subject') }}"  autocomplete="subject" autofocus="" placeholder="e.g abc">

                                                        </div>
                        </div>
                        <div class="col-sm-6">
                               <div class="form-group">
                           <label for="email">Phone</label>
                            <input id="phone" type="text" class="form-control " name="phone" value="{{ old('phone') }}"  autocomplete="phone" autofocus="" placeholder="+9234567078">

                                                        </div>
                        </div>

                          <div class="col-sm-12">
                          <textarea name="description" class="form-control" rows="5" >{{ old('description') }}</textarea>
                          </div>
                        </div>
                          <div class="col-sm-12 pt-3">
                               <div class="form-group">
                         Accept Term & Coditions
                           <input
                                  
                                    type="checkbox"
                                    required="required"
                                    name="is_agree"

                                    value="yes"
                                />

                                                        </div>
                          
                        <br>
                        <button data-v-026dc719="" type="submit" class="">Send message</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</main>

@endsection
@section("footer")
@parent
<style type="text/css">
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
<script type="text/javascript">
    
function getDateTime() {
        var now     = new Date(); 
        var year    = now.getFullYear();
        var month   = now.getMonth()+1; 
        var day     = now.getDate();
        var hour    = now.getHours();
        var minute  = now.getMinutes();
        var second  = now.getSeconds(); 
        if(month.toString().length == 1) {
             month = '0'+month;
        }
        if(day.toString().length == 1) {
             day = '0'+day;
        }   
        if(hour.toString().length == 1) {
             hour = '0'+hour;
        }
        if(minute.toString().length == 1) {
             minute = '0'+minute;
        } 
        if(second.toString().length == 1) {
             second = '0'+second;
        }   
        var dateTime = year+'-'+month+'-'+day+' '+hour+':'+minute+':'+second;   
         return dateTime;
    }

    // example usage: realtime clock
    setInterval(function(){
        currentTime = getDateTime();
        
        $('#create_datetime').val(currentTime);// document.getElementById("digital-clock").innerHTML = currentTime;

    }, 1000);



</script>
@endsection
