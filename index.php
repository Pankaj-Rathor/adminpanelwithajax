<?php
session_start();
if(isset($_SESSION['name'])){
  header('Location:examples/admin_panel.php');
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <?php require 'component/links.php';?>

  <style type="text/css">
    body{
      background: url('assets/img/cover.jpg');
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
</head>
<body>
  <h2 class="text-center bg-danger  pb-2 text-light">Login</h2>
  <div class="container mt-2 p-4 position-relative" style="background-color: #fff; border-radius: 10px; width: 55%;">
    <div class="row">
      <div class="col-12">
        <form id="form" action="" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email" autocomplete required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input id="password" type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" autocomplete required>
          </div>
          <div class="form-group">
            <a href="forgetPassword.php" class="badge badge-danger p-2">Forget Password</a>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          <div>
            <img class="position-absolute" id="loader" src="loader.gif" width="100" height="100" style="top:65%; left: 20%; display: none;">
          </div>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    jQuery(document).ready(function(){
      jQuery(document).ajaxStart(function(){
        jQuery('#loader').css('display','block');
      });

      jQuery(document).ajaxComplete(function(){
        jQuery('#loader').css('display','none');
      });

      jQuery('#form').on('submit',function(event){
        event.preventDefault();
        let formdata = jQuery(this).serialize();
        console.log(formdata);
        jQuery.ajax({
          url : "config/login.php",
          type: 'post',
          data : formdata,
          success : function(data){
            if(data == 1){
              swal("Login Success!", "", "success").then((value) => {
                location.replace('examples/admin_panel.php');
              });
            }else{
              swal("Try Again", data, "error");
            }
          }
        });
      });
    });
  </script>
</body>
</html>