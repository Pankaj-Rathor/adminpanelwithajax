<?php
session_start();
require_once '../../config/connection.php';

if(isset($_GET['id'])){
	$id = $_GET['id']; //product id
	$qty = $_GET['qty'];
	$userId = $_SESSION['uid'];

	$product = mysqli_query($con,"SELECT id,name,price,qty,image FROM products WHERE id=$id");
	if(mysqli_num_rows($product)>0){
		while($p = mysqli_fetch_assoc($product)){
			if($qty > $p['qty']){
				echo "Only ".$p['qty']." Left";
				header('Location:product_view.php?id='.$id);
				exit();
			}
			$productId = $p['id'];
			$product_name = $p['name'];
			$price = $p['price'];
			$totalPrice = $qty*$p['price'];
			$image = $p['image'];
			// echo $productId;
		}
	}

	//check product id is already in previous carts
	$check = mysqli_query($con,"SELECT qty,price FROM carts WHERE user_id=$userId and product_id=$id");
		if (mysqli_num_rows($check)>0) {
			$cd = mysqli_fetch_assoc($check);
			$cart_qty = $cd['qty'];
			$cart_price = $cd['price'];

			    //calculation
			$tQty = $cart_qty+$qty;
			$tPrice = $tQty*$cart_price;
			if(mysqli_query($con,"UPDATE carts SET qty=$tQty, total_price=$tPrice WHERE user_id=$userId and product_id=$id")){
				header('Location:cart_view.php');
			}else{
				echo "Error: ".mysqli_error($con);
			}
		}else{
			if(mysqli_query($con,"INSERT INTO carts(product_name,qty,price,total_price,image,user_id,product_id) VALUES('$product_name',$qty,$price,$totalPrice,'$image',$userId,$productId)")){
				// echo "done";
				// $cart_id = mysqli_insert_id($con);
				header('Location:cart_view.php');
			}else{
				echo "Error: ".mysqli_error($con);
				header('Location:product_view.php?id='.$id);
			}
		}
	mysqli_close($con);
}
?>
