<!-- sidebar widget -->
<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li>
        <a href="<?php echo base_url('apps/home/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-home"></i> <span>Home</span>
        </a>
    </li>
    
    <!-- widget apps for media monitoring defined here -->
    <li class="header">MEDIA MONITORING</li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url('instagram/home/' . $url . '/' . $id_user); ?>"><i class="fa fa-instagram"></i> Instagram</a></li>
            <li><a href="<?php echo base_url('twitter/home/' . $url . '/' . $id_user); ?>"><i class="fa fa-twitter"></i> Twitter</a></li>
            <li><a href="<?php echo base_url('facebook/home/' . $url . '/' . $id_user); ?>"><i class="fa fa-facebook"></i> Facebook</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-desktop"></i>
            <span>Monitoring</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url('/instagram/monitoring/' . $url . '/' . $id_user); ?>"><i class="fa fa-instagram"></i> Instagram</a></li>
            <li><a href="<?php echo base_url('/twitter/monitoring/' . $url . '/' . $id_user); ?>"><i class="fa fa-twitter"></i> Twitter</a></li>
            <li><a href="<?php echo base_url('/facebook/monitoring/' . $url . '/' . $id_user); ?>"><i class="fa fa-facebook"></i> Facebook</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-cubes"></i>
            <span>Compare</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url('/icompare/comparison/' . $url . '/' . $id_user); ?>"><i class="fa fa-instagram"></i> Instagram</a></li>
            <li><a href="<?php echo base_url('/tcompare/comparison/' . $url . '/' . $id_user); ?>"><i class="fa fa-twitter"></i> Twitter</a></li>
            <li><a href="<?php echo base_url('/compare/comparison/' . $url . '/' . $id_user); ?>"><i class="fa fa-facebook"></i> Facebook</a></li>
        </ul>
    </li>

</ul>