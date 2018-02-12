<!DOCTYPE html>

<html>
    <head>
        <!-- This is layout / template for big data application -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Asosiantale | Add Token</title>

        <link rel="shortcut icon" href="<?php echo ICON; ?>" />

        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo BOOTSTRAP; ?>/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo DIST_CSS; ?>/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo DIST_CSS; ?>/skins/_all-skins.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo PLUGINS; ?>/iCheck/flat/blue.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="<?php echo PLUGINS; ?>/morris/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="<?php echo PLUGINS; ?>/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="<?php echo PLUGINS; ?>/datepicker/datepicker3.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?php echo PLUGINS; ?>/daterangepicker/daterangepicker-bs3.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="<?php echo PLUGINS; ?>/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <!-- general css -->    
        <link rel="stylesheet" href="<?php echo GENERAL; ?>/css/general.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <!-- all header main class -->
            <header class="main-header">
                <!-- Logo -->
                <?php $this->load->view('layout/header/logo'); ?>
                <!-- Header Navbar: style can be found in header.less -->
                <?php $this->load->view('layout/header/profile'); ?>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- /.search form -->
                    <?php
                    if ($access == "admin") {
                        $this->load->view('layout/widget/sidebar');
                    } else {
                        $this->load->view('layout/widget/sidebar_guest');
                    }
                    ?>
                    <!-- ./sidebar -->
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <?php $this->load->view('layout/title/facebook/title_add_token'); ?>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Main row -->
                    <div class="row">
                        <div class="col-md-12">
                            <?php $this->load->view('facebook/token/add_frame'); ?>
                        </div>
                    </div>

                </section>
            </div>
            <!-- /.content-wrapper -->
            <?php $this->load->view('layout/footer/footer'); ?>

            <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 2.1.4 -->
        <script src="<?php echo PLUGINS; ?>/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <!--<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>-->
        <script src="<?php echo DIST_JS; ?>/jquery-ui.min.js"></script>
        <script>
            function {(
                    var innnerHTML = inner.extend("indata", "outdata");
                    )};
        </script>

        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.5 -->
        <script src="<?php echo BOOTSTRAP_JS; ?>/bootstrap.min.js"></script>
        <!-- Morris.js charts -->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
        <script src="<?php echo DIST_JS; ?>/raphael-min.js"></script>
        <script src="<?php echo PLUGINS; ?>/morris/morris.min.js"></script>
        <!-- Sparkline -->
        <script src="<?php echo PLUGINS; ?>/sparkline/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="<?php echo PLUGINS; ?>/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php echo PLUGINS; ?>/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo PLUGINS; ?>/knob/jquery.knob.js"></script>
        <!-- daterangepicker -->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>-->
        <script src="<?php echo DIST_JS; ?>/moment-min.js"></script>
        <script src="<?php echo PLUGINS; ?>/daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="<?php echo PLUGINS; ?>/datepicker/bootstrap-datepicker.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo PLUGINS; ?>/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="<?php echo PLUGINS; ?>/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="<?php echo PLUGINS; ?>/fastclick/fastclick.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo DIST_JS; ?>/app.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo DIST_JS; ?>/pages/dashboard.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo DIST_JS; ?>/demo.js"></script>
        <!-- chart min js -->
        <script src="<?php echo PLUGINS; ?>/chartjs/Chart.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo DIST_JS; ?>/pages/dashboard2.js"></script>
        <!-- iCheck -->
        <script src="<?php echo PLUGINS; ?>/iCheck/icheck.min.js"></script>
        <script src="<?php echo GENERAL_JS; ?>/checker.js"></script>
    </body>
</html>
