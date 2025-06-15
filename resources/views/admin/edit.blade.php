<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>

    {{-- Include Bootstrap CSS from your admin layout --}}
    @include('admin.css')
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

            <div class="container mt-4">
              <div class="row justify-content-center">
                <div class="col-md-8">
                  <div class="card">
                    <div class="card-header bg-primary text-white">
                      <h4 class="mb-0">Edit Category</h4>
                    </div>
                    <div class="card-body">
                      <form action="{{ route('admin.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group mb-3">
                          <label for="name" class="text-white">Category Name</label>
                          <input 
                            type="text"  
                            value="{{ old('name', $category->name) }}" 
                            class="form-control bg-dark text-white border-secondary" 
                            id="name" 
                            name="name" 
                            placeholder="Enter category name" 
                            required>
                        </div>

                        <div class="form-group mb-4">
                          <label for="status" class="text-white">Status</label>
                          <select 
                            class="form-control bg-dark text-white border-secondary" 
                            id="status" 
                            name="status" 
                            required>
                            <option value="" disabled {{ $category->status ? '' : 'selected' }}>Select status</option>
                            <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                          </select>
                        </div>

                        <button type="submit" class="btn btn-success">Update Category</button>
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

    {{-- Include JS --}}
    @include('admin.script')
  </body>
</html>
