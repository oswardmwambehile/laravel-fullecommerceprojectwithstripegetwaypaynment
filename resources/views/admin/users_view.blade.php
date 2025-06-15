<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Details</title>
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
      padding: 2rem;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
    }

    .user-avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #444;
    }

    .info-label {
      font-weight: bold;
      color: #ccc;
    }

    .info-value {
      color: #fff;
    }

    .btn-back {
      background-color: #6c757d;
      border-color: #6c757d;
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
              <div class="d-flex align-items-center mb-4">
                <img src="{{ $user->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}" alt="Avatar" class="user-avatar me-4">
                <div>
                  <h3 class="mb-0">{{ $user->name }}</h3>
                  <p class="mb-0 text-muted">{{ $user->email }}</p>
                </div>
              </div>

              <hr class="bg-secondary">

              <div class="row">
                <div class="col-md-6 mb-3">
                  <span class="info-label">Phone:</span><br>
                  <span class="info-value">{{ $user->phone ?? 'N/A' }}</span>
                </div>
                <div class="col-md-6 mb-3">
                  <span class="info-label">Email Verified:</span><br>
                  <span class="info-value">{{ $user->email_verified_at ? $user->email_verified_at->format('Y-m-d H:i') : 'Not Verified' }}</span>
                </div>
                <div class="col-md-6 mb-3">
                  <span class="info-label">Created At:</span><br>
                  <span class="info-value">{{ $user->created_at->format('Y-m-d H:i') }}</span>
                </div>
                <div class="col-md-6 mb-3">
                  <span class="info-label">Role:</span><br>
                  <span class="info-value">{{ $user->role ?? 'User' }}</span>
                </div>
              </div>

              <div class="mt-4">
                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-custom btn-back">← Back to User List</a>
              </div>
            </div>
          </div>
        </div> <!-- /content-wrapper -->
      </div> <!-- /main-panel -->
    </div> <!-- /page-body-wrapper -->
  </div> <!-- /container-scroller -->

  @include('admin.script')
</body>
</html>
