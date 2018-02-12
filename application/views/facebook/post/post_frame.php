<div class="box box-primary">
    <div class="box-body">
        <!-- define all chart -->
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Post From</th>
                    <th>Post</th>
                    <!--<th>Date</th>-->
                    <th>Share Count</th>
                    <th>Like Count</th>
                    <th>Comment</th>
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
                        echo "<td><b>" . $row['ps_from'] . "</b></td>";
                        $message = preg_replace('/[^A-Z a-z 0-9 \!\?\@\%\&\(\)\:\\\,\-\#\$\.]/', '', $row['ps_message']);
                        echo "<td>" . $message . "</td>";
//                        echo "<td>" . date("d F Y", strtotime($row['ps_created_time'])) . "</td>";
                        echo "<td><div class='fa fa-share'> " . $row['ps_shares'] . "</div></td>";
                        echo "<td><div class='fa fa-thumbs-up'> " . $row['ps_likes'] . "</div></td>";
                        $surl = base_url('/facebook/vcomment/' . $url . '/1/' . $row["ps_id"]);
                        echo '<td><a class="btn btn-primary fa fa-comment" href="' . $surl . '"></a></td>';
                        echo '<td><a class="btn btn-primary fa fa-facebook" href="' . $row['ps_link'] . '" target="_blank"></a></td>';
                        echo "</tr>";
                        $i++;
                    }
                }
                ?>
                <!-- EOT -->
            </tbody>
            <tfoot>
                <tr>
                    <th>Post From</th>
                    <th>Post</th>
                    <!--<th>Date</th>-->
                    <th>Share Count</th>
                    <th>Like Count</th>
                    <th>Comment</th>
                    <th>Go to</th>
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div>

<script>
    //2014-02-10 - 2015-08-20
    function view(facebook_id) {
        window.open("<?php echo FACEBOOK ?>/" + facebook_id, '_blank');
    }

    function view_comment(post_id) {
        top.location = "<?php echo base_url('/facebook/view_comment/' . $url . '/1') ?>/" + post_id;
    }


</script>
