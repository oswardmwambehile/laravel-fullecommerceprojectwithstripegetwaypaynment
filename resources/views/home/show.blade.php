<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
       <base href="/public">
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Fashion</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
   </head>
   <body>
     @include('sweetalert::alert')
      <div class="hero_area">
         <!-- header section strats -->
          @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
       <div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top rounded-top-4" alt="{{ $product->title }}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0">
                <div class="card-body">
                    <h2 class="card-title display-6 fw-bold mb-3">{{ $product->title }}</h2>
                    <p class="text-muted mb-3">{{ $product->description }}</p>

                    @if($product->discount_price)
                        <h4 class="text-danger fw-bold">Discount Price: ${{ number_format($product->discount_price, 2) }}</h4>
                        <p class="text-secondary text-decoration-line-through">Original Price: ${{ number_format($product->price, 2) }}</p>
                    @else
                        <h4 class="text-primary fw-bold">Price: ${{ number_format($product->price, 2) }}</h4>
                    @endif

                    <p class="mt-3"><strong>Available Quantity:</strong> {{ $product->quantity }}</p>

                    <form action="{{url('add_cart', $product->id)}}" method="POST" class="mt-4">
                        @csrf
                        <div class="input-group mb-3" style="max-width: 200px;">
                            <input type="number" name="quantity" class="form-control" min="1"  value="1">
                            <button class="btn btn-dark" type="submit">Add to Cart</button>
                        </div>
                    </form>

                    <a href="{{ url('/') }}" class="btn btn-outline-secondary mt-2">← Back to Shop</a>
                </div>
            </div>
        </div>
    </div>
</div>
         
         <!-- end slider section -->
      </div>
      <!-- why section -->
       
      
      <!-- end client section -->
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>