<div class="col-md-3">

    <!-- Profile Image -->
    <div class="box box-primary">
        <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="<?php echo $acc_image;?>" alt="<?php echo $acc_name;?>">
            <!--<img class="profile-user-img img-responsive img-circle" src="https://graph.facebook.com/v2.5/5863091683/picture?type=normal&fields=url&access_token=439288276256553%7C1N79oU5HUNV7g2fraZ4emqgGpx8" alt="<?php echo $acc_name;?>">-->
            <h3 class="profile-username text-center"><?php echo $acc_name;?></h3>
            <p class="text-muted text-center"><?php echo $acc_screen;?></p>

            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>Tweets</b> <a class="pull-right"><?php echo $acc_tweets;?></a>
                </li>
                <li class="list-group-item">
                    <b>Followers</b> <a class="pull-right"><?php echo $acc_followers;?></a>
                </li>
                <li class="list-group-item">
                    <b>Friends</b> <a class="pull-right"><?php echo $acc_friends;?></a>
                </li>
            </ul>

            <a href="<?php echo $acc_link;?>" class="btn btn-primary btn-block" target="_blank"><b>Go to Account</b></a>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <!-- About Me Box -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Page Detail</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <strong><i class="fa fa-globe margin-r-5"></i>  Website</strong>
            <p class="text-muted">
                <a href="<?php echo $acc_website;?>" target="_blank"><?php echo $acc_website;?></a>
            </p>

            <hr>

            <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
            <p class="text-muted"><?php echo $acc_location;?></p>

            <hr>

            <strong><i class="fa fa-info-circle margin-r-5"></i> Description</strong>
            <p><?php echo $acc_description;?></p>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!-- /.col -->