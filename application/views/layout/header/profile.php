<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            
            <li class="dropdown user user-menu notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo USER_ICON; ?>" class="user-image" alt="User Image">
                    <span class="hidden-xs"><?php echo $name; ?></span>
                </a>
                <!--<ul class="dropdown-menu" style="width: 200px; height: 80px;">-->
                <ul class="dropdown-menu" style="width: 200px; height: 40px;">
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
<!--                            <li>
                                <a class = "fa fa-user" href="<?php // echo base_url('/apps/profile/' . $url. '/' . $id_user); ?>">
                                    &nbsp;&nbsp;Profile
                                </a>
                            </li>-->
                            <li>
                                <a class = "fa fa-sign-out" href="<?php echo base_url('/apps/logout/' . $email); ?>">
                                    &nbsp;&nbsp;Sign Out
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>