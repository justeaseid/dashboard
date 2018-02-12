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
                    $id = $row["id"];
                    $name = $row["name"];
                    $msg = $row["message"];
                    $date = $row["date"];
                    $image = $row["image"];
                    $type = $row["type"];
                    $source = $row["source"];
                    $url = "";
                    $socmed = "";
                    $screen_name = "";

                    if ($source == "twitter") {
                        $url = TWITTER . $name . "/status/" . $id;
                        $socmed = "fa-twitter";
                        $screen_name = "@$name";
                    } else if ($source == "facebook") {
                        $url = FACEBOOK . $id;
                        $socmed = "fa-facebook";
                        $screen_name = "$name";
                    } else if ($source == "instagram") {
                        $url = INS_PAGE . $id;
                        $socmed = "fa-instagram";
                        $screen_name = "$name";
                    }

                    echo "<a href='" . $url . "' target='_blank'>";
                    echo "<div class='direct-chat-msg'>";
                    echo "<div class='direct-chat-info clearfix'>";
                    echo "<span class='direct-chat-name pull-left'>" . $screen_name . "</span>";
                    echo "<span class='direct-chat-timestamp pull-right'>" . date("d F Y h:i:s A", strtotime($date)) . "</span>";
                    echo "</div>";
                    echo "<img class='direct-chat-img' src='" . $image . "' alt='message user image'>";

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
                    } else if ($type == "tweet") {
                        $label = "label-third";
                    }
                    // id, name, date, image, type, message
                    $pattern = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";
                    $message = preg_replace($pattern, "<i>LINK</i>", $msg);
//                    echo "<div class='direct-chat-text'>" . $message . "  <span class='label $label'>$type</span></div>";
                    echo "<div class='direct-chat-text'><span class='fa $socmed'></span>  " . $message . "  <span class='label $label'>$type</span></div>";
                    echo "</div>";
                    echo "</a>";
                }
            }
            ?>
        </div>

    </div><!-- /.box-body -->

</div><!--/.direct-chat -->