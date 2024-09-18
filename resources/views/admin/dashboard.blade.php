@include('admin.layouts.header')

@include('admin.layouts.sidebar')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Car Rental Admin Dashboard</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->




    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $totalCars }}</h3>

                <p>Total Car</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ route('admin.cars.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $todays_total_availableCars }}<sup style="font-size: 20px"></sup></h3>

                <p>Todays Available Car</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('admin.cars.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $totalUsers }}</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('admin.customers.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$totalEarnings}}</h3>

                <p>Total Earnings</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('admin.rentals.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->

            <!-- /.card -->
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">On Going Rentals List</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                    <tr style='background-color:rgb(60, 121, 211)'>
                    <th>Car</th>
                    <th>Customer</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Amount</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($rentals as $rental)
                    <tr>
                    <td>
                      <img src="{{ asset('storage/cars/' . $rental->car->image) }}" class="img-circle img-size-32 mr-2">
                      {{ $rental->car->name }}
                    </td>
                    <td>{{ $rental->user->name }}</td>
                    <td>{{ $rental->start_date }}</td>
                    <td>{{ $rental->end_date }}</td>
                    <td>{{ $rental->total_cost }}</td>
                    <td>
                      <a href="{{ route('admin.rentals.edit', $rental->id) }}"><button class="btn btn-primary">Update</button></a>
                  </td>
                  </tr>
                  @endforeach
                  
                  </tbody>
                </table>
              </div>
            </div>



            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Car Wise Total Service Days</h3>

              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                    <tr style='background-color:rgb(218, 94, 207)'>
                    <th>Car</th>
                    <th>Model</th>
                    <th>Total Days</th>
                    <th>Total Earning</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($car_services as $car_service)
                    <tr>
                    <td>
                      <img src="{{ asset('storage/cars/' . $car_service->car->image) }}" class="img-circle img-size-32 mr-2">
                      {{ $car_service->car->name }}
                    </td>
                    <td>{{ $car_service->car->model }}</td>
                    <td>{{ $car_service->total_days }}</td>
                    <td>{{ $car_service->total_cost }}</td>
                  </tr>
                  @endforeach
                  <tr style='background-color:tomato'>
                    <td colspan="3">Total Earning</td>  
                    <td>{{ $totalEarnings }}</td>
                  </tr>
                  
                  </tbody>
                </table>
              </div>
            </div>            



</section>
          <!-- /.Left col -->

          
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Current Available Cars</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                    <tr style='background-color:green'>
                    <th>Car</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Year</th>
                  </tr>
                  </thead>
                  <tbody>
          @foreach($availablecars as $car)
                    <tr>
                    <td>
                      <img src="{{ asset('storage/cars/' . $car->image) }}" class="img-circle img-size-32 mr-2">
                      {{ $car->name }}
                    </td>
                    <td>{{ $car->brand }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->year }}</td>
                  </tr>
          @endforeach
                  
                  </tbody>
                </table>
              </div>
            </div>

</section>
</div>
<!-- /.row (main row) -->








      </div><!-- /.container-fluid -->
</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  
  
  
  
  
  
  
  
  @include('admin.layouts.footer')
