<?php
session_start();
require_once 'connection.php';

if(isset($_GET['id'])){
	$category_not_found=true;
	$result = mysqli_query($con,"SELECT * FROM categories WHERE id=".$_GET['id']);
	if(mysqli_num_rows($result)>0){
		$c = mysqli_fetch_assoc($result);
		$id = $c['id'];
		$name = $c['name'];
		$parent_id = $c['parent_id'];
		$status = $c['status'];

		?>
		<h4 class="text-center">Selected Category</h4>
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>NAME</th>
					<th>PARENT ID</th>
					<th>STATUS</th>
					<th style="padding-left: 45px;">ACTION</th>
				</tr>
			</thead>
			<tbody>
				<tr style="background: #f217ff;">
					<td> <?php echo $id;?> </td>
					<td> <?php echo $name;?> </td>
					<td> <?php echo $parent_id;?> </td>
					<td> 
						<?php if($status==1){
							echo '<button type="button" class="btn btn-success status">Active</button>';
						}else{
							echo '<button type="button" class="btn btn-warning status">Inactive</button>';
						}?> 
					</td>
					<td>
						<button type="button" class="edit btn btn-primary mr-2">Edit</button>
						<button type="button" class="delete btn btn-danger mr-2">Delete</button>
					</td>

				</tr>
				<?php
			}else{
				$category_not_found=false;
				echo "<h2 style='color:red' class='text-center mt-2'>Category Not Found</h2>";
			}
	// Child Category
			if($category_not_found){
				$result = mysqli_query($con,"SELECT * FROM categories WHERE parent_id=".$id);
				if(mysqli_num_rows($result)>0){
					echo '<tr><td colspan="4" style="color: red; padding: 5px; font-size: 20px;" class="text-center"> CHILD NODES</td></tr>';

					while($c = mysqli_fetch_assoc($result)){
						$id = $c['id'];
						$name = $c['name'];
						$parent_id = $c['parent_id'];
						$status = $c['status'];
						?>
						<tr>
							<td> <?php echo $id;?> </td>
							<td> <?php echo $name;?> </td>
							<td> <?php echo $parent_id;?> </td>
							<td> 
								<?php if($status==1){
									echo '<button type="button" class="btn btn-success status">Active</button>';
								}else{
									echo '<button type="button" class="btn btn-warning status">Inactive</button>';
								}?> 
							</td>
							<td>
								<button type="button" class="btn btn-primary mr-2 edit">Edit</button>
								<button type="button" class="btn btn-danger mr-2 delete">Delete</button>
							</td>
						</tr>
						<?php
					}
					echo "</tbody></table>";
				}
			}
		}
		?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
			//delete
			jQuery(".delete").click(function(event){
				event.preventDefault();
				// alert("click");
				let id = jQuery(this).parents('tr').children().html();
				let tr =jQuery(this).parents('tr');

				// console.log(id);
				jQuery.ajax({
					url : 'category/deleteCat.php',
					type : 'post',
					data : "id="+id,
					success : function(data){
						if(data = "done"){
							swal("Category Deleted","","success");
							tr.fadeOut(1000);
						}else{
							swal("Category Not Deleted",data,"error");
						}
					}
				});
			});


				jQuery('.status').click(function(event){
					event.preventDefault();
					let id = jQuery(this).parents('tr').children().html(); 
					let clickbtn = jQuery(this);
					let btnStatus = clickbtn.text();
			      // console.log(btnStatus);
			      
			      if(btnStatus.trim() == "Active"){
			      	let sendData = "id="+id+"&status=0";
			      	jQuery.ajax({
			      		url : 'category/changeStatus.php',
			      		type : 'get',
			      		data : sendData,
			      		success : function(data){
			      			if(data == "done"){
			      				swal("Product Is Inactive Now!", "", "success");
			      				clickbtn.removeClass('btn-success').addClass('btn-warning').text('Inactive');
			      			}else{
			      				swal("Product Status Not Changed",data,"error");
			      			}
			      		}
			      	});
			      }
			      else{
			      	let sendData = "id="+id+"&status=1";
			      	jQuery.ajax({
			      		url : 'category/changeStatus.php',
			      		type : 'get',
			      		data : sendData,
			      		success : function(data){
			      			if(data == "done"){
			      				swal("Product Is Active Now!", "", "success");
			      				clickbtn.removeClass('btn-warning').addClass('btn-success').text('Active');
			      			}else{
			      				swal("Product Status Not Changed",data,"error");
			      			}
			      		}
			      	});
			      }

			  });

			
			//edit
			jQuery(".edit").click(function(event){
				event.preventDefault();
				// alert("click");
				let id = jQuery(this).parents('tr').find('td:eq(0)').html();
				let name = jQuery(this).parents('tr').find('td:eq(1)').html();
				let parent_id = jQuery(this).parents('tr').find('td:eq(2)').html();
				let status = jQuery(this).parents('tr').find('td:eq(3) button').attr('status');
				
				// console.log(id+name+parent_id+status);
				let tr =jQuery(this).parents('tr');

				//manipulate in form
				let form = jQuery('#form');
				form.removeClass('addform').addClass('editform');
				form.find('#id').attr('value',id);
				form.find('#name').attr('value',name.trim());
				form.find('#name').focus();
				form.find('#parent_id').attr('value',parseInt(parent_id));
				form.find('#status').attr('value',parseInt(status));
				form.find('#submit').text('Edit');
				return false;
				// jQuery.ajax({
				// 	url : 'config/editCat.php',
				// 	type : 'post',
				// 	data : "id="+id,
				// 	success : function(data){
				// 		if(data = "done"){
				// 			swal("Category Edited","","success");
				// 		}else{
				// 			swal("Category Not Editd",data,"error");
				// 		}
				// 	}
				// });
			});

		});
	</script>