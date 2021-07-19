<?php 


class user{

	//properties for the user object
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;


	//method to find all users from database
	public static function find_all_users(){

	return self::find_this_query("SELECT * FROM login");

	}

	//method to pass id
	public static function find_user_by_id($user_id){
	global $database;
	$the_result_array = self::find_this_query("SELECT * FROM login WHERE login_id = $user_id LIMIT 1");
	
	return !empty($the_result_array) ? array_shift($the_result_array) : false;
	
	}

	//method to execute any query 
	public static function find_this_query($sql){
	global	$database;
	$result_set = $database->query($sql);
	$the_object_array = array();

	while ($row = mysqli_fetch_array($result_set)) {
		$the_object_array[] = self::instantation($row);
	}

	return $the_object_array;


	}

	//method to check user credentials from database
	public static function verify_user($username, $password){
		global $database;
		
		$username = $database->escape_string($username); 
		$password = $database->escape_string($password);

		$sql="SELECT * FROM login WHERE username ='{$username}' AND password='{$password}' LIMIT 1";

		$the_result_array = self::find_this_query($sql);

		return !empty($the_result_array) ? array_shift($the_result_array) : false;
	}


	//method to instantiate
	public static function instantation($the_record){


	 
	$the_object = new self;

	//automated way
	foreach ($the_record as $the_attribute => $value) {
		if ($the_object->has_the_attribute($the_attribute)) {
			
			$the_object->$the_attribute = $value;
		}
	}

	return $the_object; 

	}

	//has the attribute method
	private function has_the_attribute($the_attribute){

	$object_properties = get_object_vars($this);
	return array_key_exists($the_attribute, $object_properties);


	}


}



 ?>