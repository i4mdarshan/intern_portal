<?php include ("includes/header.php"); ?>

<?php 

  $mysqli = new mysqli("localhost","root","","intern_portal");

  // Check connection
  if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
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
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">List of requests</h3>

              <div class="card-tools">
                
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 500px; width: 100%;">
              <table class="table table-head-fixed text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                    
                  </tr>
                </thead>
                <tbody>

                  <?php 

                  // Perform query
                  $n=1;

                  $sql="SELECT full_name,email,id FROM interns_details WHERE status = 0";
                  if ($result = $mysqli -> query($sql)) {
                    while ($row = $result -> fetch_assoc()) {

                      echo "<tr>
                              <td>" .$n."</td>
                              <td><a style='text-transform: capitalize;' href='requestdetail.php?id=".$row['id']."'>".$row['full_name']."</a></td>
                              <td>" .$row['email']."</td>
                              <td><button type='button' class='btn btn-success'><a href='accept_request.php?id=".$row['id']."' class='text-white'>Accept</a></button>
                                  <button type='button' class='btn btn-danger'><a href='reject_request.php?id=".$row['id']."' class='text-white'>Reject</a></button>
                              </td> 
                            </tr>";
                      $n++;
                    }
                    $result -> free_result();
                  }

                   ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-2"></div>
      </div>
      <!-- /.row -->
<?php include ("includes/footer.php"); ?>