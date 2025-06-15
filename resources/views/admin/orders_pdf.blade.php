<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Orders Overview PDF</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    
    table, th, td {
      border: 1px solid #ddd;
    }

    th, td {
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    .text-center {
      text-align: center;
    }
    
    .header {
      margin-bottom: 20px;
    }

    .header h1 {
      text-align: center;
      font-size: 24px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

  <div class="header">
    <h1>Orders Overview</h1>
    <p class="text-center">Date: {{ \Carbon\Carbon::now()->toFormattedDateString() }}</p>
  </div>

  <table>
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
      </tr>
    </thead>
    <tbody>
      @foreach ($orders as $order)
      <tr>
        <td><strong>#{{ $order->id }}</strong></td>
        <td>
          @if($order->product && $order->product->image)
            <img src="{{ public_path('storage/' . $order->product->image) }}" alt="Product Image" width="60" height="60" />
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
      </tr>
      @endforeach
    </tbody>
  </table>

</body>
</html>
