<?php 

class Session{

	private $signed_in = false;
	public $user_id;
	public $message;


	function __construct(){
	session_start();
	$this->check_the_login();
	$this->check_message();

	}


	//(GETTER)method to check if the user is signed_in which can be called and checked on any page
	public function is_signed_in(){

		return $this->signed_in;
	}

	//method to assign session_id and user_id to signed in user after checking from database
	public function login($user){

		if ($user) {
			$this->user_id   = $_SESSION['user_id'] = $user->id;
			$this->signed_in = true;
		}

	}

	//method to logout
	public function logout(){

		unset($_SESSION['user_id']);
		unset($this->user_id);
		$this->signed_in = false;
	}

	//method to check login and assign values to properties
	private function check_the_login(){

		if(isset($_SESSION['user_id'])){

			$this->user_id   = $_SESSION['user_id'];
			$this->signed_in = true;
		}else{

			unset($this->user_id);
			$this->signed_in = false;
		}


	}

	public function message($msg=""){

		if (!empty($msg)) {
			$_SESSION['message'] = $msg;
		}else{
			return $this->message;
		}
	}

	private function check_message(){

		if (isset($_SESSION['message'])) {
			
			$this->message = $_SESSION['message'];
			unset($_SESSION['message']);
		}else{

			$this->message = "";
		}
	}

}

$session = new Session();



 ?>