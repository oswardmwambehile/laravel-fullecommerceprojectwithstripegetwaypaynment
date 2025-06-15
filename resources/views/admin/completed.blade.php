<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Orders Overview</title>
  
  @include('admin.css')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #121212;
      color: #f1f1f1;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .page-title {
      color: #0dcaf0;
      text-align: center;
      margin: 1.5rem 0;
      font-weight: 700;
      font-size: 1.8rem;
    }

    .product-image {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 10px;
    }

    .status-badge {
      padding: 5px 14px;
      border-radius: 20px;
      font-weight: bold;
      font-size: 0.85rem;
      text-transform: uppercase;
      display: inline-block;
      letter-spacing: 0.05em;
    }

    .paid {
      background-color: #198754;
      color: white;
    }

    .pending {
      background-color: #ffc107;
      color: #212529;
    }

    .failed {
      background-color: #dc3545;
      color: white;
    }

    .delivery {
      background-color: #0dcaf0;
      color: #212529;
    }

    .table-responsive {
      margin-bottom: 2rem;
      background: rgba(0, 0, 0, 0.1);
      border-radius: 14px;
      padding: 1rem;
    }

    table {
      width: 100%;
      color: #f1f1f1;
    }

    thead th {
      background-color: #222;
      color: #0dcaf0;
      padding: 1rem;
      text-align: left;
    }

    tbody tr {
      background-color: rgba(255, 255, 255, 0.05);
      border-radius: 10px;
      transition: background-color 0.3s;
    }

    tbody tr:hover {
      background-color: #444;
    }

    tbody td {
      padding: 1rem;
      vertical-align: middle;
    }

    .no-orders {
      text-align: center;
      color: #888;
      margin-top: 4rem;
      font-size: 1.2rem;
    }

    .modal-content {
      background-color: #1f1f1f;
      border-radius: 10px;
      color: #f1f1f1;
    }

    .form-select {
      background-color: #333;
      border: 1px solid #444;
      color: #f1f1f1;
    }

    .btn-warning {
      background-color: #ffae42;
      color: #212529;
      font-weight: 700;
    }

    .btn-warning:hover {
      background-color: #f6a300;
      color: #fff;
    }

    .modal-header, .modal-footer {
      border: none;
    }

    .modal-title {
      color: #0dcaf0;
      font-weight: 700;
    }

    .back-btn {
      background: #333;
      color: #f1f1f1;
      border-radius: 30px;
      padding: 0.6rem 1.6rem;
      font-weight: 700;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
    }

    .back-btn:hover {
      background-color: #495057;
      color: #fff;
    }
  </style>

</head>

<body>
  <div class="container-scroller">
    @include('admin.sidebar')

    <div class="container-fluid page-body-wrapper">
      @include('admin.header')

      <div class="main-panel">
        <div class="content-wrapper mt-5">
            <div class="text-end mt-4 mb-4">
  <a href="{{ route('orders.download_pdf') }}" class="btn btn-sm btn-info">
    <i class="bi bi-download me-2"></i> Download Orders as PDF
  </a>
</div>

          <div class="container">
            <h2 class="page-title"><i class="bi bi-table me-2"></i> Orders Overview</h2>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($orders->count())
            <div class="table-responsive">
              <table class="table table-borderless align-middle">
                <thead>
                  <tr>
                    <th>#ID</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>User</th>
                    <th>User Phone</th>
                    <th>Payment</th>
                    <th>Delivery</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orders as $order)
                  <tr>
                    <td><strong>#{{ $order->id }}</strong></td>
                    <td>
                      @if($order->product && $order->product->image)
                      <img src="{{ asset('storage/' . $order->product->image) }}" alt="Product Image" class="product-image" />
                      @else
                      <span class="text-muted">No image</span>
                      @endif
                    </td>
                    <td>{{ $order->product->title ?? 'Deleted Product' }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>{{ $order->user->phone ?? 'N/A' }}</td>
                    <td>
                      <span class="status-badge 
                        {{ strtolower($order->paynment_status) === 'paid' ? 'paid' : 
                           (strtolower($order->paynment_status) === 'pending' ? 'pending' : 'failed') }}">
                        {{ ucfirst($order->paynment_status) }}
                      </span>
                    </td>
                    <td>
                      <span class="status-badge delivery">
                        {{ ucfirst($order->delivery_status) }}
                      </span>
                    </td>
                    <td>${{ number_format($order->price, 2) }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>${{ number_format($order->price * $order->quantity, 2) }}</td>
                    <td>
                      <span class="text-info fw-semibold">
                        {{ ucfirst($order->status) }}
                      </span>
                    </td>
                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                    <td>
                      <!-- Button trigger modal -->
                      <button 
                        class="btn btn-sm btn-warning" 
                        data-bs-toggle="modal" 
                        data-bs-target="#updateStatusModal"
                        data-orderid="{{ $order->id }}"
                        data-currentstatus="{{ $order->status }}">
                        Update Status
                      </button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @else
            <div class="no-orders">
              <i class="bi bi-inbox"></i>
              <p>No orders found.</p>
            </div>
            @endif

            <div class="text-end mt-4">
              <a href="{{ url()->previous() }}" class="back-btn">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="POST" id="updateStatusForm">
        @csrf
        @method('PUT')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="updateStatusLabel">Update Order Status</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="order_id" id="modalOrderId" />

            <div class="mb-3">
              <label for="statusSelect" class="form-label">Select Status</label>
              <select class="form-select" name="status" id="statusSelect" required>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Update Status</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  @include('admin.script')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // When modal is shown, populate the form and action URL
    var updateStatusModal = document.getElementById('updateStatusModal');
    updateStatusModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var orderId = button.getAttribute('data-orderid');
      var currentStatus = button.getAttribute('data-currentstatus');

      // Update form action dynamically
      var form = document.getElementById('updateStatusForm');
      form.action = `/orders/${orderId}/status`;

      // Set hidden input value
      document.getElementById('modalOrderId').value = orderId;

      // Set select value to current status
      var statusSelect = document.getElementById('statusSelect');
      statusSelect.value = currentStatus.toLowerCase();
    });
  </script>
</body>

</html>
