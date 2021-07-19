<?php 

  $id=$_GET['id'];
  $mysqli = new mysqli("localhost","root","","intern_portal");

  // Check connection
  if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }

  $sql="DELETE FROM interns_details WHERE id=$id";
  if ($result = $mysqli -> query($sql)) {
  	header("Location:request.php");
  }else{
  	echo "Failed to update in Database.";
  }

 ?>