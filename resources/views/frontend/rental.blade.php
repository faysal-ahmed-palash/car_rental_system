@include('frontend.layouts.nav')

@php
    use Carbon\Carbon;
@endphp



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

<h1>Rental History</h1>

<div class="container row mt-5 table-responsive">


  <table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>Rent ID</th>
      <th>Car Name</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Total Days</th>
      <th>Per Day Cost</th>
      <th>Total Cost</th>
      <th>Image</th><th>Status</th>
      <th></th>
    </tr>
    </thead>
    <tbody>
@foreach($rentals as $rental)        
<tr>
      <td>{{ $rental->id }}</td>
      <td>{{ $rental->car->name }}</td>
      <td>{{ $rental->start_date }}</td>
      <td>{{ $rental->end_date }}</td>
      <td>{{ $rental->total_days }}</td>
      <td>{{ $rental->per_day_cost }}</td>
      <td>{{ $rental->total_cost }}</td>
      <td><img src="{{ asset('storage/cars/' . $rental->car->image) }}" class="img-fluid"></td>
      <td>{{ $rental->status }}</td>
      <td>

        <!-- Only show the Cancel Booking button if the current date is less than the rental's start date -->
        @if (Carbon::now()->lt(Carbon::parse($rental->start_date)->startOfDay()) && $rental->status == 'Ongoing')     
        <form action="{{ route('rentals.update', $rental->id) }}" method="POST">
          @csrf
          @method('PATCH')
          <button type="submit" class="btn btn-danger">Cancel Booking</button>
        </form>
      @endif
      </td>

    </tr>
@endforeach

    </tfoot>
  </table>
</div>







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