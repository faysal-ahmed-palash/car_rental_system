@include('admin.layouts.header')

@include('admin.layouts.sidebar')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage ALL Booking</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->




    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">


    <table class="table">
        <thead>
            <tr>
                <th>Rental ID</th>
                <th>Customer Name</th>
                <th>Car</th>
                <th>Rental Period</th>
                <th>Total Cost</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rentals as $rental)
                <tr>
                    <td>{{ $rental->id }}</td>
                    <td>{{ $rental->user->name }}</td>
                    <td>{{ $rental->car->name }}</td>
                    <td>{{ $rental->start_date }} - {{ $rental->end_date }}</td>
                    <td>{{ $rental->total_cost }}</td>
                    <td>{{ $rental->status }}</td>
                    <td>
                        <a href="{{ route('admin.rentals.edit', $rental->id) }}">Edit</a>
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