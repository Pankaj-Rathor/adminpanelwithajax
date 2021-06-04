<?php
require_once '../../config/connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$id = test_input($_POST['id']);
	$name = test_input($_POST['name']);
	$color = test_input($_POST['color']);
	$price = test_input($_POST['price']);
	$category_id = test_input($_POST['categories']);
	$skus = test_input($_POST['skus']);
	$description = test_input($_POST['description']);
	$status = test_input($_POST['status']);

	$image = $_FILES['image'];
	$imageName = $image['name'];
	$oldImage = $_POST['oldImage'];
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
		$imageName = $oldImage;
	}

	$sql = "UPDATE `products` SET `name`='$name',`color`='$color',`price`=$price,`image`='$imageName',`category_id`=$category_id,`skus`='$skus',`description`='$description', `status`=$status WHERE id=$id";
	if(mysqli_query($con,$sql)){
		echo 'done';
	}else{
		echo 'Error: '.mysqli_error($con);
	}
	mysqli_close($con);
}


?>