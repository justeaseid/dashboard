<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>justease | Log in</title>

        <link rel="shortcut icon" href="<?php echo LOGO_SINGLE; ?>" />
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo BOOTSTRAP_CSS; ?>/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo DIST_CSS; ?>/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo PLUGINS; ?>/iCheck/square/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <img src="<?php echo LOGO_FULL; ?>" height="50" width="225" alt="justease">
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg"><?php echo $status; ?></p>
                <form action="<?php echo base_url('/apps/login') ?>" method="post">
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $password; ?>">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <a href="<?php echo base_url('/apps/reset'); ?>">Forgot Password?</a> 
                                <!--<a href="<?php echo base_url('/apps/register'); ?>" class="text-center">Sign Up</a>-->

                                <!--                                <label>
                                                                    <input type="checkbox"> Remember Me
                                                                </label>-->
                            </div>
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div><!-- /.col -->
                    </div>
                </form>

<!--                <a href="<?php echo base_url('/apps/reset'); ?>">Forgot Password?</a> /
                <a href="<?php echo base_url('/apps/register'); ?>" class="text-center">Sign Up</a>-->

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        <script src="<?php echo PLUGINS; ?>/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="<?php echo BOOTSTRAP_JS; ?>/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="<?php echo PLUGINS; ?>/iCheck/icheck.min.js"></script>
        <script src="<?php echo GENERAL_JS; ?>/checker.js"></script>
    </body>
</html>