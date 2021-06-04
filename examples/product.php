<?php
session_start();
if(!isset($_SESSION['uid'])){
  header('Location:../index.php');
  exit();
}

require_once '../config/connection.php';
require_once 'category/category.php';
$id=$name=$color=$price=$image=$category_id=$skus=$description=$admin_id=$status="";
if(isset($_GET['id'])){
  $id = $_GET['id'];

  $sql = "SELECT * FROM products WHERE id='$id'";
  $result = mysqli_query($con,$sql);
  if(mysqli_num_rows($result)>0){
    while ($product = mysqli_fetch_assoc($result)) {
      $name = $product['name'];
      $color = $product['color'];
      $price = $product['price'];
      $image = $product['image'];
      $category_id = $product['category_id'];
      $skus = $product['skus'];
      $description = $product['description'];
      $status = $product['status'];
    }
  }
}
?>
<!--
=========================================================
Material Dashboard - v2.1.2
=========================================================

Product Page: https://www.creative-tim.com/product/material-dashboard
Copyright 2020 Creative Tim (https://www.creative-tim.com)
Coded by Creative Tim

=========================================================
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<body class="">
  <div class="wrapper ">
    <div class="main-panel">
      <div class="content">
        <div class="container-fluid" style="margin-top:-65px;">
          <div class="row" style="display: flex ;justify-content: center;">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Product</h4>
                  <p class="card-category">Fill The Product Details</p>
                </div>
                <div class="card-body">
                  <?php
                  if(isset($_GET['id'])){
                    ?>
                    <form id="pform" action="" method="post" class="editform" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-3">
                          <div class="form-group">
                            <label class="bmd-label-floating">Product ID</label>
                            <input type="text" class="form-control" value="<?php echo $id;?>" disabled>
                            <input type="text" class="form-control" name="id" value="<?php echo $id;?>" style="display: none;">
                          </div>
                        </div>
                        <?php
                      }else{
                        ?>
                        <form id="pform" action="" method="post" class="addform" enctype="multipart/form-data">
                          <div class="row">
                           <?php
                         }
                         ?>
                         <div class="col-3">
                          <div class="form-group">
                            <label for="categories">Select Category</label>
                            <?php
                            if(isset($_GET['id'])){
                              getCategory($category_id); 
                            }else{
                              getCategory(); 
                            }
                            ?>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" class="form-control" type="text" name="name" placeholder="Enter Product Name" value="<?php echo $name;?>">
                          </div>
                        </div>
                        <div class="col-6">
                         <div class="form-group">
                          <label for="color">Color</label>
                          <input id="color" class="form-control" type="text" name="color" placeholder="Enter Product Color" value="<?php echo $color;?>">
                        </div>
                      </div>
                      <div class="col-6">
                       <div class="form-group">
                        <label for="price">Price</label>
                        <input id="price" class="form-control" type="text" name="price" placeholder="Enter Product Price" value="<?php echo $price;?>">
                      </div>
                    </div>

                    <div class="col-12">
                     <div class="form-group">
                      <label for="skus">SKUs</label>
                      <input id="skus" class="form-control" type="text" name="skus" placeholder="Enter Product SKUs(Stock Keeping Unit)" value="<?php echo $skus;?>">
                    </div>
                  </div>
                  <div class="col-12">
                   <div class="form-group">
                    <label for="description">Description</label>
                    <textarea rows="5" id="description" class="form-control" name="description" placeholder="Enter Product Description"><?php echo $description;?></textarea>
                  </div>
                </div>
                <div class="col-3">
                 <div class="form-group">
                  <label for="status">Status</label>
                  <input id="status" class="form-control" type="number" name="status" min="0" max="1" placeholder="Enter Status" value="<?php echo $status; ?>">
                </div>
              </div>
              <div class="col-9">
             <!--  <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Upload Image</span>
                  </div>
                  <div class="custom-file">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                  </div>
                </div> -->
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" accept="jpg,jpeg,gif,png">
                <?php
                if(isset($_GET['id'])){
                  echo '<input class="form-control" type="text" name="oldImage" value="'.$image.'">';
                }
                ?>

                <label class="error" for="image" style="display:none;"></label>
              </div>
              <p id="invalidCount" style="color: red;"></p>
              <div class="col-12">
               <?php
               if(isset($_GET['id'])){
                ?>
                <button type='submit' class='btn btn-primary pull-right'>Update Product</button>
                <?php
              }else{
                ?>
                <button type='submit' class='btn btn-primary pull-right'>Add Product</button>
                <?php
              }
              ?>
            </div>

            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/additional-methods.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){
      // Validation and form submit
      jQuery('#pform').validate({
        rules:{
          categories:{
            required:true,
          },
          name:{
            required:true,
        // alphanumeric:true
      },
      color:{
        required:true,
        // lettersonly:true
      },
      price:{
        required:true,
        number:true,
        digits:true
      },
      skus:{
        required:true,
        // alphanumeric:true
      },
      description:{
        required:true,
        // letterswithbasicpunc:true
      },
      status:{
        required:true,
        digits:true
      }
    },
    messages:{
      categories:{
        required:"Please Select Category",
      },
      name:{
        required:"Product Name is must required",
      },
      color:{
        required:"Please Enter Product Color Name",
      },
      price:{
        required:"Please Enter Product price",
      },
      skus:{
        required:"Please Enter Product SKUs",
      },
      description:{
        required:"Product Description must required",
      },
      status:{
        required:"Product Status must required",
      }
    },
    highlight:function(element){
      jQuery(element).addClass('e1');
    },
    unhighlight:function(element){
      jQuery(element).removeClass('e1');
    },
    invalidHandler:function(element){
      let validator = jQuery('#pform').validate();
      jQuery('#invalidCount').text("Total Invalid Fields : "+validator.numberOfInvalids());
    },
    submitHandler:function(form){
      let formName = jQuery('#pform').attr('class');
      // alert(formName);
      if(formName=="addform"){
        jQuery('.addform').on('submit',function(event){
          event.preventDefault();
          formdata = new FormData(this);
          // formdata = jQuery(this).serialize();
          // console.log(formdata);
          jQuery.ajax({
            url : 'product/addProduct.php',
            type : 'post',
            data : formdata,
            success : function(data){
              if(data.trim() == 'done'){
              // alert("done");
              swal('Added New Product',"",'success');
             jQuery('#container').empty().load('product_management.php');
            }else{
              swal('Try Again',data,'error');
            }
          },
          processData:false,
          contentType:false
        });
        });
      }

      else if(formName=="editform"){
        jQuery('.editform').on('submit',function(event){
          event.preventDefault();
          formdata = new FormData(this);
          // formdata = jQuery(this).serialize();
          // console.log(formdata);

          jQuery.ajax({
            url : 'product/updateProduct.php',
            type : 'post',
            data : formdata,
            success : function(data){
              if(data == 'done'){
                swal('Product Edited',"",'success');
               jQuery('#container').empty().load('product_management.php');
              }else{
                swal('Try Again',data,'error');
              }
            },
            processData:false,
            contentType:false
          });
        });
      }

    }
  });
    });
  </script>

  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
});
</script>
</body>

</html>