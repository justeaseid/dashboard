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
                    echo "<a href='" . TWITTER . $row["mn_from"]. "/status/". $row["mn_id"] . "' target='_blank'>";
                    echo "<div class='direct-chat-msg'>";
                    echo "<div class='direct-chat-info clearfix'>";
                    echo "<span class='direct-chat-name pull-left'>@" . $row["mn_from"] . "</span>";
                    echo "<span class='direct-chat-timestamp pull-right'>" . date("d F Y h:i:s A", strtotime($row["mn_created_time"])) . "</span>";
                    echo "</div>";
                    echo "<img class='direct-chat-img' src='" . $row["mn_image"] . "' alt='message user image'>";
                    $type = $row["mn_sentiment"];
                    $sentiment = "";
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
                    $message = $row["mn_text"];
                    $pattern = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";
                    $message = preg_replace($pattern, "<i>LINK</i>", $message);
                    if (($message == "NULL") || ($message == ""))
                        $message = ".";
                    echo "<div class='direct-chat-text'>" . $message . "</div>";
                    echo "</a>";

                    echo "<div style='padding-left: 50px;padding-top: 5px;'> "
                    . "<select class='form-control select2' style='width: 110px;' name='neg" . $i . "' id='neg" . $i . "' onchange='change_negative(" . $i . ",\"" . $row['mn_id'] . "\");'>
                            <option value='-1' selected='selected'> " . $sentiment . " </option>
                            <option value='1'>positive</option>
                            <option value='-1'>negative</option>
                            <option value='0'>neutral</option>
                        </select> "
                            
                    . "</div>";
                    echo "<div style='padding-left: 50px;padding-top: 5px;'> "
                    . "<div class='fa fa-heart margin-r-5'>  " . $row["mn_favorite"] . "</div>   "
                    . "<div class='fa fa-retweet margin-r-5'>  " . $row["mn_retweet"] . "</div>   "
                    . "</div>";
                    echo "</div>";
                    $i++;
                }
            }else {
                echo "<i><b>NO RESULT</b></i>";
            }
            ?>
        </div>

    </div><!-- /.box-body -->

</div><!--/.direct-chat -->

<script>
    //2014-02-10 - 2015-08-20
    function change_negative(idx, mn_id) {
        var sentiment = document.getElementById('neg' + String(idx)).value;
        top.location = "<?php echo base_url('/twitter/update_sentiment/' . $url . '/1/' . $page_id) ?>/" + mn_id + "/" + sentiment;
    }

</script>