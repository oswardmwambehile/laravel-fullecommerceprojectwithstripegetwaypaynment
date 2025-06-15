<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Product Details</title>
  @include('admin.css')

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    body {
      background: radial-gradient(circle at top left, #1f1f2e, #121212);
      color: #f1f1f1;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .product-card {
      background: linear-gradient(145deg, #1a1a2e, #121212);
      border-radius: 16px;
      padding: 2.5rem;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
      transition: all 0.3s ease;
      position: relative;
    }

    .product-card::before {
      content: '';
      position: absolute;
      top: -2px;
      left: -2px;
      right: -2px;
      bottom: -2px;
      background: linear-gradient(135deg, #00c6ff, #0072ff);
      border-radius: 18px;
      z-index: -1;
      opacity: 0.1;
      filter: blur(10px);
    }

    .product-image {
      width: 100%;
      border-radius: 12px;
      object-fit: cover;
      max-height: 320px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
    }

    .badge-category {
      background-color: #0dcaf0;
      color: #000;
      font-weight: 600;
      font-size: 0.9rem;
      padding: 0.4rem 0.9rem;
      border-radius: 50px;
      display: inline-block;
      margin-top: 0.5rem;
    }

    .product-header h2 {
      font-weight: 700;
      font-size: 2rem;
      color: #0dcaf0;
      text-shadow: 0 0 5px rgba(13, 202, 240, 0.3);
    }

    .divider {
      height: 1px;
      background: #2c2c3e;
      margin: 2rem 0;
    }

    .price-info {
      font-size: 1.1rem;
      line-height: 1.6;
    }

    .price-info .label {
      font-weight: 600;
      opacity: 0.7;
    }

    .price-info .value {
      font-weight: 700;
    }

    .desc-box {
      background: #181828;
      padding: 1.5rem;
      border-radius: 12px;
      font-size: 0.96rem;
      line-height: 1.7;
      border-left: 4px solid #0dcaf0;
      box-shadow: inset 0 0 10px rgba(0, 255, 255, 0.05);
    }

    .back-btn {
      background: linear-gradient(to right, #343a40, #23272b);
      color: #fff;
      border-radius: 30px;
      padding: 0.6rem 1.4rem;
      font-weight: 600;
    }

    .back-btn:hover {
      background-color: #495057;
    }

    .product-meta-label {
      font-size: 0.85rem;
      opacity: 0.6;
    }

    .product-meta-value {
      font-weight: bold;
    }

    .meta-section {
      display: flex;
      justify-content: space-between;
      margin-bottom: 1rem;
    }
  </style>
</head>

<body>
<div class="container-scroller">
  @include('admin.sidebar')

  <div class="container-fluid page-body-wrapper">
    @include('admin.header')

    <div class="main-panel">
      <div class="content-wrapper">
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
              <div class="product-card">

                <div class="product-header text-center mb-4">
                  <h2><i class="bi bi-box-fill"></i> {{ $product->title }}</h2>
                  <div class="badge-category">
                    {{ $product->category->name ?? 'Uncategorized' }}
                  </div>
                </div>

                @if ($product->image)
                  <div class="mb-4 text-center">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="product-image">
                  </div>
                @else
                  <p class="text-muted text-center">No image available.</p>
                @endif

                <div class="divider"></div>

                <div class="price-info row mb-4">
                  <div class="col-sm-6">
                    <p class="label">Price:</p>
                    <p class="value text-success">${{ number_format($product->price, 2) }}</p>
                  </div>
                  <div class="col-sm-6">
                    <p class="label">Discount:</p>
                    <p class="value text-warning">${{ number_format($product->discount_price, 2) ?? '0.00' }}</p>
                  </div>
                </div>

                <div class="meta-section">
                  <div>
                    <p class="product-meta-label">Available Quantity</p>
                    <p class="product-meta-value">{{ $product->quantity }}</p>
                  </div>
                  <div>
                    <p class="product-meta-label">Category</p>
                    <p class="product-meta-value">{{ $product->category->name ?? 'Uncategorized' }}</p>
                  </div>
                </div>

                <div class="divider"></div>

                <div class="mb-3">
                  <p class="fw-bold text-info mb-2">📝 Product Description</p>
                  <div class="desc-box">
                    {!! nl2br(e($product->description ?? 'No description provided.')) !!}
                  </div>
                </div>

                <div class="text-end mt-4">
                  <a href="{{ route('products.index') }}" class="btn back-btn">
                    <i class="bi bi-arrow-left-circle-fill me-1"></i> Back to List
                  </a>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div> <!-- content-wrapper -->
    </div> <!-- main-panel -->
  </div> <!-- page-body-wrapper -->
</div> <!-- container-scroller -->

@include('admin.script')
</body>
</html>
