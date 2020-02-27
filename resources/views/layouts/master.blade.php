<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard - Worksheet Management Tool</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-comments-o"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="#" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="#" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="#" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell-o"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fa fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ url('public/img/logo.png') }}" alt="Uwezo Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">TAXI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('public/img/user.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> {{Auth::user()->name}} </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">          
          <li class="nav-item has-treeview menu-open">
            <router-link to="/dashboard" class="nav-link">
              <i class="nav-icon fa fa-crosshairs"></i>
              <p>
                Dashboard
              </p>
            </router-link>            
          </li>
          @can('isClient')
          <li class="nav-item has-treeview">
            <router-link to="/trips" class="nav-link">
              <i class="nav-icon fa fa-car"></i>
              <p>
                Trips
              </p>
            </router-link>           
          </li> 
          <li class="nav-item has-treeview">
            <router-link to="/invoices" class="nav-link">
              <i class="nav-icon fa fa-sticky-note"></i>
              <p>
                Invoices
              </p>
            </router-link>           
          </li> 
          @endcan
          @can('isDriver')
          <li class="nav-item has-treeview">
            <router-link to="/trips" class="nav-link">
              <i class="nav-icon fa fa-car"></i>
              <p>
                My Trips
              </p>
            </router-link>           
          </li>    
          <li class="nav-item has-treeview">
            <router-link to="/schedules" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Work Sheets
              </p>
            </router-link>  
          </li>
          @endcan
          @can('isAdminOrAccounts')
          <li class="nav-item has-treeview">
            <router-link to="/vehicles" class="nav-link">
              <i class="nav-icon fa fa-car"></i>
              <p>
                Vehicles
              </p>
            </router-link>           
          </li>    
          <li class="nav-item has-treeview">
            <router-link to="/drivers" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Drivers
              </p>
            </router-link>  
          </li>
          @endcan
          {{-- @can('isAdmin')
          <li class="nav-item">
            <router-link to="/users" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Users
              </p>
            </router-link>
          </li>
          @endcan --}}
          @can('isAdminOrAccounts')
          <li class="nav-item">
            <router-link to="/organizations" class="nav-link">
              <i class="nav-icon fa fa-globe"></i>
              <p>
                Clients
              </p>
            </router-link>
          </li>
          @endcan
          {{-- @can('isAdminOrAccounts') --}}
          <li class="nav-item">
            <router-link to="/bookings" class="nav-link">
              <i class="nav-icon fa  fa-briefcase"></i>
              <p>
                Bookings
              </p>
            </router-link>
          </li>
          {{-- @endcan --}}
          @can('isAdminOrAccounts')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cog"></i>
              <p>
                Settings
                <i class="fa fa-angle-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">              
              <li class="nav-item">
                <router-link to="/settings/structures" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Structures</p>
                </router-link>
              </li>
              @can('isAdmin')
              <li class="nav-item">
                <router-link to="/users" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Users</p>
                </router-link>
              </li>
              @endcan
            </ul>
          </li>
          @endcan
          @can('isAdmin')
          <li class="nav-item">
            <router-link to="/reports" class="nav-link">
              <i class="nav-icon fa fa-industry"></i>
              <p>
                Reports
                {{-- <i class="fa fa-angle-left right"></i> --}}
              </p>
            </router-link>
            {{-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/reports/vehicles" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Vehicles</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/reports/drivers" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Drivers</p>
                </router-link>
              </li>  
              <li class="nav-item">
                  <router-link to="/reports/clients" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>Clients</p>
                  </router-link>
              </li>             
            </ul> --}}
          </li>
          @endcan
          <li class="nav-item has-treeview">            
            <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                <i class="nav-icon fa fa-power-off"></i>
               <p>{{ __('Logout') }}</p>
           </a>

           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
               @csrf
           </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">  

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid mt-3">        
        <!-- components matched by the route will render here -->
        <router-view></router-view>
        <vue-progress-bar></vue-progress-bar>

        <!-- end component rendering -->
        <!-- Small boxes (Stat box) -->      
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="https://bluchip.co.ke">https://bluchip.co.ke</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0-alpha
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@auth
<script>
  window.user = @json(auth()->user());
</script>    
@endauth

<script src="{{asset('/js/app.js')}}"></script>
</body>
</html>
