<?php
session_start();
if(!isset($_SESSION['uid'])){
  header('Location:../index.php');
}

require_once '../config/connection.php';
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
      <div class="container-fluid" style="margin-top:-60px;">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <i style="font-size: 25px;
                font-weight: bold;">Products</i>
                <i><button id="au" class="btn btn-secondary" style="float: right; 
                background-color: skyblue !important;color: white;">Add Products</button></i>
                 <i><button id="productList" class="btn btn-secondary mr-2" style="float: right; 
                background-color: darkblue; !important;color: white;" onclick="location.assign('product_list.php')">Product list</button></i>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        ID
                      </th>
                      <th>
                        Name
                      </th>
                      <th>
                        Color
                      </th>
                      <th>
                        Price
                      </th>
                      <th>
                        Description
                      </th>
                      <th>
                        SKUs
                      </th> 
                      <th>
                        Status
                      </th>
                      <th>
                        Image
                      </th>
                      <th colspan="2" class="text-center">
                        Action
                      </th>
                    </thead>
                    <tbody>
                     <?php
                     $sql = "SELECT * FROM products";
                     $result = mysqli_query($con,$sql);
                     if(mysqli_num_rows($result)>0){
                      while ($product = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                          <td><?php echo $product['id'];?></td>
                          <td><?php echo $product['name'];?></td>
                          <td><?php echo $product['color'];?></td>
                          <td><?php echo $product['price'];?></td>
                          <td><?php echo substr($product['description'], 0,80);?></td>
                          <td><?php echo $product['skus'];?></td>
                          <td>
                            <?php 
                             $status = $product['status'];
                             if($status == 1){
                              echo '<button type="button" class="btn btn-success status">Active</button>';
                             }else{
                              echo '<button type="button" class="btn btn-warning status">Inactive</button>';
                             }
                            ?>
                          </td>
                          <td><img src="product/productImg/<?php echo $product['image'];?>" width="80" height="100"></td>
                          <td><button class="btn btn-primary updateProduct" >Update</button></td>
                          <td><button class="btn btn-danger deleteProduct">Delete</button></td>
                        </tr>
                        <?php
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
  jQuery(document).ready(function(){
    // update User
    jQuery('.updateProduct').click(function(){
      let id = jQuery(this).parents('tr').children().html(); 
      let url = "product.php?id="+id;
      // alert('ok');
      jQuery('#container').empty().load(url);
    });

    //add user
    jQuery('#au').click(function(){
      jQuery('#container').empty().load('product.php');
    });

    // delete User
    jQuery('.deleteProduct').click(function(){
      let id = jQuery(this).parents('tr').children().html(); 
      var target_tr = jQuery(this).parents('tr');
      // console.log(target_tr);
      id = "id="+id;

      swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this User Data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          jQuery.ajax({
            url : 'product/deleteProduct.php',
            type : 'get',
            data : id,
            success : function(data){
              if(data == "done"){
                swal("User has been deleted!", "", "success");
                target_tr.remove();
              }else{
                swal("User Not Deleted",data,"error");
              }
            }
          });

        } else {
          swal("User is safe!");
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
            url : 'product/changeStatus.php',
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
            url : 'product/changeStatus.php',
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