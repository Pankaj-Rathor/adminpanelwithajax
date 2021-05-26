<?php
session_start();
require_once 'connection.php';
if(isset($_GET['id'])){
  $sql = "SELECT * FROM uniqid WHERE random_str='".$_GET['id']."'";
  $result = mysqli_query($con,$sql);
  if(mysqli_num_rows($result)>0){
    while ($d = mysqli_fetch_assoc($result)) {
      $_SESSION['email'] = $d['email'];
      $_SESSION['dbotp'] = $d['otp'];
      $dbDate = date_create($d['link_time']);
      date_add($dbDate, date_interval_create_from_date_string('1 day'));
      $expireTime = date_format($dbDate, 'Y-m-d H:i:s');
      $currentTime = date('Y-m-d H:i:s');
      if($expireTime>=$currentTime){
        // echo "valid";
      }else{
        // echo "invalid";
        exit();
      }
    }

  }else {
      header('Location:../index.php');
      exit();
      }
 }

 if(isset($_POST['otp'])){
    if($_SESSION['dbotp'] == $_POST['otp']){
      $_SESSION['verifyotp'] = "true";
      header('Location:setPassword.php');
      exit();
    }else{
      $invalid = "You Enter Wrong OTP";
    }
 }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Verify OTP</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <style type="text/css">
    body{
      background: url('../assets/img/cover.jpg');
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
</head>
<body>
  <h2 class="text-center bg-danger  pb-2 text-light">Verify OTP</h2>
  <div class="container mt-2 p-4 position-relative" style="background-color: #fff; border-radius: 10px; width: 55%;">
    <div class="row">
      <div class="col-12">
        <form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Enter OTP</label>
            <input type="text" class="form-control" id="exampleInputotp1" aria-describedby="otpHelp" name="otp" placeholder="Enter OTP" autocomplete required><i style="color: red;"><?php if(isset($invalid)){echo $invalid;}?></i>
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