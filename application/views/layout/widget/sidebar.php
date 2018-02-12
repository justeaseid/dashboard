<!-- sidebar widget -->
<ul class="sidebar-menu">
    <!-- widget apps for media analysis defined here -->
    <li class="header">MAIN NAVIGATION</li>
    <li>
        <a href="<?php echo base_url('/home/analysis/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-home"></i> <span>Home</span>
        </a>
    </li>
    <li class="header">DATA MANAGEMENT</li>
    <li>
        <a href="<?php echo base_url('user/data/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-user"></i> <span>User</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('level/data/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-navicon"></i> <span>User Level</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('article/data/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-file-text-o"></i> <span>Article</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('category/data/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-tag"></i> <span>Article Category</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('payment/data/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-money"></i> <span>Payment</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('operational/data/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-link"></i> <span>Operational Cost</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('campaign/data/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-bullhorn"></i> <span>Campaign</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('tag/data/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-asterisk"></i> <span>Tag</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('donation/data/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-life-ring"></i> <span>Donation</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('lawyer/data/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-balance-scale"></i> <span>Lawyer</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('report/data/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-ban"></i> <span>Report</span>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url('log/data/' . $url . '/' . $id_user); ?>">
            <i class="fa fa-book"></i> <span>Log</span>
        </a>
    </li>
</ul>