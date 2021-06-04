<?php
require_once '../../config/connection.php';
	if($_SERVER['REQUEST_METHOD']=='GET'){
		$id = $_GET['id'];
		$status = $_GET['status'];

		if(mysqli_query($con,"UPDATE products SET status=$status WHERE id=$id")){
			echo 'done';
		}else{
			echo 'Error: '.mysqli_error($con);
		}
		mysqli_close($con);
	}

?>