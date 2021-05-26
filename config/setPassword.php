<?php
session_start();
if(!isset($_SESSION['verifyotp']) && $_SESSION['verifyotp']="true"){
	header('Location:../index.php');
}
$error = "";
if(isset($_POST['newPassword'])){
	require_once 'connection.php';
	$email = $_SESSION['email'];
	$newPass = password_hash($_POST['newPassword'], PASSWORD_BCRYPT) ;
	$sql = "UPDATE user SET password='$newPass' WHERE email='$email'";

	if(mysqli_query($con,$sql)){
    $_SESSION['verifyotp']="";
		header('Location:../index.php');
	}else{
		$error = "Password Not Set";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Set Password</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <style type="text/css">
    body{
      background: url('assets/img/cover.jpg');
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
</head>
<body>
  <h2 class="text-center bg-danger  pb-2 text-light">Set Password</h2>
  <div class="container mt-2 p-4 position-relative" style="background-color: #fff; border-radius: 10px; width: 55%;">
    <div class="row">
      <div class="col-12">
        <form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Enter New Password</label>
            <input type="password" class="form-control" id="exampleInputNewPass" aria-describedby="newPassHelp" name="newPassword" placeholder="Enter New Password" required>
            <i style="color: red;"><?php echo $error;?></i>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Enter</button>
          </div>
          <div>
            <img class="position-absolute" id="loader" src="loader.gif" width="100" height="100" style="top:65%; left: 20%; display: none;">
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>