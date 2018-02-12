<div class="box box-widget widget-user">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-blue">
        <h3 class="widget-user-username"><?php echo $acc_name1;?></h3>
        <h5 class="widget-user-desc"><?php echo $acc_screen_name1;?></h5>
    </div>
    <div class="widget-user-image">
        <img class="img-circle" src="<?php echo $acc_image1;?>" alt="User Avatar">
    </div>
    <div class="box-footer">
        <div class="row">
            <div class="col-sm-4 border-right">
                <div class="description-block">
                    <h5 class="description-header"><div class='fa fa-twitter'> <?php echo $acc_tweets1;?></div></h5>
                </div><!-- /.description-block -->
            </div><!-- /.col -->
            <div class="col-sm-4 border-right">
                <div class="description-block">
                    <h5 class="description-header"><div class='fa fa-user-plus'> <?php echo $acc_followers1;?></div></h5>
                </div><!-- /.description-block -->
            </div><!-- /.col -->
            <div class="col-sm-4">
                <div class="description-block">
                    <h5 class="description-header"><div class='fa fa-users'> <?php echo $acc_friends1;?></div></h5>
                </div><!-- /.description-block -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>