<?php include ("includes/header.php"); ?>
<?php 
  $id=$_GET['id'];
  $mysqli = new mysqli("localhost","root","","intern_portal");

  // Check connection
  if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }

  //emailer
  class emailer{

  private $sender;
  private $recipients;
  private $subject;
  private $body;


  function __construct($sender){

    $this->sender = $sender;
    $this->recipients = array();

  }

  public function addRecipient($recipient){

    array_push($this->recipients, $recipient);
  }

  public function setSubject($subject){

    $this->subject = $subject;

  }

  public function setBody($body){

    $this->body = $body;

  }

  public function sendEmail(){

    foreach ($this->recipients as $recipient) {
      
      $result = mail($recipient, $this->subject, $this->body, "From: portal.test.mailing@gamil.com");
      if ($result) {
        "Sent!";
      }
    }

  }

}

  // Perform query
  $sql="SELECT * FROM interns_details WHERE status = 1 AND id=$id";
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

  if (isset($_POST['submit'])) {
    $id   = $_GET['id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $mail_body = 
        nl2br("Congratulations! \nYou have been selected for an Interview Round in our Company.\nThe Interview details are given below, Please check for the same.\n 
          Date: ".$date."\nTime: ".$time."hrs.");
    $sql="UPDATE interns_details SET a_date='$date',a_time='$time' WHERE id=$id;";
    if ($result = $mysqli -> query($sql)) {
      $emailerobject = new emailer ("portal.test.mailing@gamil.com");
      $emailerobject->addRecipient($email);
      $emailerobject->setSubject("INTERN APPLICATION");
      $emailerobject->setBody($mail_body);
      $emailerobject->sendEmail();
      header("Location:accept.php");
    }else{
      echo "Failed to update in Database.";
    }

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
            <a href="request.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Requests
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="accept.php" class="nav-link active">
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
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-2">
                <a href="accept.php" style="border:none; color: white;">
                <button class="btn btn-info"><i class="fas fa-arrow-left"></i></button>
                </a>
              </div>
              <div class="col-sm-8">
                <h1 class="head m-0 text-center">Details</h1>
              </div>
              
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <section class="content">
          <div class="container">
            <div class="row">
              <div class="col-md-2"></div>
                <div class="col-md-8">
                  
            <div class="card" style="height: 720px;">
               <div class="card-body">
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
                        <form name="time-set" action="set_appointment.php?id=<?php echo $id; ?>" method="post">
                            <tr>
                              <td><h4>Set Date</h4></td>
                              <td>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                  <input type="date" name="date" class="form-control">
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td><h4>Set Time</h4></td>
                              <td>
                                <div class="input-group date" id="timepicker" data-target-input="nearest">
                                  <input type="time" name="time" class="form-control">
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <input type="submit" name="submit" class="btn btn-primary" value="Send">
                              </td>
                            </tr>
                          </form>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>

          <div class="col-md-2"></div>
<?php include ("includes/footer.php"); ?>

