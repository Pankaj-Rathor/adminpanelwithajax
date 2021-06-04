<?php
require_once 'connection.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
	$name = $_POST['name'];
	$parent_id = $_POST['parent_id'];
	$status = $_POST['status'];

	if(mysqli_query($con,"INSERT INTO categories(name,parent_id,status) VALUES('$name',$parent_id,$status)")){
		echo 'done';
	}else{
		echo 'Error: '.mysqli_error($con);
	}
mysqli_close($con);

}
?>