<?php error_reporting(E_ALL); ?>
<?php include("includes/header.php"); ?>
<?php 
  // $session_id = $_GET['id'];
  // if (empty($session_id)) {
  //   header("login.php");
  // }
 ?>
<?php 

  $mysqli = new mysqli("localhost","root","","intern_portal");

  // Check connection
  if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }

  // Perform query
  if ($result = $mysqli -> query("SELECT status FROM interns_details WHERE status = 0")) {
    
    $requests_count=$result -> num_rows;
    // Free result set
    $result -> free_result();
  }

  if ($result = $mysqli -> query("SELECT status FROM interns_details WHERE status = 1")) {
    
    $accept_count=$result -> num_rows;
    // Free result set
    $result -> free_result();
  }

  $mysqli -> close();

 ?>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" href="logout.php">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout
        </a>
      </li>
    </ul>
  </nav>
      <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="request.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Requests
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="accept.php" class="nav-link">
              <i class="nav-icon fa fa-check"></i>
              <p>
                Accepted
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>    
  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-12">
                <h1 class="head m-0 text-center"></h1>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
    
        <!-- Main content -->
        <section class="content">
                    <div class="container mt-5">
        
                        <div class="row align-items-center pt-10">
                          <div class="col-md-3"> 
                          </div>
                          <div class="col-md-6 ">
                    <div class="small-box bg-warning">
                      <div class="inner">
                        <h3><?php echo $requests_count; ?></h3>
        
                        <p><h4>Requests</h4></p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-bag"></i>
                      </div>
                      <a href="request.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="container mt-5">
        
                    <div class="row align-items-center pt-10">
                      <div class="col-md-3"> 
                      </div>
                      <div class="col-md-6 ">
                    <div class="small-box bg-danger">
                      <div class="inner">
                        <h3><?php echo $accept_count; ?></h3>
        
                        <p><h4>Accepted</h4></p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="accept.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
    
    
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->
<?php require_once ("includes/footer.php"); ?>
