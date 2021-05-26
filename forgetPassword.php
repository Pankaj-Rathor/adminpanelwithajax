<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Forget Password</title>
  <?php require_once 'component/links.php';?>
  <style type="text/css">
    body{
      background: url('assets/img/cover.jpg');
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
</head>
<body>
  <h2 class="text-center bg-danger  pb-2 text-light">Forget Password</h2>
  <div class="container mt-2 p-4 position-relative" style="background-color: #fff; border-radius: 10px; width: 55%;">
    <div class="row">
      <div class="col-12">
        <form id="form" action="" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email" autocomplete required 
            value="<?php echo $email=isset($_SESSION['email'])?$_SESSION['email']:''; ?>">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Enter</button>
            <i id="msg"></i>
          </div>
          <div>
            <img class="position-absolute" id="loader" src="loader.gif" width="100" height="100" style="top:61%; left: 20%; display: none;">
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
          url : "config/verify.php",
          type: 'post',
          data : formdata,
          success : function(data){
            if(data == "done"){
              jQuery('#msg').text('I will send Verification Link and OTP in Your Email \nPlease Check').css('color','red');
            }else{
              alert(data);
            }
          }
        });
      });
    });
  </script>
</body>
</html>