@include('frontend.layouts.nav')




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
             <h1 class="m-0">{{--Page Title--}}</h1> 
          </div>
          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Top Navigation</li>
            </ol>
          </div> --}}
        </div>
      </div>
    </div>


    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">

{{-- page start from here --}}

<h1>Welcome to Car Rental Website</h1>


{{-- slider  --}}
<div id="demo" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ul class="carousel-indicators">
      <li data-target="#demo" data-slide-to="0" class="active"></li>
      <li data-target="#demo" data-slide-to="1"></li>
      <li data-target="#demo" data-slide-to="2"></li>
    </ul>
    
    <!-- The slideshow -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('storage/slide/s1.jpg') }}" alt="Los Angeles" width="1100" height="500">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('storage/slide/s2.jpg') }}" alt="Chicago" width="1100" height="500">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('storage/slide/s3.jpg') }}" alt="New York" width="1100" height="500">
      </div>
    </div>
    
    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>
{{-- end slider  --}}








<div class="col-12 row mt-2 text-center">
    <h3 class="text-uppercase text-success">Choose Your Car</h3>

    <form action="{{ route('frontend.search') }}" method="GET">
      @csrf
    <div class="row">
    <div class="col-5">Start Date: <input class="form-control" type="date" id="start_date" name="start_date" value='{{ old('start_date') ?? (isset($start_date) ? $start_date : now()->format('Y-m-d')) }}' /></div>

  <div class="col-5">End Date: <input class="form-control" type="date" id="end_date" name="end_date" value='{{ old('end_date') ?? (isset($end_date) ? $end_date : now()->format('Y-m-d')) }}' /></div>
  <div class="col-2"><button class="btn btn-primary" id="search">Search</button></div>
  </div>
  </form>

  </div>


@if(isset($availableCars))
<div class="container row mt-5 table-responsive">


      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Car Name</th>
          <th>Brand</th>
          <th>Model</th>
          <th>Type</th>
          <th>Year</th>
          <th>Image</th><th>Price/Day</th>
        </tr>
        </thead>
        <tbody>
    @foreach($availableCars as $car)        
      <tr>
          <td>{{ $car->name }}</td>
          <td>{{ $car->brand }}</td>
          <td>{{ $car->model }}</td>
          <td>{{ $car->car_type }}</td>
          <td>{{ $car->year }}</td>
          <td><img src="{{ asset('storage/cars/' . $car->image) }}" alt="{{ $car->name }}" class="img-fluid"></td>
          <td>{{ $car->daily_rent_price }}

            @auth
            <br><br>
            <button class="btn btn-primary rent-now-btn" 
                    data-bs-toggle="modal" 
                    data-bs-target="#rentModal" 
                    data-car-id="{{ $car->id }}" 
                    data-car-name="{{ $car->name }}" 
                    data-car-price="{{ $car->daily_rent_price }}">
                Book Now
            </button>
            @endauth
          </td>    

        </tr>
    @endforeach

        </tfoot>
      </table>
</div>

@endif



<!-- Rent Modal -->
<div class="modal fade" id="rentModal" tabindex="-1" aria-labelledby="rentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <form action="{{ route('rentals.store') }}" method="POST">
              @csrf
              <input type="hidden" name="car_id" id="car-id">
              @auth
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"> <!-- Auto-fill user_id -->
              @endauth
              
              <div class="modal-header">
                  <h5 class="modal-title" id="rentModalLabel">Rent Car</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              
              <div class="modal-body">
                  <div class="mb-3">
                      <label for="car-name" class="form-label">Car Name</label>
                      <input type="text" class="form-control" id="car-name" readonly>
                  </div>
                  
                  <div class="mb-3">
                      <label for="start-date" class="form-label">Start Date</label>
                      <input type="date" class="form-control" name="start_date" id="start-date" value="{{ old('start_date') ?? (isset($start_date) ? $start_date : '') }}" required readonly>
                  </div>
                  
                  <div class="mb-3">
                      <label for="end-date" class="form-label">End Date</label>
                      <input type="date" class="form-control" name="end_date" id="end-date" value="{{ old('end_date') ?? (isset($end_date) ? $end_date : '') }}" required readonly>
                  </div>
                  
                  <div class="mb-3">
                      <label for="rental-price" class="form-label">Price per Day</label>
                      <input type="text" class="form-control" id="rental-price" readonly>
                  </div>
                  
                  <div class="mb-3">
                      <label for="total-cost" class="form-label">Total Cost</label>
                      <input type="text" class="form-control" name="total_cost" id="total-cost" readonly>
                  </div>
              </div>
              
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Booking Confirm</button>
              </div>
          </form>
      </div>
  </div>
</div>




{{-- end page here --}}
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  





  


@include('frontend.layouts.footer')



<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      const rentNowButtons = document.querySelectorAll('.rent-now-btn');
      const carIdInput = document.getElementById('car-id');
      const carNameInput = document.getElementById('car-name');
      const carPriceInput = document.getElementById('rental-price');
      const totalCostInput = document.getElementById('total-cost');
      const startDateInput = document.getElementById('start-date');
      const endDateInput = document.getElementById('end-date');

      // Function to calculate total cost based on the date range and car price
      function calculateTotalCost() {
          const startDate = new Date(startDateInput.value);
          const endDate = new Date(endDateInput.value);
          const dailyRentPrice = parseFloat(carPriceInput.value);

          if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime()) && dailyRentPrice) {
              const timeDifference = endDate - startDate;
              const dayDifference = timeDifference / (1000 * 3600 * 24) + 1; // Ensure minimum of 1 day
              const totalCost = dayDifference * dailyRentPrice;

              if (dayDifference > 0) {
                  totalCostInput.value = totalCost.toFixed(2); // Set total cost
              } else {
                  totalCostInput.value = ''; // Invalid date range
              }
          }
      }

      // When 'Rent Now' button is clicked, populate modal fields and calculate total cost
      rentNowButtons.forEach(button => {
          button.addEventListener('click', function() {
              const carId = this.getAttribute('data-car-id');
              const carName = this.getAttribute('data-car-name');
              const carPrice = this.getAttribute('data-car-price');

              carIdInput.value = carId;
              carNameInput.value = carName;
              carPriceInput.value = carPrice;

              // Automatically calculate total cost as soon as the modal opens
              calculateTotalCost();
          });
      });

      // Recalculate total cost when the date fields change
      startDateInput.addEventListener('change', calculateTotalCost);
      endDateInput.addEventListener('change', calculateTotalCost);
  });
</script>