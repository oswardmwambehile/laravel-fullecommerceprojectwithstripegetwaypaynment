<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management</title>
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
            <div class="card card-custom">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-white">👥 User List</h4>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th> 
                        <th>Address</th> 
                        <th>UserType</th> <!-- Add Phone column -->
                        <th>Created At</th>
                        <th>Actions</th> <!-- Add Actions column -->
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($users as $user)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->phone }}</td> 
                          <td>{{ $user->address }}</td>
                          <td>
                        @if ($user->usertype == 1)
                          <span class="badge bg-warning text-dark">Admin</span>
                        @else
                          <span class="badge bg-info text-dark">Customer</span>
                        @endif
                      </td>
                        <td>{{ $user->created_at }}</td>
                          <td class="text-center">
                            <!-- View User Button -->
                            <a href="{{ route('admin.viewUser', $user->id) }}" class="btn btn-warning btn-sm btn-custom me-1">👁️ View</a>
                            
                            <!-- Delete User Button -->
                            <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure you want to delete this user?')" class="btn btn-danger btn-sm btn-custom">🗑️ Delete</button>
                            </form>
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="6" class="text-center text-muted">No users found.</td>
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

  @include('admin.script')
</body>
</html>
