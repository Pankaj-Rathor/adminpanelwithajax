<?php
require_once 'connection.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$parent_id = $_POST['parent_id'];
	$status = $_POST['status'];

	// echo "$id $name $parent_id $status";
	if(mysqli_query($con,"UPDATE `categories` SET `name`='$name',`parent_id`=$parent_id,`status`=$status WHERE `id`=$id")){
		echo 'done';
	}else{
		echo 'Error: '.mysqli_error($con);
	}
	mysqli_close($con);

}
?>