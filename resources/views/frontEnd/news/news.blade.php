{{-- extend  --}}
@extends('front-end-layout.app')
@extends('includes-frontend.header')
@extends('includes-frontend.footer')
{{-- page titles --}}
@section('title', 'News')
@section('content')
<section id="page-header">
   <style>
   section#page-header .page-title::before {
   content: " ";
   background: #222f39;
   opacity: 0.63;
   z-index: 1;
   }
   </style>
   <div id="page-title" class="page-title">
      <div
         class="page-title-background"
         style="
         background-image: url({{ asset('img/hternarysitebanner.jpg') }});
         /*-moz-filter: none;
         -ms-filter: none;
         -o-filter: none;
         filter: none;
         filter: none; */ /* IE 6-9 */
         "
      ></div>
      <div class="container">
         <h1>
         News
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
            <li class="page-item text-white">News</li>
         </ul>
      </div>  
   </div>
</section>
<main role="main">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 shadow-sm p-3  bg-white rounded">
           @foreach ($news as $element)
              {{-- expr --}}
         

            <div class="content-box news-main-listing">
               <div class="news-wrap">
                  <div class="main-row">
                     <div class="featured-img">
                        <a href="{{ route('single_news_frontend',['id'=>Crypt::encrypt($element->id)]) }}">
                           <img class="img-thumbnail img-fluid" alt="Record prices for the foals in the first ever SWB Online Elite Auction!" src="{{ asset('img') }}/{{ $element->featured_img }}" class="lazy-loaded" style="">
                        </a>
                     </div>
                     <div class="d-flex justify-content-between align-items-center">
                        <h4>

                           {{Str::limit($element->title, 40)  }}
                        </h4>
                        <div class="share-wrap">
                           <a href="" target="_blank">
                              <span class="fa fa-facebook"></span>
                           </a>
                        </div>
                     </div>
                     <p class=" mb-1 ">

                          {!! Str::limit($element->description, 100) !!}
                     
                     </p> 
                     <h5 class="text-right mt-0 mb-0 text-uppercase">
                      {{ $element->org_name }}
                     </h5>
                     <hr class="mt-0">
                     <div class="d-flex justify-content-between align-items-center">
                        <h6>  {{ $element->create_datetime }}</h6>
                        <a href="{{ route('single_news_frontend',['id'=>Crypt::encrypt($element->id)]) }}">
                           Read more
                        </a>
                     </div>
                  </div>
               </div>
            </div>
              @endforeach

          {{ $news->links() }}
         </div>
         <div class="col-lg-4 ">
              @php
                 CH::getSidebar();
               @endphp
         </div>
      </div>
   </div>
</main>
@endsection
@section("footer")
@parent
<style type="text/css">

</style>
@endsection