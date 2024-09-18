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





        <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Car Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
        
            <div class="mb-3">
                <label for="brand" class="form-label">Brand</label>
                <input type="text" class="form-control" name="brand" id="brand" required>
            </div>
        
            <div class="mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" class="form-control" name="model" id="model" required>
            </div>
        
            <div class="mb-3">
                <label for="year" class="form-label">Year of Manufacture</label>
                <input type="number" class="form-control" name="year" id="year" required>
            </div>
        
            <div class="mb-3">
                <label for="car_type" class="form-label">Car Type</label>
                <input type="text" class="form-control" name="car_type" id="car_type" required>
            </div>
        
            <div class="mb-3">
                <label for="daily_rent_price" class="form-label">Daily Rent Price</label>
                <input type="number" step="0.01" class="form-control" name="daily_rent_price" id="daily_rent_price" required>
            </div>
        
            <div class="mb-3">
                <label for="availability" class="form-label">Availability</label>
                <select class="form-select" name="availability" id="availability" required>
                    <option value="1">Available</option>
                    <option value="0">Not Available</option>
                </select>
            </div>
        
            <div class="mb-3">
                <label for="image" class="form-label">Car Image</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>
        
            <button type="submit" class="btn btn-primary">Add Car</button>
        </form>
        




      </div>
    </section>
    </div>
@include('admin.layouts.footer')
