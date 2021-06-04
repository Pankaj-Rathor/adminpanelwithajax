<?php
session_start();
require '../../category/connection.php';
 require 'config.php';
//disable ssl
 \Stripe\Stripe::setVerifySslCerts(false);
 //get stript token
 $token = $_POST['stripeToken'];


\Stripe\Charge::create(array(
 	"amount"=>$_SESSION['Payment_amount'],
 	"currency"=>"inr",
 	"description"=>"Qty:".$_SESSION['qty'],
 	"source"=>$token,
 ));

//update cart status(buy)
$id = $_SESSION['uid'];
if(mysqli_query($con,"UPDATE carts SET buy=1 WHERE user_id=$id")){
    header('Location:../../product_list.php');
}else{
    echo "Error:".mysqli_error($con);
}
mysqli_close($con);
 // echo "<pre>";
 // print_r($data);
?>
