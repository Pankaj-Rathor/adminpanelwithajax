<?php
require_once '../../config/connection.php';
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$qty = $_GET['qty'];

	$cart = mysqli_query($con,"SELECT price FROM carts WHERE id=$id");
	if (mysqli_num_rows($cart)>0) {
		$c = mysqli_fetch_assoc($cart);
		$price = $c['price'];
 
		//total price
		$total_price = $qty*$price;
		$sql = "UPDATE carts SET qty=$qty, total_price=$total_price WHERE id=$id";
		if(mysqli_query($con,$sql)){
			echo $total_price;
		}
	}else{
		echo "Error: ".mysqli_error($con);
	}
	mysqli_close($con);
}
?>