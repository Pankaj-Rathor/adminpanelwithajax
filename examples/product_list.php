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
	<script src="../assets/js/core/bootstrap-material-design.min.js"></script>
	<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
	<?php require_once '../component/links.php';?>

	<style type="text/css">
	#sidebar{
		position: fixed;
		width: 16% auto;
		top: 0%;
		z-index: 10;
		border-right: 2px solid #f2f2f2;
		font-size: 1.12em;
		background: #f0ffee;
		padding: 10px;
		height: 100%;
	}
	
	.parent{
		margin-top: 3px;
		padding: 4px;
		text-align: left;
		border-radius: 10px;
		/*color: white;*/
		transition: 1s padding;
		cursor: pointer;
	}

	.child{
		padding: 4px;
		text-align: right;
		cursor: pointer;
	}

	div button{
		background: #555;
		color: white;
		padding: 4px;
		border-radius: 10px;
		border: none;
		outline: none;
		transition: 0.5s padding;
	}
	.child button{
		background: salmon;
		padding: 4px;
		border-radius: 10px;
		border: none;
	}
	.child button:hover{
		background: lightsalmon;
		color: white;
	}
	div button:hover{
		background: darkcyan;
		color: white;
		padding-right:10px;
	}

	.card-text{
		color:darkblue; font-size: 1.16em; font-weight:bold;
	}

	#productlist{
		position: absolute;
		top: 30%;
		width: 80%;
		margin-left: 18%;
	}
	#product_filter{
		position: absolute;
		top: 16%;
		width: 80%;
		background: #f4f4f4;
		padding: 5px;
		margin-left: 18%;
	}

	.logo a{
		text-decoration: none;
		color: black;
		text-transform: uppercase;
		text-align: center;
		font-weight: bold;
		margin-left: 10px;
		font-size: 1.25em;
		border-bottom: 2px solid #999;
	}
	.logo{
		margin-top: 10px;
		margin-bottom: 40px;
	}
	.card{
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.card-img-top{
		width: 140px;
		height: 190px;
		margin-top: 5px;
	}

</style>
</head>
<body>
	<?php 
	require_once '../component/header.php';
	require_once 'category/category.php';
	require_once '../config/connection.php';
	require_once 'product/product_function.php';
	?>
	<div id="sidebar">
		<div class="logo"><a href="#" class="simple-text logo-normal" onclick="history.back()">
			Admin Panel
		</a></div>
		<h4 class="text-center">CATEGORY</h4>
		<?php echo getCategoryByDiv($arr);?>
	</div>

	<div id="product_filter">
		<button type="button" class="btn cid mr-3" data-id=0 style="float:left;">All Product</button>
		<select id="filter" class="btn btn-success" name="sort" style="float: left;">
			<option selected disabled>Sort By</option>
			<option value="0">Newest Product</option>
			<option value="1">Price: Low To Hight</option>
			<option value="2">Price: High To Low</option>
		</select>
	</div>

	<div id="productlist">
		<div class="container-fluid">
			<div class="row" id="products">
				<?php allProductList();?>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		jQuery(document).ready(function(){
			// alert("ready");
			jQuery('.parent').on({
				'mouseover' : function(){
					let d = jQuery(this).children('.child').css('display','block');
					// alert(d);
				},
				'mouseout' : function(){
					let d = jQuery(this).children('.child').css('display','none');
					// alert(d);
				}
			});
			jQuery('div button.cid').click(function(event){
				event.preventDefault();
				let id = jQuery(this).attr('data-id');
					// alert(id);
					id = "id="+id;
					jQuery.ajax({
						url : 'product/product_filter.php',
						type : 'get',
						data : id,
						success : function(data){
							jQuery('#products').empty().html(data);
						}
					});
				});

			jQuery('#filter').change(function(){
				// event.preventDefault();
				let filter = jQuery(this).find(':selected').attr('value');
					// alert(id);
					filter = "filter="+filter;
					jQuery.ajax({
						url : 'product/product_filter.php',
						type : 'get',
						data : filter,
						success : function(data){
							jQuery('#products').empty().html(data);
						}
					});
				});

			

		});
	</script>
</body>
</html>