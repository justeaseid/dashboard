<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Most Mentioned By</h3>
        <div class="box-tools pull-right">
            <span class="label label-primary"><?php echo $type; ?></span>
<!--            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
        </div>
    </div><!-- /.box-header -->
    <div class="box-body no-padding">
        <ul class="users-list clearfix">
            <?php
            if ($active_account1->num_rows() > 0) {
                $i = 0;
                foreach ($active_account1->result_array() as $row) {
                    echo "<li>";
                    echo "<img src='" . $row["mn_image"] . "' alt='User Image' title='" . $row["mn_from"] . "'>";
                    echo "<a class='users-list-name' href='" . TWITTER . $row["mn_from"] . "' target='_blank'>@" . $row["mn_from"] . "</a>";
                    echo "<span class='label label-warning'>"
                    . "<a href='" . TWITTER . $row["mn_from"] . "/status/" . $row["mn_id"] . "' target='_blank'>"
                    . "<font color='#ffffff'>mention"
                    . "</font>"
                    . "</a>"
                    . "</span>";
                    echo "</li>";
                }
            } else {
                echo "<i><b>NO RESULT</b></i>";
            }
            ?>

            <!--            <li>
                            <img src='' alt='User Image' title=''>
                            <a class='users-list-name' href=''></a>
                            <span class='label label-primary'><a href=''>comment</a></span>
                        </li>-->

            <!--            <li>
                            <img src="https://graph.facebook.com/v2.5/10205133295044215/picture?fields=url&access_token=1698916253663424%7C68QcCzUbs46JgUx0UD7I3N_wsuY" alt="User Image" title="Alexander Pierce">
                            <a class="users-list-name" href="#">Alexander Pierce</a>
                            <span class='label label-primary'>comment</span>
                        </li>-->
        </ul><!-- /.users-list -->
    </div><!-- /.box-body -->
</div>