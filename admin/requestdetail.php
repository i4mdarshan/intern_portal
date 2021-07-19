<?php include("includes/header.php"); ?>
<?php 

  $id=$_GET['id'];
  $mysqli = new mysqli("localhost","root","","intern_portal");

  // Check connection
  if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }

  // Perform query
  $sql="SELECT * FROM interns_details WHERE status = 0 AND id=$id";
  if ($result = $mysqli -> query($sql)) {
    while ($row = $result -> fetch_assoc()) {
      $fullname=$row['full_name'];
      $gender  =$row['gender'];
      $email   =$row['email'];
      $age     =$row['age'];
      $dob     =date_create($row['dob']);
      $college =$row['college_employment_type'];
      $contact =$row['contact'];
      $resume  =$row['resume'];
    }
    $result -> free_result();
  }

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
            <a href="request.php" class="nav-link active">
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
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-2">
                <a href="request.php" style="border: none; color: white;">
                  <button class="btn btn-info">
                    <i class="fas fa-arrow-left"></i>
                    <a href="request.php">
                  </button>
                </a>
              </div>
              <div class="col-sm-8">
                <h1 class="head m-0 text-center">Details</h1>
              </div>
              
            </div>
          </div><!-- /.container-fluid -->
        </div>

        <section class="content">
          <div class="container">
            <div class="row">
              <div class="col-md-2"></div>
                <div class="col-md-8">
                  
            <div class="card" style="height: 500px;">
               <div class="card-body" style="height: 500px;">
                  <div class="container" style="width: 90%; margin: 0 auto;">
                    <table style="border: 0px; border-spacing: 0 1em; border-collapse: separate;">
                      <tbody>
                        <tr st>
                          <td><h4>Name</h4></td>
                          <td><h4 style="text-transform: capitalize;"><b>:&nbsp;<?php echo $fullname; ?></b></h4></td>
                        </tr>
                        <tr>
                          <td><h4>Gender </h4></td>
                          <td><h4 style="text-transform: capitalize;"><b>:&nbsp;<?php echo $gender; ?></b></h4></td>
                        </tr>
                        <tr>
                          <td><h4>Age </h4></td>
                          <td><h4><b>:&nbsp;<?php echo $age; ?> yrs</b></h4></td>
                        </tr>
                        <tr>
                          <td><h4>Date of Birth </h4></td>
                          <td><h4><b>:&nbsp;<?php echo date_format($dob,'d-m-Y'); ?></b></h4></td>
                        </tr>
                        <tr>
                          <td><h4>Mobile </h4></td>
                          <td><h4><b>:&nbsp;<?php echo $contact; ?></b></h4></td>
                        </tr>
                        <tr>
                          <td><h4>Email </h4></td>
                          <td><h4><b>:&nbsp;<?php echo $email; ?></b></h4></td>
                        </tr>
                        <tr>
                          <td><h4>College/Employement<br>Type with Name</h4></td>
                          <td><h4 style="text-transform: capitalize;"><b>:&nbsp;<?php echo $college; ?></b></h4></td>
                        </tr>
                        <tr>
                          <td><h4>Resume</h4></td>
                          <td><a href="../upload/<?php echo $resume; ?>" target="_blank"><h4><b>:&nbsp;<?php echo $resume; ?></b></h4></a></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>

            <div class="col-md-2"></div>
            
<?php include("includes/footer.php"); ?>

