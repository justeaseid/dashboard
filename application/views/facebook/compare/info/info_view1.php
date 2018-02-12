<div class="box box-widget widget-user">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-blue">
        <h3 class="widget-user-username"><?php echo $pg_name1;?></h3>
        <h5 class="widget-user-desc"><?php echo $pg_category1;?></h5>
    </div>
    <div class="widget-user-image">
        <img class="img-circle" src="<?php echo $pg_image1;?>" alt="User Avatar">
    </div>
    <div class="box-footer">
        <div class="row">
            <div class="col-sm-4 border-right">
                <div class="description-block">
                    <h5 class="description-header"><div class='fa fa-comments'> <?php echo $pg_talking_about_count1;?></div></h5>
                </div><!-- /.description-block -->
            </div><!-- /.col -->
            <div class="col-sm-4 border-right">
                <div class="description-block">
                    <h5 class="description-header"><div class='fa fa-thumbs-up'> <?php echo $pg_likes1;?></div></h5>
                </div><!-- /.description-block -->
            </div><!-- /.col -->
            <div class="col-sm-4">
                <div class="description-block">
                    <h5 class="description-header"><div class='fa fa-map-marker'> <?php echo $pg_checkins1;?></div></h5>
                </div><!-- /.description-block -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>