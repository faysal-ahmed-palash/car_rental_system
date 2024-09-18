@include('admin.layouts.header')

@include('admin.layouts.sidebar')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Cars</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->




    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

    <a href="{{ route('admin.cars.create') }}" class="btn btn-primary">Add New Car</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Year</th>
                <th>Type</th>
                <th>Daily Rent Price</th>
                <th>Availability</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $car)
                <tr>
                    <td>{{ $car->name }}</td>
                    <td>{{ $car->brand }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->year }}</td>
                    <td>{{ $car->car_type }}</td>
                    <td>{{ $car->daily_rent_price }}</td>
                    <td>{{ $car->availability ? 'Available' : 'Not Available' }}</td>
                    <td>
                        <a href="{{ route('admin.cars.edit', $car->id) }}">Edit</a>
                        <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
      
  
  
  
  </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('admin.layouts.footer')
