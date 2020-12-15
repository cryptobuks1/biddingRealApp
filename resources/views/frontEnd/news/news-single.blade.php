{{-- extend  --}}
@extends('front-end-layout.app')
@extends('includes-frontend.header')
@extends('includes-frontend.footer')

{{-- page titles --}}
@section('title', 'Single News')
@section('content')  
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
         <h2 class="text-white">
      {{ $news->title }}
         </h2>
      </div>
   </div>
   <div class="breadcrumb-wrap shadow-sm   bg-white rounded">
      <div class="container">
         <ul class="breadcrumbs">
            <li class="page-item">
               <a href="../en.html" class="page-link">
               Home
               </a>
            </li>
            <li class="page-item ">{{ $news->title }}</li>
         </ul>
      </div>
   </div>
</section>
<main role="main">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 shadow-sm  p-3 bg-white rounded">
         
            <article>
               <div class="img-gallery block">
                  <ul data-thumbnails="bottom">
                     <!-- data-thumb = thumbnail; <img> = big image; data-src = big image -->
                     <li >
                        <a href="#!">
                        <img src="{{ asset('img') }}/{{ $news->featured_img }}">
                        </a>
                        <div class="caption">
                           <h4>
                           </h4>
                           <p>
                           </p>
                        </div>
                     </li>
                  </ul>
               </div>
             
             
               {!! $news->description !!}
            
            </article>
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
