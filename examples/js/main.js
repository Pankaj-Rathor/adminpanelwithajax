jQuery(document).ready(function(){

	//admin_panel
	jQuery('#container').load('dashboard.php');
 	// sidebar
 	var page = false;
 	jQuery('#sidebar ul li').click(function(event){
 		event.preventDefault();
 		// alert("ok");

 		jQuery('#sidebar ul li').removeClass('active');
 		jQuery(this).addClass('active');
 	});

 	jQuery('#dashboard').click(function(){
 		jQuery('#container').empty().load('dashboard.php');
 	});
 	jQuery('#userlist').click(function(){
 		jQuery('#container').empty().load('user_list.php');
 	});
 	jQuery('#addnewuser').click(function(){
 		jQuery('#container').empty().load('user.php');
 	});

 	//navbar
 	jQuery('#showopt').click(function(){
 		// alert("ok");
 		jQuery('#opt').slideToggle();
 	});

});