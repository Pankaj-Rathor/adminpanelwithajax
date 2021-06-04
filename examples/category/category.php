<?php
require_once 'connection.php';

$category = mysqli_query($con,"SELECT * FROM categories");
$arr = [];
while($row = mysqli_fetch_assoc($category)){
	$arr[$row['id']]['name'] = $row['name'];
	$arr[$row['id']]['parent_id'] = $row['parent_id'];
	$arr[$row['id']]['status'] = $row['status'];
}

	// echo '<pre>';
	// print_r($arr);

$html = "";
function buildTreeView($arr, $parent=0, $level=0, $prelevel=-1){
	global $html;

	foreach ($arr as $id => $value) {
		if($parent == $value['parent_id']){
			
			if($level>$prelevel){
				if($html == ""){
					$html.='<ul class="dropdown-menu">';
				}else{
					$html.='<ul class="dropdown-menu">';
				}
			}

			if($level == $prelevel){
				$html.='</li>';
			}

			$html.='<li class="dropdown-submenu"><a class="test" tabindex="-1" data-id="'.$id.'" data-pid="'.$value['parent_id'].'" style="margin-left:30%;">'.$value['name'].'</a>';
			if($level > $prelevel){
				$prelevel=$level;
			}
			$level++;
			buildTreeView($arr,$id,$level,$prelevel);
			$level--;
		}
	}
	if($level == $prelevel){
		$html.='</li></ul>';
	}

	return $html;
}

//use select tag
function getCategory($category_id=0){
	global $con;
	$category = mysqli_query($con,"SELECT * FROM categories");
	echo '<select class="form-control" name="categories">';
	if($category_id == 0){
		echo '<option selected disabled>Select Category</option>';
	}
	while($row = mysqli_fetch_assoc($category)){
		if($category_id==$row['id']){
			echo "<option selected value='".$row['id']."'>".$row['name']."</option>";
		}else{
			echo "<option value='".$row['id']."'>".$row['name']."</option>";
		}
	}
	echo '</select>';
}

//use div tag
$htmldiv = "";
function getCategoryByDiv($arr, $parent=0, $level=0, $prelevel=-1){
	
	global $htmldiv;

	foreach ($arr as $id => $value) {
		if($parent == $value['parent_id']){
			
			if($level>$prelevel){
				if($htmldiv == ""){
					$htmldiv.='<div class="container">';
				}else{
					$htmldiv.='<div class="child" style="display:none;">';
				}
			}

			if($level == $prelevel){
				$htmldiv.='</div>';
			}

			$htmldiv.='<div class="parent"><button class="btn cid" type="button" data-id="'.$id.'" data-pid="'.$value['parent_id'].'">'.$value['name'].'</button>';
			if($level > $prelevel){
				$prelevel=$level;
			}
			$level++;
			getCategoryByDiv($arr,$id,$level,$prelevel);
			$level--;
		}
	}
	if($level == $prelevel){
		$htmldiv.='</div></div>';
	}

	return $htmldiv;
}
?>



