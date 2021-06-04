<?php
if(isset($_POST['submit'])){
	$image = $_FILES['image'];
	// echo "<pre>";
	// print_r($image);
		//set file uploading path
	$target_path = 'productImg/'.$image['name'];
	$upload = true;

		//check image
	if($image['error']==0){
			//file extension validation
		$valid_ext = ['jpg','jpeg','gif','png'];
		$arr =  explode('.',$image['name']);
		$file_ext =strtolower(end($arr));
			// echo $file_ext;
		if(!in_array($file_ext, $valid_ext)){
			echo 'File Formate Not Supported';
			$upload = false;
			exit();
		}

		//File already exists
		if(file_exists($target_path)){
			echo "File already Exists";
			exit();
		}
	}else{
		echo "File is required";
		exit();
	}

	//File upload
	if(!move_uploaded_file($image['tmp_name'], $target_path)){
		echo "File Not Uploaded !!!";
		exit();
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>image</title>
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
		<input type="file" name="image">
		<input type="submit" name="submit" value="submit">
	</form>
</body>
</html>