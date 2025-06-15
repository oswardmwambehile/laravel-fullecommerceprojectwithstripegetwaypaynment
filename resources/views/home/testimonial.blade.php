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
   <link rel="shortcut icon" href="images/favicon.png" type="">
   <title>Famms</title>
   <!-- bootstrap core css -->
   <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
   <!-- font awesome style -->
   <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
   <!-- Custom styles for this template -->
   <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
   <!-- responsive style -->
   <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />
</head>
<body>
   <div class="hero_area">
      <!-- header section starts -->
      @include('home.header')
      <!-- end header section -->

      <!-- Testimonial Section -->
      <section class="client_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>Customer's Testimonial</h2>
            </div>

            <div id="carouselExample3Controls" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  @foreach ($customers as $index => $customer)
                  <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                     <div class="box col-lg-10 mx-auto">
                        <div class="img_container">
                           <div class="img-box">
                              <div class="img_box-inner">
                                 <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}&background=0D8ABC&color=fff" alt="{{ $customer->name }}">
                              </div>
                           </div>
                        </div>
                        <div class="detail-box">
                           <h5>{{ $customer->name }}</h5>
                           <h6>Customer</h6>
                           <p>
                              {{ $customer->address ?? 'No address provided.' }}
                           </p>
                        </div>
                     </div>
                  </div>
                  @endforeach
               </div>

               <div class="carousel_btn_box">
                  <a class="carousel-control-prev" href="#carouselExample3Controls" role="button" data-slide="prev">
                     <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                     <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExample3Controls" role="button" data-slide="next">
                     <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                     <span class="sr-only">Next</span>
                  </a>
               </div>
            </div>
         </div>
      </section>
   </div>

   <!-- Footer -->
   <div class="cpy_">
      <p class="mx-auto">© 2021 All Rights Reserved By
         <a href="https://html.design/">Free Html Templates</a><br>
         Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
      </p>
   </div>

   <!-- jQuery -->
   <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
   <!-- popper js -->
   <script src="{{ asset('home/js/popper.min.js') }}"></script>
   <!-- bootstrap js -->
   <script src="{{ asset('home/js/bootstrap.js') }}"></script>
   <!-- custom js -->
   <script src="{{ asset('home/js/custom.js') }}"></script>
</body>
</html>
