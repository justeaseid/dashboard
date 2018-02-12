<!-- sidebar widget -->
<ul class="sidebar-menu">
    <!-- Main navigation -->
    <li class="header">MAIN NAVIGATION</li>
    <li>
        <a href="<?php echo base_url('/apps/monitor/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-server"></i> <span>Server Monitoring</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('/apps/user/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-user-plus"></i> <span>User Management</span>
        </a>
    </li>

    <!-- instagram widget defined here -->
    <li class="header">INSTAGRAM DATA MANAGEMENT</li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Page Management</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url('/instagram/index_search/' . $url . '/' . $id_user); ?>"><i class="fa fa-search"></i> Instagram Search</a></li>
            <li><a href="<?php echo base_url('/instagram/page/' . $url . '/' . $id_user); ?>"><i class="fa fa-th"></i> Instagram Page</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-cog"></i>
            <span>Crawler Management</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url('/instagram/token/' . $url . '/' . $id_user); ?>"><i class="fa fa-key"></i> Token</a></li>
            <li><a href="<?php echo base_url('/instagram/crawler/' . $url . '/' . $id_user); ?>"><i class="fa fa-cogs"></i> Crawler</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-instagram"></i>
            <span>Posts & Comments</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url('/instagram/post/' . $url . '/' . $id_user); ?>"><i class="fa fa-pencil-square"></i> Posts</a></li>
            <li><a href="<?php echo base_url('/instagram/comment/' . $url . '/' . $id_user); ?>"><i class="fa fa-comment"></i> Comments</a></li>
        </ul>
    </li>

    <!-- widget for twitter apps defined here -->
    <li class="header">TWITTER DATA MANAGEMENT</li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i>
            <span>Account Management</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url('/twitter/index_search/' . $url . '/' . $id_user); ?>"><i class="fa fa-search"></i> Twitter Search</a></li>
            <li><a href="<?php echo base_url('/twitter/account/' . $url . '/' . $id_user); ?>"><i class="fa fa-th"></i> Twitter Account</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-gears"></i>
            <span>Crawler Management</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url('/twitter/token/' . $url . '/' . $id_user); ?>"><i class="fa fa-key"></i> Token</a></li>
            <li><a href="<?php echo base_url('/twitter/crawler/' . $url . '/' . $id_user); ?>"><i class="fa fa-gear"></i> Crawler</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-twitter-square"></i>
            <span>Tweet & Re-Tweet</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url('/twitter/tweet/' . $url . '/' . $id_user); ?>"><i class="fa fa-pencil-square"></i> Tweet</a></li>
            <li><a href="<?php echo base_url('/twitter/retweet/' . $url . '/' . $id_user); ?>"><i class="fa fa-retweet"></i> Re-Tweet</a></li>
            <li><a href="<?php echo base_url('/twitter/mention/' . $url . '/' . $id_user); ?>"><i class="fa fa-reply-all"></i> Mention</a></li>
        </ul>
    </li>

    <!-- widge for facebook defined here -->
    <li class="header">FACEBOOK DATA MANAGEMENT</li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Page Management</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url('/facebook/index_search/' . $url . '/' . $id_user); ?>"><i class="fa fa-search"></i> Facebook Search</a></li>
            <li><a href="<?php echo base_url('/facebook/page/' . $url . '/' . $id_user); ?>"><i class="fa fa-th"></i> Facebook Page</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-cog"></i>
            <span>Crawler Management</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url('/facebook/token/' . $url . '/' . $id_user); ?>"><i class="fa fa-key"></i> Token</a></li>
            <li><a href="<?php echo base_url('/facebook/crawler/' . $url . '/' . $id_user); ?>"><i class="fa fa-cogs"></i> Crawler</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-facebook-official"></i>
            <span>Posts & Comments</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url('/facebook/post/' . $url . '/' . $id_user); ?>"><i class="fa fa-pencil-square"></i> Posts</a></li>
            <li><a href="<?php echo base_url('/facebook/comment/' . $url . '/' . $id_user); ?>"><i class="fa fa-comment"></i> Comments</a></li>
            <li><a href="<?php echo base_url('/facebook/scomment/' . $url . '/' . $id_user); ?>"><i class="fa fa-comments"></i> Sub Comments</a></li>
        </ul>
    </li>

</ul>