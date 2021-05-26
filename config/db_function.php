<?php
require 'connection.php';

function checkConnection($con){
	if(!$con){
		die("Connection error: ".mysqli_connect_error());
		exit();
	}
	return;
}


function getUsersCount(){
	$con = $GLOBALS['con'];
	checkConnection($con);

	$sql = "SELECT count(uid) FROM user";
	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result)>0){
		$user = mysqli_fetch_assoc($result);
		return $user['count(uid)'];
	}
}

?>