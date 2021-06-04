<?php
require_once '../config/connection.php';


if($_SERVER['REQUEST_METHOD'] == "POST"){
	$name = test_input($_POST['name']);
	$email = test_input($_POST['email']);
	$age = test_input($_POST['age']);
	$phone = test_input($_POST['phone']);
	$gender = test_input($_POST['gender']);	
	$password = test_input($_POST['password']);
	
	// echo var_dump($password);


	// if(empty($name) && empty($email) && empty($age) && empty($phone) && empty($gender) && empty($password)){
	// 	echo "require";
	// 	exit();
	// }

	$name = mysqli_real_escape_string($con, $name);
	$email = mysqli_real_escape_string($con, $email);
	$age = mysqli_real_escape_string($con, $age);
	$phone = mysqli_real_escape_string($con, $phone);
	$gender = mysqli_real_escape_string($con, $gender);
	$password = mysqli_real_escape_string($con, $password);

	//password Encryption
	$password = password_hash($password, PASSWORD_BCRYPT);
	$sql = "INSERT INTO user (`name`, `email`, `password`, `age`, `phone`, `gender`) VALUES ('$name','$email','$password','$age','$phone','$gender')";

	if(mysqli_query($con,$sql)){
		echo "done";
	}else{
		echo "error: ".mysqli_error($con);
	}
}
mysqli_close($con);

?>