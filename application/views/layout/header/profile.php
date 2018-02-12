<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <?php
//            echo $access;

            if ($access == "admin") {
                echo '<li class="dropdown user user-menu notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="' . APPS_ICON . '" class="user-image" alt="Apps Image">
                    <span class="hidden-xs">Application</span>
                </a>
                <!--<ul class="dropdown-menu" style="width: 200px; height: 150px;">-->
                <ul class="dropdown-menu" style="width: 200px; height: 180px;">
                    <li> 
                        <ul class="menu">
                            <li>
                                <a class = "fa fa-database" href="' . base_url("/apps/monitor/" . $url. '/' . $id_user) . '">
                                    &nbsp;&nbsp;Data Management
                                </a>
                            </li>
                            <li>
                                <a class = "fa fa-bar-chart" href="' . base_url("/apps/home/" . $url. '/' . $id_user) . '">
                                    &nbsp;&nbsp;Media Monitoring
                                </a>
                            </li>
                            <li>
                                <a class = "fa fa-facebook" href="' . base_url("/ftopic/home/" . $url. '/' . $id_user) . '">
                                    &nbsp;&nbsp;Facebook - Topic Analysis
                                </a>
                            </li>
                            <li>
                                <a class = "fa fa-twitter" href="' . base_url("/ttopic/home/" . $url. '/' . $id_user) . '">
                                    &nbsp;&nbsp;Twitter - Topic Analysis
                                </a>
                            </li>
                            <li>
                                <a class = "fa fa-instagram" href="' . base_url("/itopic/home/" . $url. '/' . $id_user) . '">
                                    &nbsp;&nbsp;Instagram - Topic Analysis
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>';
            }else{
                echo '<li class="dropdown user user-menu notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="' . APPS_ICON . '" class="user-image" alt="Apps Image">
                    <span class="hidden-xs">Application</span>
                </a>
                <!--<ul class="dropdown-menu" style="width: 200px; height: 150px;">-->
                <ul class="dropdown-menu" style="width: 200px; height: 150px;">
                    <li> 
                        <ul class="menu">
                            <li>
                                <a class = "fa fa-bar-chart" href="' . base_url("/apps/monitor/" . $url. '/' . $id_user) . '">
                                    &nbsp;&nbsp;Media Monitoring
                                </a>
                            </li>
                             <li>
                                <a class = "fa fa-facebook" href="' . base_url("/ftopic/home/" . $url. '/' . $id_user) . '">
                                    &nbsp;&nbsp;Facebook - Topic Analysis
                                </a>
                            </li>
                            <li>
                                <a class = "fa fa-twitter" href="' . base_url("/ttopic/home/" . $url. '/' . $id_user) . '">
                                    &nbsp;&nbsp;Twitter - Topic Analysis
                                </a>
                            </li>
                            <li>
                                <a class = "fa fa-instagram" href="' . base_url("/itopic/home/" . $url. '/' . $id_user) . '">
                                    &nbsp;&nbsp;Instagram - Topic Analysis
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>';
            }
            ?>

            <li class="dropdown user user-menu notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo USER_ICON; ?>" class="user-image" alt="User Image">
                    <span class="hidden-xs"><?php echo $name; ?></span>
                </a>
                <ul class="dropdown-menu" style="width: 200px; height: 80px;">
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            <li>
                                <a class = "fa fa-user" href="<?php echo base_url('/apps/profile/' . $url. '/' . $id_user); ?>">
                                    &nbsp;&nbsp;Profile
                                </a>
                            </li>
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