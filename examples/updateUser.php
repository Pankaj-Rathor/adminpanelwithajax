<?php
require_once '../config/connection.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
	$uid = test_input($_POST['id']);
	$name = test_input($_POST['name']);
	$email = test_input($_POST['email']);
	$age = test_input($_POST['age']);
	$phone = test_input($_POST['phone']);
	$gender = test_input($_POST['gender']);

	$sql = "UPDATE user SET name='$name', email='$email', age='$age', phone='$phone', gender='$gender' WHERE uid='$uid'";

	if(mysqli_query($con,$sql)){
		echo "done";
	}else{
		echo "error : ".mysqli_error($con);
	}
}
mysqli_close($con);
?>