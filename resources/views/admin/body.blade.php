<div class="main-panel">
  <div class="content-wrapper">

    <div class="row">
      <!-- Total Customers -->
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">{{$totalUsers}}</h3>
                
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success ">
                  <span class="mdi mdi-arrow-top-right icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Total Customers</h6>
          </div>
        </div>
      </div>

      <!-- Total Orders -->
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">{{ $totalOrders }}</h3>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success">
                  <span class="mdi mdi-arrow-top-right icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Total Orders</h6>
          </div>
        </div>
      </div>

      <!-- Total Products -->
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">{{ $totalProducts }}</h3>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-danger">
                  <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Total Products</h6>
          </div>
        </div>
      </div>

      <!-- Total Completed Orders -->
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">{{$completedOrders}}</h3>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success ">
                  <span class="mdi mdi-arrow-top-right icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Total Completed Orders</h6>
          </div>
        </div>
      </div>

      <!-- Total Cancelled Orders -->
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">{{$cancelledOrders}}</h3>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success ">
                  <span class="mdi mdi-arrow-top-right icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Total Cancelled Orders</h6>
          </div>
        </div>
      </div>

      <!-- Total Pending Orders -->
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">{{$pendingOrders}}</h3>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success ">
                  <span class="mdi mdi-arrow-top-right icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Total Processing Orders</h6>
          </div>
        </div>
      </div>

      <!-- Total Processing Orders -->
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">{{$processingOrders}}</h3>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success ">
                  <span class="mdi mdi-arrow-top-right icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Total Processing Orders</h6>
          </div>
        </div>
      </div>

      <!-- Total Revenue -->
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">${{$totalRevenue}}</h3>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success ">
                  <span class="mdi mdi-arrow-top-right icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Total Revenue</h6>
          </div>
        </div>
      </div>
    </div> <!-- end cards row -->

    <!-- Donut Chart Section -->
    <div class="row mt-4">
      <div class="col-md-6 offset-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title text-center">Order Status Distribution</h4>
            <div style="position: relative; width: 100%; max-width: 400px; margin: auto;">
              <canvas id="order-status-chart"></canvas>
              <div style="
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 24px;
                font-weight: 700;
                pointer-events: none;
                user-select: none;
              ">
                KES {{ number_format($totalRevenue, 2) }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- end donut chart row -->

  </div>
  <!-- content-wrapper ends -->

  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
        Copyright © bootstrapdash.com 2020
      </span>
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
        Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com
      </span>
    </div>
  </footer>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('order-status-chart').getContext('2d');

  const data = {
    labels: ['Completed Orders', 'Pending Orders', 'Cancelled Orders', 'Processing Orders'],
    datasets: [{
      label: 'Orders',
      data: [
        {{ $completedOrders }},
        {{ $pendingOrders }},
        {{ $cancelledOrders }},
        {{ $processingOrders }}
      ],
      backgroundColor: [
        'rgba(54, 162, 235, 0.7)',  // blue
        'rgba(255, 206, 86, 0.7)',  // yellow
        'rgba(255, 99, 132, 0.7)',  // red
        'rgba(75, 192, 192, 0.7)'   // green
      ],
      borderWidth: 2,
      borderColor: 'white',
      hoverOffset: 30,
    }]
  };

  const options = {
    cutout: '70%',
    responsive: true,
    plugins: {
      legend: {
        position: 'bottom',
        labels: {
          padding: 20,
          font: { size: 14 }
        }
      },
      tooltip: {
        enabled: true
      }
    }
  };

  new Chart(ctx, {
    type: 'doughnut',
    data: data,
    options: options
  });
</script>
