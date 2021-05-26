<?php
session_start();

require_once 'connection.php';
require_once 'sendotp.php';

if(isset($_POST['email'])){
	$email = mysqli_real_escape_string($con,$_POST['email']);

	$sql = "SELECT * FROM user WHERE email='$email'";
	$result = mysqli_query($con,$sql);

	if(mysqli_num_rows($result)>0){
		$user = mysqli_fetch_assoc($result);
		$_SESSION['email'] = $email;
		$userName = $user['name'];
		$arr = sendotp($email,$userName);  // return array
		if(is_array($arr)){
			$sql1 = "INSERT INTO uniqid(email,random_str,otp) VALUES('$email','$arr[0]',$arr[1])";
			if(mysqli_query($con,$sql1)){
				echo "done";
			}else{
				echo "Error: ".mysqli_error($con);
			}
		}
		
	}else{
		echo "You'r not registered user";
	}
}

mysqli_close($con);

?>