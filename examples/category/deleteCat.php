<?php
require_once 'connection.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$id = $_POST['id'];

	if(mysqli_query($con,"DELETE FROM categories WHERE id=$id or parent_id=$id")){
		echo "done";
	}else{
		echo "Error: ".mysqli_error($con);
	}
	mysql_close($con);
}
?>