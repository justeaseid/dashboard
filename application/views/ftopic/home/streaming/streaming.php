<div class="box box-primary direct-chat direct-chat-success" >
    <div class="box-header with-border">
        <h3 class="box-title">Streaming</h3>
        <div class="box-tools pull-right">
            <span class="label label-primary">Now</span>
<!--            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages" style="height:1150px;">
            <?php
            if ($streaming->num_rows() > 0) {
                $i = 0;
                foreach ($streaming->result_array() as $row) {
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
                    } else {
                        $label = "label-primary";
                    }

                    $pattern = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";
                    $message = preg_replace($pattern, "<i>LINK</i>", $row["ps_message"]);
                    echo "<div class='direct-chat-text'>" . $message . "  <span class='label $label'>$type</span></div>";
//                    echo "<div class='direct-chat-text'><span class='fa fa-twitter'></span>  " . $message . "  <span class='label $label'>$type</span></div>";
                    echo "</div>";
                    echo "</a>";
                }
            }
            ?>
        </div>

    </div><!-- /.box-body -->

</div><!--/.direct-chat -->