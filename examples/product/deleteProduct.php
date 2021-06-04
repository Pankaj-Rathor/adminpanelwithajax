<?php
require_once '../../config/connection.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$id = test_input($_GET['id']);
	
	$sql = "DELETE FROM `products` WHERE id=$id";
	if(mysqli_query($con,$sql)){
		echo 'done';
	}else{
		echo 'Error: '.mysqli_error($con);
	}
	mysqli_close($con);
}


?>