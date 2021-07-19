<?php

//Database constants connection

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'intern_portal');

class Database{

  public $connection; //automatically establishes connection on every page
  function __construct(){

    $this->open_db_connection();
  }



  //methid to check the database parameters and return result accordingly
  public function open_db_connection(){

  //$this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

  $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

  if($this->connection->connect_errno){

    die("Database Connection Failed". $this->connection->error);
  }


  }

  //method that checks the query and returns the result 
  public function query($sql){
  // $result = mysqli_query($this->connection, $sql);
  $result = $this->connection->query($sql);

  $this->confirm_query($result);
  return $result;

  }


  //method to check if the result or values are obtained from the query
  private function confirm_query($result){

    if (!$result) {
      die("Query Failed" . $this->connection->error);
    }

  }



  public function escape_string($string){

  $escaped_string = $this->connection->real_escape_string($string);
  return $escaped_string;

  }

  public function the_insert_id(){

    return mysqli_insert_id($this->connection);

  }

}

$database = new Database();

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

class intern{

  //properties of form
  public $full_name;
  public $dob;
  public $age;
  public $gender;
  public $contact;
  public $email;
  public $college;
  public $resume;

  public function create(){
    
    $full_name =$_POST['full_name'];
    $dob       =$_POST['dob'];
    $age       =$_POST['age'];
    $gender    =$_POST['gender'];
    $contact   =$_POST['contact'];
    $email     =$_POST['email'];
    $college   =$_POST['college'];
    $resume    =$_FILES['resume']['name'];
    $target    ="upload/" . $_FILES['resume']['name'];
    // $upload_file =$this->file();

    if (move_uploaded_file($_FILES['resume']['tmp_name'], $target)) {
      
    }else{
      echo "Your form was not submitted succesfully.";
    }

    $mail_body = 
        nl2br("An intern with the following job profile has applied for Internship \n
          Name: ".$full_name."\n
          Date of Birth: ".$dob."\n
          Age :".$age." yrs\n
          Gender :".$gender."\n
          Contact :".$contact."\n
          Email :".$email."\n
          College/Employment type :".$college."\n
        Please check the portal for more details.");

    global $database;
    $sql="INSERT INTO interns_details (full_name, gender, age, dob, contact, email, college_employment_type, resume)";
    $sql .="VALUES ('";
    $sql .= $database->escape_string($full_name) . "', '";
    $sql .= $database->escape_string($gender) . "', '";
    $sql .= $database->escape_string($age) . "', '";
    $sql .= $database->escape_string($dob) . "', '";
    $sql .= $database->escape_string($contact) . "', '";
    $sql .= $database->escape_string($email) . "', '";
    $sql .= $database->escape_string($college) . "', '";
    $sql .= $database->escape_string($resume) . "')";

    if ($database->query($sql)) {
      $this->id = $database->the_insert_id();
      $emailerobject = new emailer ("portal.test.mailing@gamil.com");
      $emailerobject->addRecipient("darshan.mahajan77777@gmail.com"); //admin mail
      $emailerobject->setSubject("INTERN APPLICATION");
      $emailerobject->setBody($mail_body);
      $emailerobject->sendEmail();
      header("Location:thankyou.php");

      return true;

    } else {

      return false;
    }
    

  }


}


 ?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Intern|Form</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-collapse layout-top-nav">


<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="head m-0 text-center">WELCOME TO OUR INTERNSHIP PROGRAM</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="container-fluid">
      <div class="row">
        <div class="col-md-5 mx-auto">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Please fill this form.</h3>
            </div>
            <!-- /.card-header -->
            <?php 

              if (isset($_POST['submit'])) {
                $upload = new intern;
                $upload->create();
              }
             ?>
            <!-- form start -->
            <form name="intern_form" enctype="multipart/form-data" action="" method="post">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Full Name</label>
                  <input type="name" name="full_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Full Name" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Date of Birth</label>
                  <input type="date" name="dob" class="form-control" placeholder="enter date" required>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Age</label>
                  <input type="number" name="age" class="form-control" placeholder="Enter age"required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Gender:</label>
                  <input type="radio" name="gender" value="male" />MALE
                  <input type="radio" name="gender" value="female" />FEMALE
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Contact number</label>
                  <input type="number" name="contact" class="form-control" id="exampleInputPassword1" placeholder="Enter Contact number" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">College/Employement Type with Name</label>
                  <input type="name" name="college" class="form-control" id="exampleInputEmail1" placeholder="College/Employement Type with Name " required>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Resume File</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="resume" id="exampleInputFile" required>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
          
              <div class="card-footer">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary" />
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
<!-- ./wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="docs/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="docs/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
</body>
</html>