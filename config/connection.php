<?php
	$serverName = "localhost";
	$userName = "root";
	$password = "";
	$db = "evince";

	$con = mysqli_connect($serverName,$userName,$password,$db);

	if (!$con) {
		die("Connection Error: ".mysqli_connect_error());
	}

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		if(empty($data)){
			die('Required');
		}
		return $data;
	}
?>