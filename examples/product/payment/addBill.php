<?php
session_start();
require_once '../../category/connection.php';
if($_SERVER['REQUEST_METHOD']='POST'){
	$user_id = $_SESSION['uid'];
	$name = $_POST['fname']." ".$_POST['lname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$country = $_POST['country'];
	$state = $_POST['state'];
	$city = $_POST['city'];
	$zip = $_POST['zip'];
	$paymethod = $_POST['pay'];

	$sql = "INSERT INTO bills (user_id,name,email,phone,address,country,state,city,zip,payment_method) VALUES($user_id,'$name','$email','$phone','$address','$country','$state','$city',$zip,$paymethod)";
	if(mysqli_query($con,$sql)){
		echo "true";
	}else{
		echo "Error: ".mysqli_error($con);
	}
	mysql_close($con);
	// echo "<pre>";
	// print_r($_SESSION);
}
?>