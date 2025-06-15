<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <title>My Orders - Famms</title>

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}" />
   <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
   <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
   <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />

   <style>
   /* (Same CSS as before for responsiveness & premium look) */
   .table-responsive {
     width: 100%;
     overflow-x: auto;
     -webkit-overflow-scrolling: touch;
     margin-bottom: 1rem;
     border-radius: 8px;
     box-shadow: 0 2px 12px rgba(0,0,0,0.1);
     background: #fff;
   }
   .table {
     min-width: 600px;
     border-collapse: separate;
     border-spacing: 0;
     width: 100%;
     font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
   }
   .table thead {
     background-color: #343a40;
     color: #fff;
     text-transform: uppercase;
     font-weight: 600;
   }
   .table th, .table td {
     padding: 12px 15px;
     text-align: left;
     vertical-align: middle;
     border-bottom: 1px solid #dee2e6;
   }
   .table tbody tr:hover {
     background-color: #f8f9fa;
     cursor: pointer;
     transition: background-color 0.3s ease;
   }
   .badge {
     font-size: 0.85em;
     padding: 0.35em 0.8em;
     border-radius: 12px;
     font-weight: 600;
     color: #fff;
     display: inline-block;
     text-align: center;
     white-space: nowrap;
   }
   /* Payment status colors */
   .badge-warning {
     background-color: #ffc107;
     color: #212529;
   }
   .badge-success {
     background-color: #28a745;
   }
   .badge-danger {
     background-color: #dc3545;
   }
   .btn-sm {
     font-size: 0.8em;
     padding: 4px 10px;
     border-radius: 5px;
   }
   @media (max-width: 767px) {
     .table-responsive {
       box-shadow: none;
       border-radius: 0;
     }
     .table thead {
       display: none;
     }
     .table, .table tbody, .table tr, .table td {
       display: block;
       width: 100%;
     }
     .table tr {
       margin-bottom: 1rem;
       border-bottom: 2px solid #dee2e6;
     }
     .table td {
       text-align: right;
       padding-left: 50%;
       position: relative;
     }
     .table td::before {
       content: attr(data-label);
       position: absolute;
       left: 15px;
       width: 45%;
       padding-left: 15px;
       font-weight: 700;
       text-align: left;
       white-space: nowrap;
     }
   }
   </style>
</head>
<body>
<div class="hero_area">
    @include('home.header')

    <div class="container my-4">
        <h2 class="mb-4">My Orders</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($orders->isEmpty())
            <div class="alert alert-info">You haven’t placed any orders yet.</div>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Product Title</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Cost</th>
                            <th>Payment Status</th>
                            <th>Delivery Status</th>
                             <th>Status</th>
                            <th>Ordered On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sumTotal = 0;
                        @endphp

                        @foreach ($orders as $order)
                            @php
                                $totalCost = $order->price * $order->quantity;
                                $sumTotal += $totalCost;
                            @endphp
                            <tr>
                                <td data-label="Order #">{{ $order->id }}</td>
                                <td data-label="Product Title">{{ $order->product->title ?? 'N/A' }}</td>
                                <td data-label="Price">${{ number_format($order->price, 2) }}</td>
                                <td data-label="Quantity">{{ $order->quantity }}</td>
                                <td data-label="Total Cost">${{ number_format($totalCost, 2) }}</td>
                                <td data-label="Payment Status">
                                    <span class="badge
                                        @if(strtolower($order->paynment_status) == 'cash on delivery') badge-warning
                                        @elseif(strtolower($order->paynment_status) == 'paid') badge-success
                                        @else badge-danger
                                        @endif">
                                        {{ ucfirst($order->paynment_status) }}
                                    </span>
                                </td>
                                <td data-label="Delivery Status">{{ ucfirst($order->delivery_status) }}</td>
                                <td data-label="Status">
                                    <span class="badge
                                        @if(strtolower($order->status) == 'pending') badge-warning
                                        @elseif(strtolower($order->status) == 'processing') badge-primary
                                        @elseif(strtolower($order->status) == 'completed') badge-success
                                        @else badge-danger
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td data-label="Ordered On">{{ $order->created_at->format('d M Y, h:i A') }}</td>
                                <td data-label="Action">
                                    @if ($order->status == 'pending')
                                        <form method="POST" action="{{ route('cancel.order', $order->id) }}" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                                        </form>
                                    @else
                                        <button class="btn btn-sm btn-secondary" disabled>No Action</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="4" style="text-align:right;">Grand Total:</th>
                            <th colspan="5" style="text-align:left;">${{ number_format($sumTotal, 2) }}</th>
                        </tr>
                    </tfoot>

                </table>
            </div>
        @endif
    </div>
</div>

<!-- Footer -->
<div class="cpy_ text-center py-3">
    <p class="mx-auto">© 2021 All Rights Reserved By
        <a href="https://html.design/">Free Html Templates</a><br>
        Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
    </p>
</div>

<!-- Scripts -->
<script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('home/js/popper.min.js') }}"></script>
<script src="{{ asset('home/js/bootstrap.js') }}"></script>
<script src="{{ asset('home/js/custom.js') }}"></script>
</body>
</html>
