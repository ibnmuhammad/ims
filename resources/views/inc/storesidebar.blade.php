<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/storekeeper" class="brand-link">
    {{-- <img src="{{ asset('images/lgri.jpg') }}" alt="LGRI Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
    <span class="brand-text font-weight-light">Inventory</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      {{-- <div class="image">
        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div> --}}
      <div class="info">
        <a href="/storekeeper" class="d-block">{{ Auth::user()->email }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="/storekeeper" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <!-- User Management sidebar buttons-->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>
              Workers Management
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('workers.create') }}" class="nav-link">
                <i class="fas fa-user-plus nav-icon"></i>
                <p>Add Worker</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('workers.index') }}" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>View Workers</p>
              </a>
            </li>
          </ul>
        </li>
        {{-- product categories --}}
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-suitcase"></i>
            <p>
              Product Categories
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('categories.create') }}" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                <p>Add Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('categories.index') }}" class="nav-link">
                <i class="fas fa-eye nav-icon"></i>
                <p>View Categories</p>
              </a>
            </li>
          </ul>
        </li>
        {{-- products --}}
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-business-time"></i>
            <p>
              Product Items
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('products.create') }}" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                <p>Add Product</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('products.index') }}" class="nav-link">
                <i class="fas fa-eye nav-icon"></i>
                <p>View Products</p>
              </a>
            </li>
          </ul>
        </li>
        {{-- products sales  --}}
        <li class="nav-item">
          <a href="{{ route('sales.index') }}" class="nav-link">
            <i class="nav-icon fas fa-coins"></i>
            <p>
              Sales
              {{-- <i class="right fas fa-angle-left"></i> --}}
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-lock"></i>
            <p>
              Change Account details
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                         <i class="nav-icon fas fa-lock"></i>
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </li>
        {{-- <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-university"></i>
            <p>
              Something
            </p>
          </a>
        </li> --}}
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>