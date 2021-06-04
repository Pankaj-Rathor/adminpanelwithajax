<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/jpg" href="../img/admin.jpg">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Checkout</title>
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
	<!-- validate plugin -->
	<!-- <script src="../js/jquery.validate.min.js"></script> -->
	<!-- <script src="../js/additional-methods.min.js" type="javascript"></script> -->
	<?php require_once '../../component/links.php';?>
	<style type="text/css">
	main{
		/*background: red;*/
		position: absolute;
		top: 10%;
		width: 94%;
		margin-left: 3%;
		margin-right: 3%;
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
		border: 1px solid #f1f1f1;
		font-size: 0.90em;
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
		display: flex;
		justify-content: center;
		align-items: center;
		background: #f2f2f2;
		padding: 5px;
		margin-bottom: 10px;
	}
	div span{
		margin-right: 250px;
		padding-left: 16px;
	}

	.error{
		color: red;
	}

</style>
</head>
<body>

	<?php
	require_once '../../config/connection.php';
	require_once '../../component/header.php';

// echo "<pre>";
// print_r($_SESSION['product_id']);

	if(isset($_SESSION['uid'])){
		$id = $_SESSION['uid'];
		$sql1 = "SELECT SUM(total_price) FROM `carts` WHERE user_id=$id and buy=0";
		$sql2 = "SELECT SUM(qty) FROM `carts` WHERE user_id=$id and buy=0";
		?>

		<main>
			<div class="heading"><h2>CHECKOUT</h2></div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-8">

						<div class="details" style="border:1px solid #f2f2f2;">
							<div class="heading" style="background:limegreen; padding: 0;"><p class="text-center pt-3" style="color: white; font-size:20px; font-weight: 25px;">Billing Detail</p></div>
							<form id="bill" action="" method="post" style="margin: 0px 25px;">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="fname">First Name</label>
											<input class="form-control" type="text" name="fname">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="lname">Last Name</label>
											<input class="form-control" type="text" name="lname">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="email">Email Address</label>
											<input class="form-control" type="email" name="email">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="phone">Phone Number</label>
											<input class="form-control" type="text" name="phone">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="address">Street Address</label>
											<input class="form-control" type="text" name="address">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="country">Country</label>
											<select class="form-control" name="country">
												<option value="" selected disabled>Select Country</option>
												<option value="India">India</option>
												<option value="US">Us</option>
												<option value="Nepal">Nepal</option>
												<option value="Algeria">Algeria</option>
												<option value="Belgium">Belgium</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="state">State/Province</label>
											<input class="form-control" type="text" name="state">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="city">City</label>
											<input class="form-control" type="text" name="city">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="zip">Zip/Postal Code</label>
											<input class="form-control" type="text" name="zip">
										</div>
									</div>
								</div>
								<div id="payment-section">
									<div class="heading" style="background:limegreen; padding: 0;"><p class="text-center pt-1" style="color: white; font-size:20px; font-weight: 25px; ">Payment Options</p></div>
									<input type="radio" id="payWithPaypal" name="pay" value="payWithPaypal" style="width:30px"><i style="font-size:18px;">Pay with PayPal</i>
									<br>
									<input type="radio" id="payWithStripe" name="pay" value="payWithStripe" style="width:30px"><i style="font-size:18px;">Pay with Stripe</i>
									<div>
									<label for="pay" generated="true" class="error" style="display:none;"></label>
									</div>
								</div>
							</form>
								<div style="margin-bottom: 100px;"></div>
						</div>




			<!-- <div class="creditCard" style="">
				<form id="creditInfo" action="" method="post">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="address">Card Number</label>
								<input class="form-control" type="text" name="address">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="fname">Month</label>
								<select class="form-control" id='gMonth2' onchange="show_month()">
								    <option selected disabled>Month</option>
								    <option value='1'>Janaury</option>
								    <option value='2'>February</option>
								    <option value='3'>March</option>
								    <option value='4'>April</option>
								    <option value='5'>May</option>
								    <option value='6'>June</option>
								    <option value='7'>July</option>
								    <option value='8'>August</option>
								    <option value='9'>September</option>
								    <option value='10'>October</option>
								    <option value='11'>November</option>
								    <option value='12'>December</option>
								</select> 
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="lname">Year</label>
								 <select class="form-control" name="year">
						          <option selected disabled>Year</option>
						          <option value="2021">2021</option>
						          <option value="2022">2022</option>
						          <option value="2023">2023</option>
						          <option value="2024">2024</option>
						          <option value="2025">2025</option>
						          <option value="2026">2026</option>
						          <option value="2027">2027</option>
						          <option value="2028">2028</option>
						          <option value="2029">2029</option>
						          <option value="2030">2030</option>
						      </select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="lname">Security Code</label>
								<input class="form-control" type="number" name="lname" style="width:100%;">
							</div>
						</div>
					</div>
				</form>
			</div> -->
		</div>

		<div class="col-md-4">
			<div class="heading" style="background:limegreen; padding: 0;"><p class="text-center pt-3" style="color: white; font-size:20px; font-weight: 25px;">Cart Summary</p></div>
			<div></div>
			<table>
				<?php
				$sql = "SELECT * FROM carts WHERE user_id=$id and buy=0";
				$result = mysqli_query($con,$sql);
				if(mysqli_num_rows($result)>0){
					while ($c = mysqli_fetch_assoc($result)) {
						$name = substr($c['product_name'],0,58);
						$price = $c['price'];
						$image = $c['image'];
						$total_price = $c['total_price'];
						$qty = $c['qty'];
						$add_time = $c['add_time'];
						$user_id = $c['user_id'];
						?>
						<tr>
							<td class="cart-img"><img src="productImg/<?php echo $image;?>" width=60 height=90></td>
							<td style="width: 39%;"><?php echo $name;?></td>
							<td>Qty:<i> <?php echo $qty;?></i></td>
							<td><i style="font-size:20px;">&#8377; </i><?php echo $total_price;?></td>
						</tr>
						<?php
					}
					?>
				</table>

				<div class="row mt-4">
					<div class="col-md-12">
						<div class="heading" style="background:limegreen; padding: 0;"><p class="text-center pt-2" style="color: white; font-size:20px; font-weight: 25px;">Cart Total</p></div>
						<div></div>
						<?php 
							$Qty=mysqli_fetch_assoc(mysqli_query($con,$sql2));
							$totalQty = $Qty['SUM(qty)'];
							$_SESSION['qty'] = $totalQty;

							$t=mysqli_fetch_assoc(mysqli_query($con,$sql1));
							$totalPrice = $t['SUM(total_price)'];
							$_SESSION['Payment_amount'] = $totalPrice*100; //this is only for stripe
						?>
						<!-- &#8377; -->
						<style type="text/css">
							.cart_total td{
								border: none;
							}
						</style>
					<table class="table cart_total">
						<tr>
							<td>Qty</td>
							<td><?php echo $totalQty?></td>
						</tr>
						<tr>
							<td>Subtotal</td>
							<td>&#8377;  <?php echo $totalPrice?></td>
						</tr>
						<tr>
							<td>Total</td>
							<td>&#8377;  <?php echo $totalPrice?></td>
						</tr>
					</table class="table">

						<form id="checkTerm">
							<input type="checkbox" name="term" id="term" class="ml-3"><i style="font-size:18px;"> I have read and agree Terms & Conditions * </i>
							<label for="term" generated="true" class="error" style="display:none; padding-left: 18px; font-size: 17px;">Please check this box to confirm that you agree to our Terms & Conditions</label>
						</form>

						<button id="pay" type="button" class="btn btn-primary btn-block" style="float:right;">Pay</button>
<!-- payment methods -->

						<?php
						require_once 'payment/stripe/config.php';
						?>
						<!-- payment with stripe -->
						<form action="payment/stripe/payment.php" method="post" style="display:none;">
							<script
							src="https://checkout.stripe.com/checkout.js" class="stripe-button"
							data-key="<?php echo $publishable_key;?>"
							data-amount="<?php echo $totalPrice = $t['SUM(total_price)']*100;?>"
							data-name="MyShop"
							data-description="Name: <?php echo $_SESSION['b_fname'].' '.$_SESSION['b_lname'];?>"
							data-image=""
							data-currency="inr" 
							data-email="<?php echo $_SESSION['b_email']?>"
							></script>
						</form>

						<!-- payment with PayPal -->
						<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" style="display:none;">
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="upload" value="1">
							<input type="hidden" name="business" value="sb-ymgch6410442@business.example.com">

							<input type="hidden" name="return" value="http://localhost/AdminPanelWithBootstrap/examples/product_list.php">
							<?php
							$carts = mysqli_query($con,$sql);
							if(mysqli_num_rows($carts)>0){
								$i=1;
								while($d = mysqli_fetch_assoc($carts)){
									?>
									<input type="hidden" name="item_name_<?php echo $i?>" value="<?php echo $d['product_name']?>">
									<input type="hidden" name="amount_<?php echo $i?>" value="<?php echo $d['price']?>">
									<input type="hidden" name="quantity_<?php echo $i?>" value="<?php echo $d['qty']?>">
									<?php
									$i++;
								}
							}
							?>

							<input id="paypal" type="submit" name="PayPal">
						</form>
					</div>
<!-- End payment methods -->


				</div>
			</div>

		</div>

		<input id="cartId" type="hidden" name="id" value="<?php echo $id ?>">
	</div>
</main>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
					// alert("ready");

					jQuery('#bill').validate({
						rules:{
							fname:{
								required:true,
								lettersonly:true
							},
							lname:{
								required:true,
								lettersonly:true
							},
							email:{
								required:true,
								email:true
							},
							phone:{
								required:true,
								maxlength:10
							},
							address:{
								required:true
							},
							country:{
								required:true
							},
							state:{
								required:true,
								lettersonly:true
							},
							city:{
								required:true,
								lettersonly:true
							},
							zip:{
								required:true,
								digits:true
							},
							pay:{
								required:true
							}						
						},
						messages:{
							pay:{
								required:"Please Select Payment Method"
							}
						},
						submitHandler:function(form){
							if(jQuery('#term').is(':checked')){
								jQuery('#bill').on('submit',function(event){
									event.preventDefault();
									let formdata = jQuery(this).serialize();
									jQuery.ajax({
										url : 'payment/addBill.php',
										type : 'post',
										data : formdata,
										success:function(data){
											if(data == "true"){
											// swal("success","","success");
											let payMethod = jQuery('input[name=pay]:checked').attr('value');
											if (payMethod == "payWithPaypal") {
												jQuery('#paypal').click();
											}
											else if(payMethod == "payWithStripe"){
												jQuery('.stripe-button-el').click();
											}
												// jQuery('#pay').hide();
										}
									}
								});
								})
							}
						}
					});

					jQuery('#checkTerm input[name=term]').click(function(){
						if(jQuery('#term').is(':checked')){
							jQuery('#checkTerm label').hide();
						}else{
							jQuery('#checkTerm label').show();
						}
					});

					// jQuery('#test').click(function(){
					// let pay = jQuery('input[name=pay]:checked').attr('value');
					// console.log(pay);

					// });


					jQuery('#pay').click(function(){
						jQuery('#bill').submit();
					});

					// jQuery('.stripe-button-el').addClass('btn');


					var qtybox = jQuery('input[type=number]');
					var qty = qtybox.attr('value');
					qty = parseInt(qty);
					// alert(qty);

					jQuery('i.fa-minus').click(function(){
						if(qty != 0){
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

					//delete cart
					jQuery('.fa-trash').click(function(event){
						event.preventDefault();
						let tr = jQuery(this).parents('tr');
						let id = jQuery('#cartId').attr('value');
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

				// jQuery('input[name=payWithCreditCard]').click(function(){
				// 	// alert("click");
				// 	jQuery('.creditCard').toggle();
				// });


			});
		</script>
	</body>
	</html>

	<?php
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



