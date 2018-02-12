<div class="col-md-3">

    <!-- Profile Image -->
    <div class="box box-primary">
        <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="<?php echo $pg_image;?>" alt="<?php echo $pg_name;?>">
            <!--<img class="profile-user-img img-responsive img-circle" src="https://graph.facebook.com/v2.5/5863091683/picture?type=normal&fields=url&access_token=439288276256553%7C1N79oU5HUNV7g2fraZ4emqgGpx8" alt="<?php echo $pg_name;?>">-->
            <h3 class="profile-username text-center"><?php echo $pg_name;?></h3>
            <p class="text-muted text-center"><?php echo $pg_category;?></p>

            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>Likes</b> <a class="pull-right"><?php echo $pg_likes;?></a>
                </li>
                <li class="list-group-item">
                    <b>Talking About</b> <a class="pull-right"><?php echo $pg_talking_about_count;?></a>
                </li>
                <li class="list-group-item">
                    <b>Checkins</b> <a class="pull-right"><?php echo $pg_checkins;?></a>
                </li>
            </ul>

            <a href="<?php echo $pg_link;?>" class="btn btn-primary btn-block" target="_blank"><b>Go to Page</b></a>
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
                <a href="<?php echo "http://".$pg_website;?>" target="_blank"><?php echo $pg_website;?></a>
            </p>

            <hr>

            <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
            <p class="text-muted"><?php echo $pg_location;?></p>

            <hr>

            <strong><i class="fa fa-info-circle margin-r-5"></i> Description</strong>
            <p><?php echo $pg_description;?></p>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!-- /.col -->