<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/png">

<!-- Title -->
<title>Ecommerce</title>

<!-- Bootstrap core CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />

<!-- Font Awesome style -->
<link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />

<!-- Custom styles for this template -->
<link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />

<!-- Responsive style -->
<link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />

   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
          @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
          @include('home.why')
      <!-- end why section -->
      
      <!-- arrival section -->
       @include('home.arrival')
      
         
         <!-- end slider section -->
      </div>
      <!-- why section -->
       
      <!-- end arrival section -->
      
      <!-- product section -->
       
      <!-- end product section -->
       
      <!-- subscribe section -->
       
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <!-- jQuery -->
<script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>

<!-- Popper JS -->
<script src="{{ asset('home/js/popper.min.js') }}"></script>

<!-- Bootstrap JS -->
<script src="{{ asset('home/js/bootstrap.js') }}"></script>

<!-- Custom JS -->
<script src="{{ asset('home/js/custom.js') }}"></script>

   </body>
</html>