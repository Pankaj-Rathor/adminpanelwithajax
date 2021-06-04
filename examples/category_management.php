<?php
session_start();
require_once 'category/category.php';
?>
<style>
*{
	box-sizing: border-box;
	margin: 0;
}
.dropdown-submenu {
	position: relative;
}

.dropdown-submenu .dropdown-menu { 
	top: 0; 
	left: 100%; 
	margin-top: -1px;
}
a.test{ 
	color: black; 
	text-decoration: none;
}
a.test:hover{ color: #ff1744; } 
.error{color: red;}
.e1{
	border: 2px solid darkred;
}


</style> 

<div class="wrapper " style="position: absolute; top: 30px; left:20%; width: 80%;">
	<h2 class="text-center">Category Mangements</h2>
	
	<div style="padding-bottom:5px;"><hr></div>

	<div class="container">
		<div class="row">
			<div class="col-7" style="border-right: 2px solid gray;">
				<h2 class="text-center">Operation On Category</h2>
				<form action="" id="form" method="post" class="addform">
					<div class="form-group">
						<input id="id" type="hidden" name="id" value="">
						<label for="name">Category Name</label>
						<input id="name" class="form-control" type="text" name="name" placeholder="Enter Category Name">
					</div>
					<div class="form-group">
						<label for="parent_id">Parent Id</label>
						<input id="parent_id" class="form-control" type="number" name="parent_id" placeholder="Enter Parent Id">
					</div>
					<div class="form-group">
						<label for="status">Status</label>
						<input id="status" class="form-control" type="number" name="status" min="0" max="1" placeholder="Enter Status">
					</div>
					<p id="invalidCount" style="color: red;"></p>
					<div class="form-group">
						<button id="submit" type="submit" class="btn btn-primary btn-block">Add</button>
					</div>
				</form>
				<div style="padding-top:5px;"><hr></div>
				<!-- table view -->
				
			</div>
			<div class="col-5">
				<h2>Select Category</h2>
				<p>Select Category And Do Operation On That</p>
				<div class="container">                                  
					<div class="dropdown" style="position:relative; top:0">
						<button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Categories
							<span class="caret"></span></button>
							<?php echo buildTreeView($arr); ?>
						</div>
					</div>

				</div>
			</div>
			<div style="border-bottom: 2px solid darkgray; width: 100%;"></div>

			<div id="viewCat">

			</div>

		</div>
	</div>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/additional-methods.min.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			//category mangement
			jQuery('a.test').mouseenter(function(event){
				event.stopPropagation();
				jQuery(this).next('ul').toggle();
				jQuery(this).attr('aria-expanded','true');
				// jQuery('li ul.dropdown-submenu').css('display','none');
			});
			jQuery('.dropdown-toggle').mouseenter(function(){
				jQuery(this).click();
			}); 
			
			var id = 0;
			jQuery('a.test').click(function(event){
				event.preventDefault();
		// get Table
		id = jQuery(this).attr('data-id');
				// console.log("id "+id);
				let scat = "id="+id;
				jQuery('#viewCat').empty().load('category/selectCat.php?'+scat);
			});

	// Validation and form submit
	jQuery('#form').validate({
		rules:{
			name:{
				required:true,
			},
			parent_id:{
				required:true,
			},
			status:{
				required:true,
			}
		},
		messages:{
			name:{
				required:"Name is required"
			},
			parent_id:{
				required:"Parent ID is required"
			},
			status:{
				required:"Status is required"
			}
		},
		highlight:function(element){
			jQuery(element).addClass('e1');
		},
		unhighlight:function(element){
			jQuery(element).removeClass('e1');
		},
		invalidHandler:function(element){
			let validator = jQuery('.addform').validate();
			jQuery('#invalidCount').text("Total Invalid Fields : "+validator.numberOfInvalids());
		},
		submitHandler:function(form){
			let formName = jQuery('#form').attr('class');
			// alert(formName);
			if(formName=="addform"){
				jQuery('.addform').on('submit',function(event){
					event.preventDefault();
				formdata = jQuery(this).serialize();
				jQuery.ajax({
					url : 'category/addCat.php',
					type : 'post',
					data : formdata,
					success : function(data){
						if(data.trim() == 'done'){
							// alert("done");
							swal('Added New Category',"",'success');
						}else{
							swal('Try Again',data,'error');
						}
					}
				});
			});
			}
			if(formName=="editform"){
				jQuery('.editform').on('submit',function(event){
					event.preventDefault();
					formdata = jQuery('form').serialize();
					jQuery.ajax({
						url : 'category/editCat.php',
						type : 'post',
						data : formdata,
						success : function(data){
							if(data == 'done'){
								swal('Category Edited',"",'success');
							}else{
								swal('Try Again',data,'error');
							}
						}
					});
				});
			}

		}

	});
});
</script>