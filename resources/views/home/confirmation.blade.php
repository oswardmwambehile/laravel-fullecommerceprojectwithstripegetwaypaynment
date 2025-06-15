<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
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

  <!-- Custom Styles -->
   <!-- Bootstrap 5 CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Font Awesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .confirmation-card {
      max-width: 480px;
      margin: 100px auto;
      padding: 2.5rem;
      background: #fff;
      border-radius: 1rem;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
      text-align: center;
      animation: fadeInUp 1s ease forwards;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .confirmation-icon {
      font-size: 4rem;
      color: #28a745;
      margin-bottom: 1.25rem;
      animation: popIn 0.8s ease forwards;
    }

    @keyframes popIn {
      0% {
        transform: scale(0);
        opacity: 0;
      }
      70% {
        transform: scale(1.2);
        opacity: 1;
      }
      100% {
        transform: scale(1);
      }
    }

    .confirmation-message {
      font-weight: 600;
      font-size: 1.75rem;
      margin-bottom: 0.75rem;
      color: #212529;
    }

    .confirmation-subtext {
      color: #6c757d;
      font-size: 1.1rem;
      margin-bottom: 2rem;
    }

    .btn-home {
      padding: 0.75rem 2rem;
      font-weight: 600;
      font-size: 1.1rem;
      border-radius: 50px;
      transition: background-color 0.3s ease;
    }

    .btn-home:hover {
      background-color: #218838;
      color: #fff;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
      .confirmation-card {
        margin: 50px 1rem;
        padding: 2rem 1.5rem;
      }
    }
  </style>
</head>
<body>

  <div class="hero_area">
    <!-- header section starts -->
    @include('home.header')
    <!-- header section ends -->

    <main class="flex-grow-1 d-flex align-items-center justify-content-center">
      <section class="confirmation-card">
        <i class="fas fa-check-circle confirmation-icon"></i>
        <h2 class="confirmation-message">Order Confirmed!</h2>
        <p class="confirmation-subtext">
          Thank you for your purchase using <strong>Cash on Delivery</strong>.
        </p>
        <a href="{{ url('/') }}" class="btn btn-success btn-home">
          <i class="fas fa-home me-2"></i> Back to Home
        </a>
      </section>
    </main>

    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->

    <div class="cpy_ text-center py-3 bg-light">
      <p class="mb-0">
        © 2021 All Rights Reserved By
        <a href="https://html.design/" target="_blank" rel="noopener noreferrer">Free Html Templates</a> <br />
        Distributed By
        <a href="https://themewagon.com/" target="_blank" rel="noopener noreferrer">ThemeWagon</a>
      </p>
    </div>
  </div>

  <!-- Bootstrap 5 JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
