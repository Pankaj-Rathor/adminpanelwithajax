 <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
      -->
      <div class="logo"><a href="<?php echo $_SERVER['PHP_SELF']?>" class="simple-text logo-normal">
        Admin Panel
      </a></div>
      <div id="sidebar" class="sidebar-wrapper">
        <ul class="nav">
          <li id="dashboard" class="nav-item active ">
            <a class="nav-link" href="">
              <i class="material-icons">content_paste</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li id="userlist" class="nav-item">
            <a class="nav-link" href="">
              <i class="material-icons">content_paste</i>
              <p>User Management</p>
            </a>
          </li>
         <!--  <li id="addnewuser" class="nav-item ">
            <a class="nav-link" href="">
              <i class="material-icons">content_paste</i>
              <p>Add New User</p>
            </a>
          </li> -->
           <li id="product" class="nav-item">
            <a class="nav-link" href="">
              <i class="material-icons">content_paste</i>
              <p>Product Management</p>
            </a>
          </li>
          <li id="categories" class="nav-item ">
            <a class="nav-link" href="">
              <i class="material-icons">content_paste</i>
              <p>Categories Mangement</p>
            </a>
          </li>
        </ul>
      </div>
    </div>