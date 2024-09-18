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
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->




    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

    {{-- <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">Add New Car</a> --}}

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->mobile_no }}</td>
                    <td>{{ $customer->address }}</td>

    
                    <td>
                        <a href="{{ route('admin.customers.edit', $customer->id) }}">Edit</a>
                        <form action="{{ route('admin.cars.destroy', $customer->id) }}" method="POST">
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
