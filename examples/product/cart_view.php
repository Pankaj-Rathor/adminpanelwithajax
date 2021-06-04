<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/jpg" href="img/admin.jpg">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Cart</title>
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
	main{
		/*background: red;*/
		position: absolute;
		top: 20%;
		width: 80%;
		margin-left: 10%;
		margin-right: 10%;
	}
	
	input[type=number]{
		width:56px;
		height: 37px; 
		padding-left: 20px; 
		font-size:20px;
		margin: 0 3px;
	}
	th,td{
		text-align: center;
	}
	th{
		background: limegreen;
		color: white;
	}
	td{
		font-weight: bold;
		border: 1px solid #f2f2f2;
	}
	.cart-img{
		display: flex;
		justify-content: center;
	}
	#qtyDiv{
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.heading{
		background: #f2f2f2;
		padding: 5px;
		margin-bottom: 10px;
	}
</style>
</head>
<body>

	<?php
	require_once '../../config/connection.php';
	require_once '../../component/header.php';

	if(isset($_SESSION['uid'])){
		// $product_id = [];
		$user_id = $_SESSION['uid'];
		
		$result = mysqli_query($con,"SELECT * FROM carts WHERE user_id=$user_id");
		if(mysqli_num_rows($result)>0){
			
				?>
				<main>
					<div class="heading"><h2 class="text-center">CART</h2></div>
					<div class="container">
						<table class="table">
							<tr>
								<th>Image</th>
								<th>Product</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Total</th>
								<th>Action</th>
							</tr>
							<?php
							while ($c = mysqli_fetch_assoc($result)) {
								$id = $c['id'];
								$name = $c['product_name'];
								$price = $c['price'];
								$image = $c['image'];
								$total_price = $c['total_price'];
								$qty = $c['qty'];
								$add_time = $c['add_time'];
								$user_id = $c['user_id'];
								// array_push($product_id, $c['product_id']);
							?>
							<tr>
								<td style="display: none;"><?php echo $id;?></td>
								<td class="cart-img"><img src="productImg/<?php echo $image;?>" width=90 height=90></td>
								<td><?php echo $name;?></td>
								<td>
									<div id="qtyDiv">
										<i class="btn btn-primary fa fa-minus"></i>
										<input type="number" name="number" class="qty" value="<?php echo $qty;?>">
										<i class="btn btn-primary fa fa-plus"></i>
									</div>
								</td>
								<td><i style="font-size:20px;">&#8377; </i><?php echo $price;?></td>
								<td><?php echo $total_price;?></td>
								<td><i class="fa fa-trash fa-3x" style="color:gray; cursor: pointer;"></i> </td>
							</tr>
<?php
		}
		// $_SESSION['product_id'] = $product_id;
	}else{
		?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				history.back();
			});
		</script>
		<?php
	}
}
?>
						</table>
						<button class="btn Checkout" style="background: salmon; float:right;" onclick="location.assign('checkout.php')">Proceed to Checkout</button>
					</div>
					<div>
						<button class="btn btn-primary" style="float:left;" onclick="location.assign('../product_list.php')">Continue Shopping</button>
					</div>
				</main>

				<script type="text/javascript">
					jQuery(document).ready(function(){
						// alert("ready");
						// var qtybox = jQuery('.qty');
						
						// alert(qty);

						jQuery('.fa-minus').click(function(){
							let qtyInput = jQuery(this).parent().find('.qty');
							let qty = parseInt(qtyInput.attr('value'));
							// alert(qty);
							if(qty != 1){
								qty = qty - 1;
								if(qty < 10){
									qtyInput.css('paddingLeft','20px');
								}
								qtyInput.attr('value',qty);
								// alert(qty);
								let tr = jQuery(this).parents('tr');
								let id = tr.children().html();
								// alert(id);
								updateQty(id,qty,tr);
							}
						});

						jQuery('.fa-plus').click(function(){
							let qtyInput = jQuery(this).parent().find('.qty');
							let qty = parseInt(qtyInput.attr('value'));
							qty = qty + 1;
							if(qty == 10){
								qtyInput.css('paddingLeft','12px');
							}
							qtyInput.attr('value',qty);
							// alert(qty);
							let tr = jQuery(this).parents('tr');
							let id = tr.children().html();
							// alert(id);
							updateQty(id,qty,tr);
						});

						//delete cart
						jQuery('.fa-trash').click(function(event){
							event.preventDefault();
							let tr = jQuery(this).parents('tr');
							let id = tr.children().html();
							// alert(id);
							id = "id="+id;
							// console.log(id);
							jQuery.ajax({
								url : 'deleteCart.php',
								type : 'get',
								data : id,
								success :function(data){
									if(data == "done"){
										swal("Cart Deleted","","success");
										tr.remove();
									}else{
										swal("Cart Not Deleted","","error");
									}
								}
							});
						});

						// // update qty 
						function updateQty(cart_id,qty,tr){
							let id = "id="+cart_id+"&qty="+qty;
							// console.log(id);
							jQuery.ajax({
								url : 'updateQty.php',
								type : 'get',
								data : id,
								success :function(data){
									if(!isNaN(Number(data))){
										tr.find('td:eq(-2)').html(data);
									}
								}
							});
						}

					});
				</script>
			</body>
			</html>




