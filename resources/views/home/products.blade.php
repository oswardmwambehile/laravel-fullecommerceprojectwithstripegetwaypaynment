<section class="product_section layout_padding">
   <div class="container">
      <!-- Section Heading + Search Bar -->
      <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
         <div class="heading_container heading_center flex-grow-1">
            <h2>
               Our <span>products</span>
            </h2>
         </div>
         <!-- Search Form -->
         <form action="{{url('search')}}" method="GET" class="d-flex" role="search">
            <div class="input-group">
               <input type="text" name="query" class="form-control shadow-sm rounded-start border-dark" placeholder="Search products..." aria-label="Search" required>
               <button class="btn btn-dark shadow-sm rounded-end" type="submit">Search</button>
            </div>
         </form>
      </div>

      <!-- Products List -->
      <div class="row">
         @foreach($product as $item)
         <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
            <div class="box shadow-sm border rounded p-3 h-100">
               <div class="option_container">
                  <div class="options">
                     <a href="{{ url('product_detail', $item->id) }}" class="option1">View details</a>
                     <form action="{{url('add_cart', $item->id)}}" method="POST" class="mt-3">
                        @csrf
                        <div class="input-group mb-3" style="max-width: 200px;">
                            <input type="number" name="quantity" class="form-control" min="1"  value="1">
                            <button class="btn btn-dark" type="submit">Add to Cart</button>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="img-box mb-3">
                  <img src="{{ asset('storage/' . $item->image) }}" alt="Product Image" class="product-image img-fluid rounded">
               </div>
               <div class="detail-box text-center">
                  <h5 class="fw-bold">{{ $item->title }}</h5>
                  <h6 class="text-muted">${{ $item->price }}</h6>
               </div>
            </div>
         </div>
         @endforeach
      </div>

      <!-- Pagination -->
      <div class="row justify-content-center mt-4">
         <div class="col-auto">
            {{ $product->links('pagination::bootstrap-5') }}
         </div>
      </div>
   </div>
</section>
<style>
   product_section input[type="text"] {
    min-width: 250px;
    transition: box-shadow 0.3s ease;
}

.product_section input[type="text"]:focus {
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
    border-color: #333;
}
</style>
