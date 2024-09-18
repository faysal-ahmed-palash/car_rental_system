@include('admin.layouts.header')

@include('admin.layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Rentals Info</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

    <form action="{{ route('admin.rentals.update', $rental->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Customer</label>
            <input type="text" class="form-control"  value="{{ $rental->user->name }}" readonly>
        </div> 
        
        
        <div class="mb-3">
            <label for="name" class="form-label">Start Date</label>
            <input type="date" class="form-control" name="start_date" value="{{ $rental->start_date }}" required>
        </div>
    
        <div class="mb-3">
            <label for="brand" class="form-label">End Date</label>
            <input type="date" class="form-control" name="end_date" value="{{ $rental->end_date }}" required>
        </div>

        <div class="mb-3">
            <label for="brand" class="form-label">Total Days</label>
            <input type="text" class="form-control" name="total_days" value="{{ $rental->total_days }}" required>
        </div> 
        
        <div class="mb-3">
            <label for="brand" class="form-label">Per Day Cost</label>
            <input type="text" class="form-control" name="per_day_cost" value="{{ $rental->per_day_cost }}" required>
        </div>        

        <div class="mb-3">
            <label for="brand" class="form-label">Total Cost</label>
            <input type="text" class="form-control" name="total_cost" value="{{ $rental->total_cost }}" required>
        </div>        
    
    
        <div class="mb-3">
            <label for="availability" class="form-label">Booking Status</label>
            <select class="form-select" name="status" required>
                <option value="Ongoing" {{ $rental->status=='Ongoing'? 'selected' : '' }}>Ongoing</option>
                <option value="Completed" {{ $rental->status=='Completed' ? 'selected' : '' }}>Completed</option>
                <option value="Canceled" {{ $rental->status=='Canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>

    
        <button type="submit" class="btn btn-primary">Update</button>
    </form>




</div>
</section>
</div>
@include('admin.layouts.footer')
