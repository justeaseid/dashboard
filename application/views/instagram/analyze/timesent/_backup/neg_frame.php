<div class="box box-danger direct-chat direct-chat-success" >
    <div class="box-header with-border">
        <h3 class="box-title">Negative</h3>
        <div class="box-tools pull-right">
            <span class="label label-danger">Now</span>
<!--            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages" style="height: 400px;">
            <?php
            if ($negative->num_rows() > 0) {
                $i = 0;
                foreach ($negative->result_array() as $row) {
                    echo "<a href='" . FACEBOOK . $row["cm_id"] . "' target='_blank'>";
                    echo "<div class='direct-chat-msg'>";
                    echo "<div class='direct-chat-info clearfix'>";
                    echo "<span class='direct-chat-name pull-left'>" . $row["cm_from"] . "</span>";
                    echo "<span class='direct-chat-timestamp pull-right'>" . date("d F Y h:i:s A", strtotime($row["cm_created_time"])+25200) . "</span>";
                    echo "</div>";
                    echo "<img class='direct-chat-img' src='" . $row["cm_image"] . "' alt='message user image'>";
                    $type = $row["cm_sentiment"];
                    $sentiment ="";
                    $label = "";
                    if ($type == "-1") {
                        $label = "label-danger";
                        $sentiment = "negative";
                    } else if ($type == "1") {
                        $label = "label-success";
                        $sentiment = "positive";
                    } else if ($type == "0") {
                        $label = "label-secondary";
                        $sentiment = "neutral";
                    } else {
                        $label = "label-third";
                    }
                    $message = $row["cm_message"];
                    $pattern = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";
                    $message = preg_replace($pattern, "<i>LINK</i>", $message);
                    if (($message == "NULL")||($message == ""))
                        $message = ".";
                    echo "<div class='direct-chat-text'>" . $message . "</div>";
                    echo "<div style='padding-left: 50px;'><span class='label $label'>$sentiment</span>  "
                    . "<div class='fa fa-thumbs-up margin-r-5'>  " . $row["cm_likes"] . "</div>   "
                    . "<div class='fa fa-comments margin-r-5'>  " . $row["cm_comment_count"] . "</div>   "
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