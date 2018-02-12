<div class="box box-primary">
    <div class="box-body">
        <!-- define all chart -->
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <!--<th>Page ID</th>-->
                    <!--<th>#</th>-->
                    <th>Page Name</th>
                    <th>Talking About</th>
                    <th>Likes</th>
                    <th>Checkins</th>
                    <th>Dashboard</th>
                    <th>Statistic</th>
                    <th>Timeline</th>
                    <th>Events</th>
                </tr>
            </thead>
            <tbody>
                <!-- table content -->
                <?php
                if ($json_result->num_rows() > 0) {
                    $i = 0;
                    foreach ($json_result->result_array() as $row) {
                        $number = $i+1;
                        echo "<tr>";
//                        echo "<td>" . $row['pg_id'] . "</td>";
//                        echo "<td>" . $number . "</td>";
                        echo "<td>" . $row['pg_name'] . "</td>";
                        echo "<td><div class='fa fa-comments'> " . number_format($row['pg_talking_about_count'], 0, '.', ',') . "</div></td>";
                        echo "<td><div class='fa fa-thumbs-up'> " . number_format($row['pg_likes'], 0, '.', ',') . "</div></td>";
                        echo "<td><div class='fa fa-map-marker'> " . number_format($row['pg_checkins'], 0, '.', ',') . "</div></td>";
                        echo '<td><button id="dashboard' . $i . '" type="" class="btn btn-primary" onclick="dashboard(' . $row['pg_id'] . ');">Dashboard</button></td>';
//                        echo '<td><button id="summary' . $i . '" type="" class="btn btn-fourth" onclick="summary(' . $row['pg_id'] . ');">Summary</button></td>';
                        echo '<td><button id="statistic' . $i . '" type="" class="btn btn-second" onclick="statistic(' . $row['pg_id'] . ');">Statistic</button></td>';
                        echo '<td><button id="timeline' . $i . '" type="" class="btn btn-third" onclick="timeline(' . $row['pg_id'] . ');">Timeline</button></td>';
                        echo '<td><button id="events' . $i . '" type="" class="btn btn-fifth" onclick="events(' . $row['pg_id'] . ');">Events</button></td>';
                        echo "</tr>";
                        $i++;
                    }
                }
                ?>
                <!-- EOT -->
            </tbody>
            <tfoot>
                <tr>
                     <!--<th>Page ID</th>-->
                    <!--<th>#</th>-->
                    <th>Page Name</th>
                    <th>Talking About</th>
                    <th>Likes</th>
                    <th>Checkins</th>
                    <th>Dashboard</th>
                    <th>Statistic</th>
                    <th>Timeline</th>
                    <th>Events</th>
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div>

<script>
    //2014-02-10 - 2015-08-20
    function dashboard(facebook_id) {
        top.location = "<?php echo base_url('/facebook/dashboard/' . $url . '/1') ?>/" + facebook_id;
    }

    function summary(facebook_id) {
        top.location = "<?php echo base_url('/facebook/' . $url . '/1') ?>/" + facebook_id;
    }

    function statistic(facebook_id) {
        top.location = "<?php echo base_url('/facebook/statistic/' . $url . '/1') ?>/" + facebook_id+"/month";
    }

    function timeline(facebook_id) {
        top.location = "<?php echo base_url('/facebook/timeline/' . $url . '/1') ?>/" + facebook_id + "/all";
    }

    function events(facebook_id) {
        top.location = "<?php echo base_url('/facebook/event/' . $url . '/1') ?>/" + facebook_id + "/all";
    }
</script>
