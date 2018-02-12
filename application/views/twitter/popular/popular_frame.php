<div class="box box-primary direct-chat direct-chat-success" >
    <div class="box-header with-border">
        <h3 class="box-title">Popular</h3>
        <div class="box-tools pull-right">
            <span class="label label-success">tweet</span>
<!--            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages" style="height: 750px;">
            <?php
            if ($popular->num_rows() > 0) {
                $i = 0;
                foreach ($popular->result_array() as $row) {
                    echo "<a href='" . TWITTER . $row["name"]. "/status/". $row["id"] . "' target='_blank'>";
                    echo "<div class='direct-chat-msg'>";
                    echo "<div class='direct-chat-info clearfix'>";
                    echo "<span class='direct-chat-name pull-left'>@" . $row["name"] . "</span>";
                    echo "<span class='direct-chat-timestamp pull-right'>" . date("d F Y h:i:s A", strtotime($row["date"])) . "</span>";
                    echo "</div>";
                    echo "<img class='direct-chat-img' src='" . $row["image"] . "' alt='message user image'>";
                    $message = $row["message"];
                    if ($message == "NULL")
                        $message = ".";
                    echo "<div class='direct-chat-text'>" . $message . "</div>";
                    echo "<div style='padding-left: 50px;'><span class='label label-success'>tweet</span>   "
                    . "<div class='fa fa-heart margin-r-5'>  " . $row["likes"] . "</div>   "
                    . "<div class='fa fa-retweet margin-r-5'>  " . $row["shares"] . "</div>   "
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