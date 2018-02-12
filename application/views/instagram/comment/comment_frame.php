<div class="box box-primary">
    <div class="box-body">
        <!-- define all chart -->
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Comment From</th>
                    <th>Comment</th>
<!--                    <th>Date</th>
                    <th>Comment Count</th>
                    <th>Like Count</th>
                    <th>Sub Comment</th>
                    <th>Go to</th>-->
                </tr>
            </thead>
            <tbody>
                <!-- table content -->
                <?php
                if ($json_result->num_rows() > 0) {
                    $i = 0;
                    foreach ($json_result->result_array() as $row) {
                        echo "<tr>";
                        echo "<td><b>" . $row['cm_from'] . "</b></td>";
                        $message = preg_replace('/[^A-Z a-z 0-9 \!\?\@\%\&\(\)\:\\\,\-\#\$\.]/', '', $row['cm_message']);
                        echo "<td>" . $message . "</td>";
//                        echo "<td>" . date("d F Y", strtotime($row['cm_created_time'])) . "</td>";
//                        echo "<td><div class='fa fa-comment'> " . $row['cm_comment_count'] . "</div></td>";
//                        echo "<td><div class='fa fa-thumbs-up'> " . $row['cm_likes'] . "</div></td>";
//                        $surl = base_url('/facebook/vscomment/' . $url . '/1/' . $row["cm_id"]);
//                        echo '<td><a class="btn btn-primary fa fa-comments" href="' . $surl . '"></a></td>';
//                        echo '<td><a class="btn btn-primary fa fa-facebook" href="' . FACEBOOK . $row['cm_id'] . '" target="_blank"></a></td>';
                        echo "</tr>";
                        $i++;
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Comment From</th>
                    <th>Comment</th>
<!--                    <th>Date</th>
                    <th>Comment Count</th>
                    <th>Like Count</th>
                    <th>Sub Comment</th>
                    <th>Go to</th>-->
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div>
