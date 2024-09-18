  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
      <img src="{{ asset ('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Car Rental</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset ('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Faysal</a>
        </div>
      </div>



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.dashboard')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Home Page</p>
                </a>
              </li>

            </ul>
          </li>



          <li class="nav-item">
            <a href="{{ route('admin.cars.index') }}" class="nav-link">
              <i class="nav-icon fas fa-car"></i>
              <p>Car Manage</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.customers.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Customer Manage</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.rentals.index') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Booking Manage</p>
            </a>
          </li>


          <hr>

          <li class="nav-item">
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
          </li> 













  
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>