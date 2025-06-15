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
  <link rel="shortcut icon" href="images/favicon.png" type="image/png" />
  <title>Fashion</title>

  <!-- Bootstrap 5 CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

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
    <!-- header section starts -->
    @include('home.header')
    <!-- end header section -->

    <!-- slider section -->
    <div class="container py-5">
      <div class="row">
        <!-- Left: Cart Items -->
        <div class="col-lg-8">
          <h4 class="fw-bold mb-4">Shopping Cart</h4>

          @if($cartItems->count())
            @php $grandTotal = 0; @endphp
            @foreach($cartItems as $item)
              @php
                $total = $item->product->price * $item->quantity;
                $grandTotal += $total;
              @endphp
              <div class="card mb-3 shadow-sm">
                <div class="row g-0">
                  <div class="col-md-3 text-center p-3">
                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="img-fluid" style="max-height: 140px;" />
                  </div>
                  <div class="col-md-6">
                    <div class="card-body">
                      <h5 class="card-title">{{ $item->product->name }}</h5>
                      <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($item->product->description, 90) }}</p>
                      <p class="card-text text-danger fw-bold">${{ number_format($item->product->price, 2) }}</p>

                      <form action="{{ url('remove_cart', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-link text-danger p-0">Delete</button>
                      </form>
                      <span class="mx-2">|</span>

                      <!-- Update Cart button triggers modal -->
                      <button
                        type="button"
                        class="btn btn-link text-primary p-0"
                        data-bs-toggle="modal"
                        data-bs-target="#updateCartModal"
                        data-id="{{ $item->id }}"
                        data-quantity="{{ $item->quantity }}"
                      >
                        Update Cart
                      </button>
                    </div>
                  </div>
                  <div class="col-md-3 text-center p-3">
                    <div class="input-group mb-2">
                      <span class="input-group-text">Qty</span>
                      <input type="number" class="form-control" value="{{ $item->quantity }}" readonly />
                    </div>
                    <p class="fw-semibold text-success">${{ number_format($total, 2) }}</p>
                  </div>
                </div>
              </div>
            @endforeach
          @else
            <div class="alert alert-info text-center">
              Your cart is empty. <br />
              <a href="{{ route('home.userpage') }}" class="btn btn-primary mt-3">Start Shopping</a>
            </div>
          @endif
        </div>

        <!-- Right: Cart Summary -->
        @if($cartItems->count())
          <div class="col-lg-4">
            <div class="card shadow-sm">
              <div class="card-body">
                <h5 class="card-title">Cart Summary</h5>
                <hr />
                <p class="d-flex justify-content-between">
                  <span>Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                  <strong>${{ number_format($grandTotal, 2) }}</strong>
                </p>

                <form action="{{ route('home.cod') }}" method="POST" class="mb-3">
                  @csrf
                  <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="1" name="gift" id="giftCheck" />
                    <label class="form-check-label" for="giftCheck">This order contains a gift</label>
                  </div>
                  <button type="submit" class="btn btn-warning w-100">Cash On Delivery</button>
                </form>

               <a href="{{ route('stripe', ['grandTotal' => $grandTotal]) }}" class="btn btn-success w-100">Pay By Card</a>
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>

    <!-- Modal for updating cart quantity -->
    <div
      class="modal fade"
      id="updateCartModal"
      tabindex="-1"
      aria-labelledby="updateCartModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <form method="POST" id="updateCartForm">
          @csrf
          @method('POST')
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateCartModalLabel">Update Cart Quantity</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <label for="cartQuantityInput" class="form-label">Quantity</label>
              <input
                type="number"
                class="form-control"
                id="cartQuantityInput"
                name="quantity"
                min="1"
                required
              />
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Cancel
              </button>
              <button type="submit" class="btn btn-primary">
                Update Quantity
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->

    <div class="cpy_">
      <p class="mx-auto">
        © 2021 All Rights Reserved By
        <a href="https://html.design/">Free Html Templates</a
        ><br />
        Distributed By
        <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
      </p>
    </div>
  </div>

  <!-- jQuery (optional, only if you need it) -->
  <script src="home/js/jquery-3.4.1.min.js"></script>

  <!-- Popper.js (required for Bootstrap) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

  <!-- Custom JS -->
  <script src="home/js/custom.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var updateCartModal = document.getElementById("updateCartModal");
      var quantityInput = document.getElementById("cartQuantityInput");
      var updateCartForm = document.getElementById("updateCartForm");

      const baseUrl = "{{ url('') }}"; // Laravel base URL (e.g. http://127.0.0.1:8000/public)

      updateCartModal.addEventListener("show.bs.modal", function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var cartId = button.getAttribute("data-id");
        var quantity = button.getAttribute("data-quantity");

        // Set modal input value and form action URL
        quantityInput.value = quantity;
        updateCartForm.action = baseUrl + "/update_cart/" + cartId;
      });
    });
  </script>
</body>
</html>
