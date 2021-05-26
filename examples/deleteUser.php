<?php
require_once '../config/connection.php';
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$sql = "DELETE FROM user WHERE uid=$id";
		if(mysqli_query($con,$sql)){
			echo "done";
		}else{
			echo "Error: ".mysqli_error($con);
		}
	}

	mysqli_close($con);
?>