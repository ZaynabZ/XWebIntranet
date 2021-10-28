<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MyOpla Intranet Application</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" type="{{ asset('assets/text/css" href="js/select.dataTables.min.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
</head>
<body>
  @auth
  <div class="container-scroller">
   
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ route('home') }}"><img src="{{ asset('assets/images/logo_myopla.png') }}" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"/></a>
      </div>

      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        
        <ul class="navbar-nav navbar-nav-right">


          <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="icon-bell mx-0"></i>
                <span>{{ @Auth::user()->unreadNotifications->count() }}</span>
              </a> 
              
              @unless(@Auth::user()->unreadNotifications->isEmpty())
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                 
                    @foreach(@Auth::user()->unreadNotifications as $un)
                        @if($un->type == 'App\Notifications\StatusDemandesNotification')
                          <a class="dropdown-item preview-item" href="{{ route('demandes', $un) }}">  
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-success">
                                <i class="ti-info-alt mx-0"></i>
                              </div>
                            </div>
                            <div class="preview-item-content">
                              
                              <p class="preview-subject font-weight-normal">{{ $un->data['demande'] }}</p>
                              <p class="preview-subject font-weight-normal">Statut: Réalisé</p>
                              <p class="font-weight-light small-text mb-0 text-muted">{{ $un->data['notification_time'] }}
                                    
                              </p>
                            </div>
                          </a>
                        @elseif($un->type == 'App\Notifications\DemandesNotification')
                          <a class="dropdown-item preview-item" href="{{ route('superadmin_demandes', $un) }}">  
                              <div class="preview-thumbnail">
                                <div class="preview-icon bg-success">
                                  <i class="ti-info-alt mx-0"></i>
                                </div>
                              </div>
                              <div class="preview-item-content">
                                <p class="preview-subject font-weight-normal">{{ $un->data['type_demande'] }}</p>
                                <p class="preview-subject font-weight-normal">Effectuée par: {{ $un->data['last_name'] }} {{ $un->data['first_name'] }}</p>
                                <p class="font-weight-light small-text mb-0 text-muted">{{ $un->data['notification_time'] }}</p>
                              </div>
                            </a>  
                        @endif
                      
                        
                @endforeach

              </div> 
              
              @endunless
          </li>

          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              @if(Auth::user()->gender == 'F')
                <img src="{{ asset('assets/images/faces/female_profile.jpg') }}" alt="profile"/>
              @else
                <img src="{{ asset('assets/images/faces/male_profile.png') }}" alt="profile"/>  
              @endif
              
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="{{ route('profile')}}">
                <i class="ti-settings text-primary"></i>
                {{ @Auth::user()->username }}
              </a>
              <a class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                <form  method="POST" action="{{ route('logout')}}">
                  @csrf
                  <button class="btn btn-sm btn-primary" type="submit">Logout</button>
                </form>
                
              </a>
            </div>
          </li>
          
        </ul>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>


    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      
      
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('profile') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Profile</span>
            </a>
          </li>
          @if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
           
          
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Services</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('services') }}">Liste</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('add_service') }}">Ajouter Service</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
            <i class="icon-head menu-icon"></i>
              <span class="menu-title">Utilisateurs</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="users">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('users') }}">Liste</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('create_user') }}">Ajouter Utilisateur</a></li>
              </ul>
            </div>
          </li>
          @endif

             
              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#conges" aria-expanded="false" aria-controls="conges">
              <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Congés</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="conges">
                <ul class="nav flex-column sub-menu">
                @if(! Auth::user()->isSuperAdmin())    
                  <li class="nav-item"> <a class="nav-link" href="#">Effecter Demande</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Mes demandes</a></li>
                  @else
                    <li class="nav-item"> <a class="nav-link" href="#">Demandes</a></li>
                  @endif
                </ul>
              </div>
            </li>

            <li class="nav-item">
            @if(! Auth::user()->isSuperAdmin())
              <a class="nav-link" href="{{ route('demandes') }}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Demandes</span>
              </a>
              @else
              <a class="nav-link" href="{{ route('superadmin_demandes') }}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Demandes</span>
              </a>
              @endif
            </li>
          
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Documents</span>
            </a>
          </li>
          


          @if(Auth::user()->isAdmin())
            <li class="nav-item">
              <a class="nav-link" href="{{ route('CV_upload') }}">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Candidats</span>
              </a>
            </li>
          @endif

        </ul>
      </nav>
      <!-- partial -->
      @endauth
      <div class="main-panel">
        <div class="content-wrapper">
          
          @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @auth
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Application Intranet MyOpla.</span>
            
          </div>
          <div class="d-sm-flex justify-content-center justify-content-sm-between mt-3">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"><img src="{{ asset('assets/images/favicon.ico') }}" /></span> 
          </div>
        </footer> 
        @endauth
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/js/template.js') }}"></script>
  <script src="{{ asset('assets/js/settings.js') }}"></script>
  <script src="{{ asset('assets/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/Chart.roundedBarCharts.js') }}"></script>

  @yield("javascript")
  <!-- End custom js for this page-->
 
</body>

</html>

