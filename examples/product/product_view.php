<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/jpg" href="img/admin.jpg">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Products</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<!--   Core JS Files   -->
	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<!-- Bootstrap popper -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<!-- Bootstrap 4 js -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="../../assets/js/core/bootstrap-material-design.min.js"></script>
	<script src="../../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
	<?php require_once '../../component/links.php';?>
	<style type="text/css">
	.card{
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.card-img-top{
		width: 180px;
		height: 250px;
		margin-top: 25px;
	}
	main{
		background: red;
		position: absolute;
		top: 20%;
		width: 80%;
		margin-left: 10%;
		margin-right: 10%;
	}
	.container{
		position: relative;
	}
	.img{
		position: absolute;
		left: 10%;
		width: 25%;
	}
	.img img{
		width: ;
	}
	.card-body{
		position: absolute;
		right: 5%;
		width: 60%;
	}
	#qtyDiv{
		display: flex;
		justify-content: center;
		align-items: center;
	}
	input[type=number]{
		width:56px;
		height: 37px; 
		padding-left: 20px; 
		font-size:20px;
		margin: 0 3px;
	}
</style>
</head>
<body>

	<?php
	require_once '../../config/connection.php';
	require_once '../../component/header.php';

	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$result = mysqli_query($con,"SELECT * FROM products WHERE id=$id");
		if(mysqli_num_rows($result)>0){
			while ($p = mysqli_fetch_assoc($result)) {
				$name = $p['name'];
				$color = $p['color'];
				$price = $p['price'];
				$image = $p['image'];
				$category_id = $p['category_id'];
				$description = $p['description'];
				$status = $p['status'];
				?>
				<main>
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="" style="width: 70rem;">
									<div class="img">
										<img class="card-img-top" src="productImg/<?php echo $image; ?>" alt="Card image cap" width="400" height="600">
									</div>
									<div class="card-body text-center">
										<h4 class="card-title"> <?php echo $name; ?> </h4>

										<p class="card-text" style=""><h5 style="display: inline;">Price: </h5><i style="color:black;">&#8377; </i> <i class="price"><?php echo $price; ?></i></p>

										<p class="card-text" style=""><h5 style="display: inline;">Color: </h5><?php echo $color; ?></p>

										<h5 style="display: inline;">Description: </h5>
										<i class="card-text"><?php echo $description; ?></i>
										<div id="qtyDiv">
											<i class="btn btn-primary fa fa-minus"></i>
											<input type="number" name="number" id="qty" value="1" style="">
											<i class="btn btn-primary fa fa-plus"></i>
										</div>
										<button class="btn btn-primary addToCart btn-block mt-2" data-id="<?php echo $id; ?>">Add To Cart</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</main>
				<div id="cart">
					
				</div>
				<script type="text/javascript">
					jQuery(document).ready(function(){
						// alert("ready");
						var qtybox = jQuery('input[type=number]');
						var qty = qtybox.attr('value');
						qty = parseInt(qty);
						// alert(qty);

						jQuery('i.fa-minus').click(function(){
							if(qty != 1){
								qty = qty - 1;
								if(qty < 10){
									qtybox.css('paddingLeft','20px');
								}
								qtybox.attr('value',qty);
								// alert(qty);
							}
						});

						jQuery('i.fa-plus').click(function(){
							qty = qty + 1;
							if(qty == 10){
								qtybox.css('paddingLeft','12px');
							}
							qtybox.attr('value',qty);
							// alert(qty);
						});

						// //second way to change qty
						// qtybox.change(function(){
						// 	 qtycheck = parseInt(qtybox.attr('value'));
						//     	alert(qtycheck);
						// });
						//addtocart
						jQuery('.addToCart').click(function(){
								let id = jQuery(this).attr('data-id');
								//qty
								let price = parseInt(jQuery('.price').text());
								// alert(price);
								// let totalPrice = price * qty;
								// alert(totalPrice);
								// let product_name = jQuery('.card-title').text();
								// // alert(product_name);
								// let product_image = jQuery('.card-img-top').attr('src');
								// // alert(product_image);
								sendData = "id="+id+"&qty="+qty;
								location.assign('addCart.php?'+sendData);
								// jQuery.ajax({
								// 	url : 'addCart.php',
								// 	type : 'get',
								// 	data : sendData,
								// 	success: function(data){
								// 		if (data == "done") {
								// 			swal('Cart Added',"","success");
								// 		}else{
								// 			swal('Cart Not Added',data,"error");
								// 		}
								// 	}
								// });
						});
					});
				</script>
			</body>
			</html>

			<?php
		}
	}
}
?>



