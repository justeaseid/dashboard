<div class="box box-primary">
    <div class="box-body">
        <!-- define all chart -->
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <!--<th>Page ID</th>-->
                    <!--<th>#</th>-->
                    <th>Account Name</th>
                    <th>Friends</th>
                    <th>Followers</th>
                    <th>Post</th>
                    <th>Actions</th>
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
//                        echo "<td>" . $row['pg_id'] . "</td>";
//                        echo "<td>" . $number . "</td>";
                        echo "<td>" . $row['pg_username'] . "</td>";
                        echo "<td><div class='fa fa-users'> " . number_format($row['pg_friends'], 0, '.', ',') . "</div></td>";
                        echo "<td><div class='fa fa-heart'> " . number_format($row['pg_followers'], 0, '.', ',') . "</div></td>";
                        echo "<td><div class='fa fa-instagram'> " . number_format($row['pg_post'], 0, '.', ',') . "</div></td>";
                        echo "
                        <td><select class='form-control select2' style='width: 100px;' name='" . $i . "' id='" . $i . "' onchange='go_to(" . $i . "," . $row['pg_id'] . ");'>
                            <option value='0' selected='selected'> Go to </option>
                            <option value='1'>Dashboard</option>
                            <option value='2'>Statistic</option>
                            <option value='3'>Timeline</option>
                            <option value='4'>Event</option>
                            <option value='5'>Analyze</option>
                            <option value='6'>Popular</option>
                        </select>
                        </td>";
//                        echo '<td><button id="dashboard' . $i . '" type="" class="btn btn-primary" onclick="dashboard(' . $row['pg_id'] . ');">Dashboard</button></td>';
////                      echo '<td><button id="statistic' . $i . '" type="" class="btn btn-second" onclick="statistic(' . $row['pg_id'] . ');">Statistic</button></td>';
//                        echo '<td><button id="timeline' . $i . '" type="" class="btn btn-third" onclick="timeline(' . $row['pg_id'] . ');">Timeline</button></td>';
//                        echo '<td><button id="events' . $i . '" type="" class="btn btn-fifth" onclick="events(' . $row['pg_id'] . ');">Events</button></td>';
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
                    <th>Account Name</th>
                    <th>Friends</th>
                    <th>Followers</th>
                    <th>Post</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div>

<script>

    function go_to(idx, instagram_id) {
//        var page_id = document.getElementById('page_id').value;
        var type = document.getElementById(idx).value;
        if (type == "1") {
            top.location = "<?php echo base_url('/instagram/dashboard/' . $url . '/1') ?>/" + instagram_id;
        } else if (type == "2") {
            top.location = "<?php echo base_url('/instagram/statistic/' . $url . '/1') ?>/" + instagram_id + "/month";
        } else if (type == "3") {
            top.location = "<?php echo base_url('/instagram/timeline/' . $url . '/1') ?>/" + instagram_id + "/all";
        } else if (type == "4") {
            top.location = "<?php echo base_url('/instagram/event/' . $url . '/1') ?>/" + instagram_id + "/all";
        } else if (type == "5") {
            top.location = "<?php echo base_url('/instagram/analyze/' . $url . '/1') ?>/" + instagram_id;
        } else if (type == "6") {
            top.location = "<?php echo base_url('/instagram/popular/' . $url . '/1') ?>/" + instagram_id;
        }
    }
</script>
