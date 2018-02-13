<!DOCTYPE html>
<html>
    <head>
        <script src="<?php echo DIST_JS; ?>/google/google-analytics.js"></script>
        <?php $this->load->view('content/component/metatag'); ?>
        <?php $this->load->view('content/component/rel_header'); ?>
    </head>
    <body class="hold-transition skin-black sidebar-mini">
        <?php $this->load->view('content/component/gtm_frame'); ?>
        
        <div class="wrapper">
            <header class="main-header">
                <?php $this->load->view('layout/header/logo'); ?>
                <?php $this->load->view('layout/header/profile'); ?>
            </header>
            <aside class="main-sidebar">
                <section class="sidebar">
                    <?php $this->load->view('layout/widget/sidebar'); ?>
                </section>
            </aside>
            <!-- content wrapper -->
            <?php $this->load->view('content/component/form'); ?>
            
            <!-- load footer view -->
            <?php $this->load->view('layout/footer/footer'); ?>
            <div class="control-sidebar-bg"></div>
        </div>
        
        <?php $this->load->view('content/component/rel_footer'); ?>
    </body>
</html>
