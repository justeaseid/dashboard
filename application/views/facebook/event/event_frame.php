<div class="box box-primary direct-chat direct-chat-success" >
    <div class="box-header with-border">
        <h3 class="box-title">Events</h3>
        <div class="box-tools pull-right">
            <?php
            $type = strtolower($type);
            if ($type == "photo") {
                $label = "label-success";
            } else if ($type == "video") {
                $label = "label-danger";
            } else if ($type == "link") {
                $label = "label-warning";
            } else if ($type == "status") {
                $label = "label-info";
            } else if ($type == "offer") {
                $label = "label-primary";
            } else if ($type == "comment") {
                $label = "label-third";
            } else {
                $label = "label-secondary";
            }
            ?>
            <span class="label <?php echo $label?>"><?php echo $type; ?></span>
<!--            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages" style="height: 750px;">
            <?php
            if ($timeline->num_rows() > 0) {
                $i = 0;
                foreach ($timeline->result_array() as $row) {
                    echo "<a href='" . FACEBOOK . $row["ps_id"] . "' target='_blank'>";
                    echo "<div class='direct-chat-msg'>";
                    echo "<div class='direct-chat-info clearfix'>";
                    echo "<span class='direct-chat-name pull-left'>" . $row["ps_from"] . "</span>";
                    echo "<span class='direct-chat-timestamp pull-right'>" . date("d F Y h:i:s A", strtotime($row["ps_created_time"])+25200) . "</span>";
                    echo "</div>";
                    echo "<img class='direct-chat-img' src='" . $row["ps_image"] . "' alt='message user image'>";
                    $type = $row["ps_type"];
                    $label = "";
                    if ($type == "photo") {
                        $label = "label-success";
                    } else if ($type == "video") {
                        $label = "label-danger";
                    } else if ($type == "link") {
                        $label = "label-warning";
                    } else if ($type == "status") {
                        $label = "label-info";
                    } else if ($type == "offer") {
                        $label = "label-primary";
                    } else if ($type == "comment") {
                        $label = "label-third";
                    } else {
                        $label = "label-primary";
                    }
                    $message = $row["ps_message"];
                    if ($message == "NULL")
                        $message = ".";
                    echo "<div class='direct-chat-text'>" . $message . "</div>";
                    echo "<div style='padding-left: 50px;'><span class='label $label'>$type</span>  "
                    . "<div class='fa fa-thumbs-up margin-r-5'>  " . $row["ps_likes"] . "</div>   "
                    . "<div class='fa fa-mail-forward margin-r-5'>  " . $row["ps_shares"] . "</div>   "
                    . "</div>";
                    echo "</div>";
                    echo "</a>";
                }
            }else {
                echo "<i><b>NO RESULT</b></i>";
            }
            ?>
        </div>

    </div><!-- /.box-body -->

</div><!--/.direct-chat -->