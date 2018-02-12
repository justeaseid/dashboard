<div class="box box-primary">
    <div class="box-body">
        <!-- define all chart -->
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Topic</th>
                    <th>Tweet</th>
                    <th>Retweet</th>
                    <th>Like</th>
                </tr>
            </thead>
            <tbody>
                <!-- table content -->
                <?php
                if ($json_result->num_rows() > 0) {
                    $i = 0;
                    foreach ($json_result->result_array() as $row) {
                        $number = $i + 1;
                        echo "<tr>";
                        echo "<td>" . $row['topic_name'] . "</td>";
                        echo "<td><div class='fa fa-twitter'> " . number_format($row['tweet'], 0, '.', ',') . "</div></td>";
                        echo "<td><div class='fa fa-retweet'> " . number_format($row['retweet'], 0, '.', ',') . "</div></td>";
                        echo "<td><div class='fa fa-heart'> " . number_format($row['likes'], 0, '.', ',') . "</div></td>";
                        echo "</tr>";
                        $i++;
                    }
                }
                ?>
                <!-- EOT -->
            </tbody>
            <tfoot>
                <tr>
                    <th>Topic</th>
                    <th>Tweet</th>
                    <th>Retweet</th>
                    <th>Like</th>
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div>

