    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <form class="navbar-form mr-4">
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="Search...">
                            <button type="button" class="btn btn-white btn-round btn-just-icon">
                                <i class="material-icons">search</i>
                                <div class="ripple-container"></div>
                            </button>
                        </div>
                    </form>

                    <ul class="navbar-nav ml-4 mr-2">
                        <li id="showopt" class="nav-item dropdown show" style="cursor: pointer;">
                            <i class="material-icons">person</i>
                            <p class="d-lg-none d-md-block">
                                Account
                            </p>
                        </a>
                        <div id="opt" class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" id="profile" data-id="<?php echo $_SESSION['uid'];?>">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../config/logout.php">Log out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script type="text/javascript">
        jQuery(document).ready(function(){
            var optStatus = false;
            jQuery('#showopt').click(function(){
             //alert("ok");
             if(optStatus){
                 jQuery('#opt').removeClass('show');
                 optStatus = false;
             }else{
                jQuery('#opt').css('display','none').addClass('show');
                optStatus = true;
            }
        });

        jQuery('#profile').click(function(){
            const id = jQuery(this).attr('data-id');
            // alert(id);
            jQuery('#container').empty().load('user.php?id='+id);
        });

        });
    </script>
    <!-- End Navbar -->
</div>