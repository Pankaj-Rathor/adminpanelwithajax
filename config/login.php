<?php
session_start();
require_once 'connection.php';

function safe_data($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$email = safe_data($_POST['email']);
	$userPassword = safe_data($_POST['password']);

	$sql = "SELECT * FROM user WHERE email='$email'";

	$result = mysqli_query($con,$sql);

	if(mysqli_num_rows($result)>0){
		$user = mysqli_fetch_assoc($result);
		$_SESSION['email'] = $user['email'];
		$dbPassword = $user['password'];

		if(password_verify($userPassword, $dbPassword)){
			$_SESSION['uid'] = $user['uid'];
			$_SESSION['name'] = $user['name'];
			$_SESSION['age'] = $user['age'];
			$_SESSION['phone'] = $user['phone'];
			$_SESSION['gender'] = $user['gender'];
			$_SESSION['reg_date'] = $user['reg_date'];
			$_SESSION['user_level'] = $user['user_level'];

			echo 1;
		}else{
			echo "Password is wrong";
		}

	}else{
		echo "You'r not registered user";
	}
	mysqli_close($con);
}
?>