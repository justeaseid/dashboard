<!-- sidebar widget -->
<ul class="sidebar-menu">

    <li class="header">MAIN NAVIGATION</li>
    <li>
        <a href="<?php echo base_url('apps/home/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-home"></i> <span>Home</span>
        </a>
    </li>

    <!-- Analytics Apps sidebar -->
    <!-- Get class header on Analytic Apps  -->
    <li class="header">INSTAGRAM ANALYSIS</li>
    <li>
        <a href="<?php echo base_url('instagram/home/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-camera"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Page Management</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url('/instagram/index_search/' . $url . '/' . $id_user); ?>"><i class="fa fa-search"></i> Instagram Search</a></li>
            <li><a href="<?php echo base_url('/instagram/page/' . $url . '/' . $id_user); ?>"><i class="fa fa-th"></i> Instagram Page</a></li>
            <!--<li><a href="<?php echo base_url('/instagram/crawler/' . $url . '/' . $id_user); ?>"><i class="fa fa-cogs"></i> Crawler</a></li>-->
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
    <li>
        <a href="<?php echo base_url('/instagram/monitoring/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-desktop"></i> <span>Monitoring</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('/icompare/comparison/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-cubes"></i> <span>Compare</span>
        </a>
    </li>

    <!-- twitter analysis widget -->
    <li class="header">TWITTER ANALYSIS</li>
    <li>
        <a href="<?php echo base_url('twitter/home/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-twitter"></i> <span>Twitter Dashboard</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i>
            <span>Account Management</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url('/twitter/index_search/' . $url . '/' . $id_user); ?>"><i class="fa fa-search"></i> Twitter Search</a></li>
            <li><a href="<?php echo base_url('/twitter/account/' . $url . '/' . $id_user); ?>"><i class="fa fa-th"></i> Twitter Account</a></li>
            <!--<li><a href="<?php echo base_url('/twitter/crawler/' . $url . '/' . $id_user); ?>"><i class="fa fa-gear"></i> Crawler</a></li>-->
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
    <li>
        <a href="<?php echo base_url('/twitter/monitoring/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-laptop"></i> <span>Monitoring</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('/tcompare/comparison/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-cubes"></i> <span>Compare</span>
        </a>
    </li>


    <!-- Analytics Apps sidebar -->
    <!-- Get class header on Analytic Apps  -->
    <li class="header">FACEBOOK ANALYSIS</li>
    <li>
        <a href="<?php echo base_url('facebook/home/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-facebook"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Page Management</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url('/facebook/index_search/' . $url . '/' . $id_user); ?>"><i class="fa fa-search"></i> Facebook Search</a></li>
            <li><a href="<?php echo base_url('/facebook/page/' . $url . '/' . $id_user); ?>"><i class="fa fa-th"></i> Facebook Page</a></li>
            <!--<li><a href="<?php echo base_url('/facebook/crawler/' . $url . '/' . $id_user); ?>"><i class="fa fa-cogs"></i> Crawler</a></li>-->
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
    <li>
        <a href="<?php echo base_url('/facebook/monitoring/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-desktop"></i> <span>Monitoring</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('/compare/comparison/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-cubes"></i> <span>Compare</span>
        </a>
    </li>



</ul>