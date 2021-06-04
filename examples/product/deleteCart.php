<?php
require_once '../../config/connection.php';
if(isset($_GET['id'])){
	$id = $_GET['id'];
	if(mysqli_query($con,"DELETE FROM carts WHERE id=$id")){
		echo "done";
	}else{
		echo "Error: ".mysqli_error($con);
	}
	mysqli_close($con);
}
?>