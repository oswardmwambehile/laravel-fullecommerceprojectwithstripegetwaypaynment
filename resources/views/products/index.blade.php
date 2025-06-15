<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    @include('admin.css')

    <style>
      body {
        background-color: #121212;
        color: #fff;
      }

      .card-custom {
        background-color: #1e1e2f;
        border: 1px solid #2e2e3e;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
      }

      .btn-custom {
        border-radius: 20px;
        font-weight: 500;
      }

      .btn-warning {
        background-color: #f0ad4e;
        border-color: #f0ad4e;
      }

      .btn-danger {
        background-color: #d9534f;
        border-color: #d43f3a;
      }

      .table-dark th, .table-dark td {
        vertical-align: middle;
      }

      .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #1a1a2e;
      }

      .alert-success {
        background-color: #14532d;
        border-color: #14532d;
        color: #d1e7dd;
      }

      img.product-thumb {
        max-width: 60px;
        height: auto;
        border-radius: 5px;
      }
    </style>
  </head>

  <body>
    <div class="container-scroller">
      {{-- Sidebar --}}
      @include('admin.sidebar')

      <div class="container-fluid page-body-wrapper">
        {{-- Navbar --}}
        @include('admin.header')

        <div class="main-panel">
          <div class="content-wrapper">
            <div class="container mt-5">
              <div class="card card-custom">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h4 class="mb-0 text-white">🛒 Product List</h4>
                  <a href="{{ route('products.create') }}" class="btn btn-success btn-sm btn-custom">➕ Add New Product</a>
                </div>

                <div class="card-body">
                  @if (session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif

                  <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Image</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Price</th>
                          <th>Discount</th>
                          <th>Quantity</th>
                          <th class="text-center">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($products as $product)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                              @if($product->image)
                                <img src="{{ asset('storage/'. $product->image) }}" alt="product image" class="product-thumb">
                              @else
                                <span class="text-muted">No image</span>
                              @endif
                            </td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>${{ number_format($product->discount_price, 2) }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td class="text-center">
                              <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm btn-custom me-1" title="View"><i class="bi bi-eye-fill"></i></a>

                              <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm btn-custom me-1" title="Edit"><i class="bi bi-pencil-square"></i></a>

                              <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure you want to delete this product?')" class="btn btn-danger btn-sm btn-custom" title="Delete"><i class="bi bi-trash-fill"></i></button>
                              </form>
                            </td>
                          </tr>
                        @empty
                          <tr>
                            <td colspan="8" class="text-center text-muted">No products found.</td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div> <!-- /container -->
          </div> <!-- /content-wrapper -->
        </div> <!-- /main-panel -->
      </div> <!-- /page-body-wrapper -->
    </div> <!-- /container-scroller -->

    {{-- JS --}}
    @include('admin.script')
  </body>
</html>
