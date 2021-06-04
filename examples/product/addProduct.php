<?php
session_start();
require_once '../../config/connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name = test_input($_POST['name']);
	$color = test_input($_POST['color']);
	$price = test_input($_POST['price']);
	$category_id = test_input($_POST['categories']);
	$skus = test_input($_POST['skus']);
	$description = test_input($_POST['description']);
	$admin_id = $_SESSION['uid'];
	$status = test_input($_POST['status']);

	$image = $_FILES['image'];
	//set file uploading path
	$target_path = 'productImg/'.$image['name'];

		//check image
	if($image['error']==0){
			//file extension validation
		$valid_ext = ['jpg','jpeg','gif','png'];
		$arr =  explode('.',$image['name']);
		$file_ext =strtolower(end($arr));
			// echo $file_ext;
		if(!in_array($file_ext, $valid_ext)){
			echo 'File Formate Not Supported';
			return;
		}

		// //File already exists
		// if(file_exists($target_path)){
		// 	echo "File already Exists";
		// 	return;
		// }
		//File upload
		if(!move_uploaded_file($image['tmp_name'], $target_path)){
			echo "Image Not Uploaded !!!";
			return;
		}
	}else{
		echo "Product Image is required";
		return;
	}

	$name = mysqli_real_escape_string($con,$name);
	$color = mysqli_real_escape_string($con,$color);
	$price = mysqli_real_escape_string($con,$price);
	$category_id = mysqli_real_escape_string($con,$category_id);
	$skus = mysqli_real_escape_string($con,$skus);
	$description = mysqli_real_escape_string($con,$description);
	$admin_id = mysqli_real_escape_string($con,$admin_id);
	$status = mysqli_real_escape_string($con,$status);

	//prepare and bind
	$stmt = $con->prepare("INSERT INTO products (name, color, price, image, category_id, skus,description, admin_id, status) VALUES(?,?,?,?,?,?,?,?,?)");
	$stmt->bind_param("ssdsissii",$name,$color,$price,$image['name'],$category_id,$skus,$description,$admin_id,$status);
	
//error: Column count doesn't match value count at row 1 
	// $sql = "INSERT INTO products (name, color, price, image, category_id, skus,description, admin_id, status) VALUES('$name','$color',$price,'$imageName',$category_id,'$skus','$description',$admin_id,$status)";

	// mysqli_query($con,$sql)
	if($stmt->execute()){
		echo 'done';
	}else{
		echo 'Error: '.mysqli_error($con);
	}
	$stmt->close();
	$con->close();
}

?>