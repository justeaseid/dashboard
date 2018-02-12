<div class="box box-primary">
    <div class="box-body">
        <!-- define all chart -->
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Account</th>
                    <th>Message</th>
                    <th>Retweeted By</th>
                    <!--<th>Date</th>-->
                    <th>Retweet Count</th>
                    <th>Favorite Count</th>
                    <!--<th>Comment</th>-->
                    <th>Go to</th>
                </tr>
            </thead>
            <tbody>
                <!-- table content -->
                <?php
                if ($json_result->num_rows() > 0) {
                    $i = 0;
                    foreach ($json_result->result_array() as $row) {
                        echo "<tr>";
                        echo "<td><b>@" . $row['name'] . "</b></td>";
                        $message = preg_replace('/[^A-Z a-z 0-9 \!\?\@\%\&\(\)\:\\\,\-\#\$\.]/', '', $row['rt_text']);
                        echo "<td>" . $message . "</td>";
                        echo "<td><b>@" . $row['rt_from'] . "</b></td>";
//                        echo "<td>" . date("d F Y", strtotime($row['ps_created_time'])) . "</td>";
                        echo "<td><div class='fa fa-retweet'> " . $row['rt_retweet'] . "</div></td>";
                        echo "<td><div class='fa fa-heart'> " . $row['rt_favorite'] . "</td>";
//                        $surl = base_url('/twitter/vcomment/' . $url . '/1/' . $row["ps_id"]);
//                        echo '<td><a class="btn btn-primary fa fa-comment" href="' . $surl . '"></a></td>';
                        $url = TWITTER . $row["rt_from"] . "/status/" . $row["rt_id"];
                        echo '<td><a class="btn btn-primary fa fa-twitter" href="' . $url . '" target="_blank"></a></td>';
                        echo "</tr>";
                        $i++;
                    }
                }
                ?>
                <!-- EOT -->
            </tbody>
            <tfoot>
                <tr>
                    <th>Account</th>
                    <th>Message</th>
                    <th>Retweeted By</th>
                    <!--<th>Date</th>-->
                    <th>Retweet Count</th>
                    <th>Favorite Count</th>
                    <!--<th>Comment</th>-->
                    <th>Go to</th>
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div>

<script>
    //2014-02-10 - 2015-08-20
    function view(user_id, tweet_id) {
        window.open("<?php echo TWITTER ?>/" + user_id + "/status/" + tweet_id, '_blank');
    }

    function view_comment(post_id) {
        top.location = "<?php echo base_url('/twitter/view_comment/' . $url . '/1') ?>/" + post_id;
    }


</script>
