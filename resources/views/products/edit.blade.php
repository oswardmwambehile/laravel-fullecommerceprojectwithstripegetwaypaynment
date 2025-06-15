<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    @include('admin.css')
  </head>
  <body>
      @include('sweetalert::alert')
    <div class="container-scroller">
      {{-- Sidebar --}}
      @include('admin.sidebar')

      <div class="container-fluid page-body-wrapper">
        {{-- Navbar --}}
        @include('admin.header')

        <div class="main-panel">
          <div class="content-wrapper">
            <div class="container mt-4">
              <div class="row justify-content-center">
                <div class="col-md-8">
                  <div class="card">
                    <div class="card-header bg-primary text-white">
                      <h4 class="mb-0">✏️ Edit Product</h4>
                    </div>

                    <div class="card-body">
                      <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="form-group mb-3">
                          <label for="title" class="text-white">Product Title</label>
                          <input type="text" class="form-control bg-dark text-white border-secondary" id="title" name="title"
                                 value="{{ old('title', $product->title) }}">
                        </div>

                        {{-- Description --}}
                        <div class="form-group mb-3">
                          <label for="description" class="text-white">Description</label>
                          <textarea class="form-control bg-dark text-white border-secondary" id="description" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
                        </div>

                        {{-- Image --}}
                        <div class="form-group mb-3">
                          <label class="text-white">Current Image</label><br>
                          @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" width="100" class="mb-2 rounded">
                          @else
                            <p class="text-muted">No image available.</p>
                          @endif

                          <label for="image" class="text-white">Change Image</label>
                          <input type="file" class="form-control bg-dark text-white border-secondary" id="image" name="image">
                        </div>

                        {{-- Category --}}
                        <div class="form-group mb-3">
                          <label for="category_id" class="text-white">Category</label>
                          <select class="form-control bg-dark text-white border-secondary" id="category_id" name="category_id">
                            <option value="" disabled>Select category</option>
                            @foreach ($categories as $category)
                              <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                              </option>
                            @endforeach
                          </select>
                        </div>

                        {{-- Quantity --}}
                        <div class="form-group mb-3">
                          <label for="quantity" class="text-white">Quantity</label>
                          <input type="number" class="form-control bg-dark text-white border-secondary" id="quantity" name="quantity"
                                 value="{{ old('quantity', $product->quantity) }}">
                        </div>

                        {{-- Price --}}
                        <div class="form-group mb-3">
                          <label for="price" class="text-white">Price</label>
                          <input type="number" step="0.01" class="form-control bg-dark text-white border-secondary" id="price" name="price"
                                 value="{{ old('price', $product->price) }}">
                        </div>

                        {{-- Discount Price --}}
                        <div class="form-group mb-4">
                          <label for="discount_price" class="text-white">Discount Price</label>
                          <input type="number" step="0.01" class="form-control bg-dark text-white border-secondary" id="discount_price" name="discount_price"
                                 value="{{ old('discount_price', $product->discount_price) }}">
                        </div>

                        <button type="submit" class="btn btn-warning">Update Product</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    @include('admin.script')
  </body>
</html>
