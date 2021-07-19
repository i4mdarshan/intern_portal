<?php 
require_once("config.php");

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



}

$database = new Database();






 ?>