<?php

function allProductList(){
	global $con;
	$result = mysqli_query($con,"SELECT * FROM products");
	if(mysqli_num_rows($result)>0){
		while($p = mysqli_fetch_assoc($result)){
			$name = substr($p['name'],0,51);
			echo '<div class="col-md-4">
					<div class="card" style="width: 20rem;">
						<img class="card-img-top" src="product/productImg/'.$p['image'].'" alt="Card image cap" width="180" height="200">
						<div class="card-body text-center">
							<h5 class="card-title">'.$name.'</h5>
							<p class="card-text" style=""><i style="color:black;">&#8377; </i> '.$p['price'].'</p>
							<a href="#" class="btn btn-primary buy" data-id="'.$p['id'].'">Buy</a>
						</div>
					</div>
				</div>';
		}
		echo '<script>
				jQuery(".buy").click(function(){
				let id = jQuery(this).attr("data-id");
					// alert(id);
					location.assign("product/product_view.php?id="+id);
				});
			</script>';
	}
}

function ProductListByCategoryId($category_id){
	global $con;
	$result = mysqli_query($con,"SELECT * FROM products WHERE category_id=$category_id");
	if(mysqli_num_rows($result)>0){
		while($p = mysqli_fetch_assoc($result)){
			$name = substr($p['name'],0,51);
			echo '<div class="col-md-4">
					<div class="card" style="width: 20rem;">
						<img class="card-img-top" src="product/productImg/'.$p['image'].'" alt="Card image cap" width="180" height="200">
						<div class="card-body text-center">
							<h5 class="card-title">'.$name.'</h5>
							<p class="card-text" style=""><i style="color:black;">&#8377; </i> '.$p['price'].'</p>
							<a href="#" class="btn btn-primary buy" data-id="'.$p['id'].'">Buy</a>
						</div>
					</div> 
				</div>';
		}
		echo '<script>
				jQuery(".buy").click(function(){
				let id = jQuery(this).attr("data-id");
					// alert(id);
					location.assign("product/product_view.php?id="+id);
				});
			</script>';
	}
}

function ProductListByLowToHigh(){
	global $con;
	$result = mysqli_query($con,"SELECT * FROM products ORDER BY price ASC");
	if(mysqli_num_rows($result)>0){
		while($p = mysqli_fetch_assoc($result)){
			$name = substr($p['name'],0,51);
			echo '<div class="col-md-4">
					<div class="card" style="width: 20rem;">
						<img class="card-img-top" src="product/productImg/'.$p['image'].'" alt="Card image cap" width="180" height="200">
						<div class="card-body text-center">
							<h5 class="card-title">'.$name.'</h5>
							<p class="card-text" style=""><i style="color:black;">&#8377; </i> '.$p['price'].'</p>
							<a href="#" class="btn btn-primary buy" data-id="'.$p['id'].'">Buy</a>
						</div>
					</div>
				</div>';
		}
		echo '<script>
				jQuery(".buy").click(function(){
				let id = jQuery(this).attr("data-id");
					// alert(id);
					location.assign("product/product_view.php?id="+id);
				});
			</script>';
	}
}


function ProductListByHighToLow(){
	global $con;
	$result = mysqli_query($con,"SELECT * FROM products ORDER BY price DESC");
	if(mysqli_num_rows($result)>0){
		while($p = mysqli_fetch_assoc($result)){
			$name = substr($p['name'],0,51);
			echo '<div class="col-md-4">
					<div class="card" style="width: 20rem;">
						<img class="card-img-top" src="product/productImg/'.$p['image'].'" alt="Card image cap" width="180" height="200">
						<div class="card-body text-center">
							<h5 class="card-title">'.$name.'</h5>
							<p class="card-text" style=""><i style="color:black;">&#8377; </i> '.$p['price'].'</p>
							<a href="#" class="btn btn-primary buy" data-id="'.$p['id'].'">Buy</a>
						</div>
					</div>
				</div>';
		}
		echo '<script>
				jQuery(".buy").click(function(){
				let id = jQuery(this).attr("data-id");
					// alert(id);
					location.assign("product/product_view.php?id="+id);
				});
			</script>';
	}
}

function ProductListByNewest(){
	global $con;
	$result = mysqli_query($con,"SELECT * FROM products ORDER BY p_time DESC");
	if(mysqli_num_rows($result)>0){
		while($p = mysqli_fetch_assoc($result)){
			$name = substr($p['name'],0,51);
			echo '<div class="col-md-4">
					<div class="card" style="width: 20rem;">
						<img class="card-img-top" src="product/productImg/'.$p['image'].'" alt="Card image cap" width="180" height="200">
						<div class="card-body text-center">
							<h5 class="card-title">'.$name.'</h5>
							<p class="card-text" style=""><i style="color:black;">&#8377; </i> '.$p['price'].'</p>
							<a href="#" class="btn btn-primary buy" data-id="'.$p['id'].'">Buy</a>
						</div>
					</div>
				</div>';
		}
		echo '<script>
				jQuery(".buy").click(function(){
				let id = jQuery(this).attr("data-id");
					// alert(id);
					location.assign("product/product_view.php?id="+id);
				});
			</script>';
	}
}
?>