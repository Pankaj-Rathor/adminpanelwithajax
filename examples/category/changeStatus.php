<?php
require_once 'connection.php';
if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$id = $_GET['id'];
	$status = $_GET['status'];
		// echo $status;

	if(mysqli_query($con,"UPDATE categories SET status=$status WHERE id=$id")){
		echo "done";
	}else{
		echo "Error: ".mysqli_error($con);
	}
	mysqli_close($con);
}
?>