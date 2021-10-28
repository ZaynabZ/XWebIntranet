<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MyOpla Intranet Application</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/feather/feather.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/ti-icons/css/themify-icons.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/css/vendor.bundle.base.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/select2/select2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/mdi/css/materialdesignicons.min.css')); ?>">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/ti-icons/css/themify-icons.css')); ?>">
  <link rel="stylesheet" type="<?php echo e(asset('assets/text/css" href="js/select.dataTables.min.css')); ?>">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/vertical-layout-light/style.css')); ?>">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.ico')); ?>" />
</head>
<body>
  <?php if(auth()->guard()->check()): ?>
  <div class="container-scroller">
   
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('assets/images/logo_myopla.png')); ?>" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="logo"/></a>
      </div>

      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        
        <ul class="navbar-nav navbar-nav-right">


          <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="icon-bell mx-0"></i>
                <span><?php echo e(@Auth::user()->unreadNotifications->count()); ?></span>
              </a> 
              
              <?php if (! (@Auth::user()->unreadNotifications->isEmpty())): ?>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                 
                    <?php $__currentLoopData = @Auth::user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $un): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($un->type == 'App\Notifications\StatusDemandesNotification'): ?>
                          <a class="dropdown-item preview-item" href="<?php echo e(route('demandes', $un)); ?>">  
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-success">
                                <i class="ti-info-alt mx-0"></i>
                              </div>
                            </div>
                            <div class="preview-item-content">
                              
                              <p class="preview-subject font-weight-normal"><?php echo e($un->data['demande']); ?></p>
                              <p class="preview-subject font-weight-normal">Statut: Réalisé</p>
                              <p class="font-weight-light small-text mb-0 text-muted"><?php echo e($un->data['notification_time']); ?>

                                    
                              </p>
                            </div>
                          </a>
                        <?php elseif($un->type == 'App\Notifications\DemandesNotification'): ?>
                          <a class="dropdown-item preview-item" href="<?php echo e(route('superadmin_demandes', $un)); ?>">  
                              <div class="preview-thumbnail">
                                <div class="preview-icon bg-success">
                                  <i class="ti-info-alt mx-0"></i>
                                </div>
                              </div>
                              <div class="preview-item-content">
                                <p class="preview-subject font-weight-normal"><?php echo e($un->data['type_demande']); ?></p>
                                <p class="preview-subject font-weight-normal">Effectuée par: <?php echo e($un->data['last_name']); ?> <?php echo e($un->data['first_name']); ?></p>
                                <p class="font-weight-light small-text mb-0 text-muted"><?php echo e($un->data['notification_time']); ?></p>
                              </div>
                            </a>  
                        <?php endif; ?>
                      
                        
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </div> 
              
              <?php endif; ?>
          </li>

          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <?php if(Auth::user()->gender == 'F'): ?>
                <img src="<?php echo e(asset('assets/images/faces/female_profile.jpg')); ?>" alt="profile"/>
              <?php else: ?>
                <img src="<?php echo e(asset('assets/images/faces/male_profile.png')); ?>" alt="profile"/>  
              <?php endif; ?>
              
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="<?php echo e(route('profile')); ?>">
                <i class="ti-settings text-primary"></i>
                <?php echo e(@Auth::user()->username); ?>

              </a>
              <a class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                <form  method="POST" action="<?php echo e(route('logout')); ?>">
                  <?php echo csrf_field(); ?>
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
            <a class="nav-link" href="<?php echo e(route('profile')); ?>">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Profile</span>
            </a>
          </li>
          <?php if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin()): ?>
           
          
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Services</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo e(route('services')); ?>">Liste</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo e(route('add_service')); ?>">Ajouter Service</a></li>
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
                <li class="nav-item"> <a class="nav-link" href="<?php echo e(route('users')); ?>">Liste</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo e(route('create_user')); ?>">Ajouter Utilisateur</a></li>
              </ul>
            </div>
          </li>
          <?php endif; ?>

             
              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#conges" aria-expanded="false" aria-controls="conges">
              <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Congés</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="conges">
                <ul class="nav flex-column sub-menu">
                <?php if(! Auth::user()->isSuperAdmin()): ?>    
                  <li class="nav-item"> <a class="nav-link" href="#">Effecter Demande</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Mes demandes</a></li>
                  <?php else: ?>
                    <li class="nav-item"> <a class="nav-link" href="#">Demandes</a></li>
                  <?php endif; ?>
                </ul>
              </div>
            </li>

            <li class="nav-item">
            <?php if(! Auth::user()->isSuperAdmin()): ?>
              <a class="nav-link" href="<?php echo e(route('demandes')); ?>">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Demandes</span>
              </a>
              <?php else: ?>
              <a class="nav-link" href="<?php echo e(route('superadmin_demandes')); ?>">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Demandes</span>
              </a>
              <?php endif; ?>
            </li>
          
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Documents</span>
            </a>
          </li>
          


          <?php if(Auth::user()->isAdmin()): ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo e(route('CV_upload')); ?>">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Candidats</span>
              </a>
            </li>
          <?php endif; ?>

        </ul>
      </nav>
      <!-- partial -->
      <?php endif; ?>
      <div class="main-panel">
        <div class="content-wrapper">
          
          <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php if(auth()->guard()->check()): ?>
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Application Intranet MyOpla.</span>
            
          </div>
          <div class="d-sm-flex justify-content-center justify-content-sm-between mt-3">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"><img src="<?php echo e(asset('assets/images/favicon.ico')); ?>" /></span> 
          </div>
        </footer> 
        <?php endif; ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="<?php echo e(asset('assets/vendors/js/vendor.bundle.base.js')); ?>"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="<?php echo e(asset('assets/vendors/chart.js/Chart.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/vendors/datatables.net/jquery.dataTables.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/dataTables.select.min.js')); ?>"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?php echo e(asset('assets/js/off-canvas.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/hoverable-collapse.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/template.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/settings.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/todolist.js')); ?>"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?php echo e(asset('assets/js/dashboard.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/Chart.roundedBarCharts.js')); ?>"></script>

  <?php echo $__env->yieldContent("javascript"); ?>
  <!-- End custom js for this page-->
 
</body>

</html>

<?php /**PATH C:\Users\AGENT\Documents\MyOpla\resources\views/layouts/app.blade.php ENDPATH**/ ?>