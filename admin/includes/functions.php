<?php 

	//this file is used to autoload the classess file if any missed inside the init.php

	function classAutoLoader($class){

		$class = strtolower($class);

		$the_path = "includes/{$class}.php";

		if (is_file($the_path) && !class_exists($class)) {
			include $the_path;
		}

	}

	//redirect to any page function
	function redirect($location){
		header("Location: {$location}");

	}




spl_autoload_register('classAutoLoader');




 ?>