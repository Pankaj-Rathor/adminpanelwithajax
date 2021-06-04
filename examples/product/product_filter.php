<?php
require_once '../../config/connection.php';
require_once 'product_function.php';

if(isset($_GET['id'])){
	$id = $_GET['id'];
	if($id == 0){
		allProductList();
	}else{
		ProductListByCategoryId($id);
	}
}

if(isset($_GET['filter'])){
	$filter = $_GET['filter'];
	
	if($filter == 0){
		ProductListByNewest();
	}
	elseif ($filter == 1){
		ProductListByLowToHigh();
	}
	elseif ($filter == 2){
		ProductListByHighToLow();
	}
}

?>