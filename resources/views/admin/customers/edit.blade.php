@include('admin.layouts.header')

@include('admin.layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Customer</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">



    <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Customer Name</label>
            <input type="text" class="form-control" name="name" value="{{ $customer->name }}" required>
        </div>
    
        <div class="mb-3">
            <label for="Email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ $customer->email }}" required>
        </div>

        <div class="mb-3">
          <label for="Email" class="form-label">Mobile</label>
          <input type="text" class="form-control" name="mobile_no" value="{{ $customer->mobile_no }}" required>
      </div>
      
      <div class="mb-3">
        <label for="Address" class="form-label">Address</label>
        <input type="text" class="form-control" name="address" value="{{ $customer->address }}" required>
    </div>      
    
        <div class="mb-3">
            <label for="Password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" value="" >
        </div>
    
      


    
        <button type="submit" class="btn btn-primary">Update Customer</button>
    </form>




</div>
</section>
</div>



@include('admin.layouts.footer')
