<!DOCTYPE html>

<html>
    <head>
        <!-- This is layout / template for big data application -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Asosiantale | Facebook Post</title>

        <link rel="shortcut icon" href="<?php echo ICON; ?>" />
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo BOOTSTRAP; ?>/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?php echo PLUGINS; ?>/datatables/dataTables.bootstrap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo DIST_CSS; ?>/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo DIST_CSS; ?>/skins/_all-skins.min.css">
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
            <!-- wrapper class -->
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

            <!-- wrapper content -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <?php $this->load->view('layout/title/facebook/title_post'); ?>
                </section>
                <!-- warapper content -->
                <section class="content">
                    <!-- Main row -->
                    <div class="row">
                        <!-- load area chart in large mode -->
                        <div class="col-md-12">
                            <!-- FB Search Result -->
                            <?php $this->load->view('facebook/post/post_frame'); ?>
                            
                        </div><!-- /.col (LEFT) -->
                    </div>
                </section>
            </div>
            <!-- /.content-wrapper -->
            <!-- load footer view -->
            <?php $this->load->view('layout/footer/footer'); ?>
            <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
            <!--<div class="control-sidebar-bg"></div>-->
        </div>
        <!-- ./wrapper -->
        <!-- jQuery 2.1.4 -->
        <script src="<?php echo PLUGINS; ?>/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="<?php echo BOOTSTRAP_JS; ?>/bootstrap.min.js"></script>
        <!-- DataTables -->
        <script src="<?php echo PLUGINS; ?>/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo PLUGINS; ?>/datatables/dataTables.bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="<?php echo PLUGINS; ?>/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="<?php echo PLUGINS; ?>/fastclick/fastclick.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo DIST_JS; ?>/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo DIST_JS; ?>/demo.js"></script>
        <!-- page script -->
        <script>
            $(function () {
                $("#example1").DataTable();
            });
        </script>
    </body>
</html>
