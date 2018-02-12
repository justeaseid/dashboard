<div class="box box-primary">
    <div class="box-body">
        <!-- define all chart -->
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <!--<th>Page ID</th>-->
                    <!--<th>#</th>-->
                    <th>Screen Name</th>
                    <th>Tweet</th>
                    <th>Followers</th>
                    <th>Following</th>
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
			$page_id = $row['acc_id'];
                        echo "<td>@" . $row['acc_screen_name'] . "</td>";
                        echo "<td><div class='fa fa-twitter'> " . number_format($row['acc_statuses'], 0, '.', ',') . "</div></td>";
                        echo "<td><div class='fa fa-user-plus'> " . number_format($row['acc_followers'], 0, '.', ',') . "</div></td>";
                        echo "<td><div class='fa fa-users'> " . number_format($row['acc_friends'], 0, '.', ',') . "</div></td>";
                        //echo "<td><div style='display: none;' name='". $row['acc_id'] ."'> " . $row['acc_id'] . "</div></td>";
			echo "
                        <td><select class='form-control select2' style='width: 100px;' name='" . $i . "' id='" . $i . "' onchange='go_to(" . $i . "," . $page_id . ");'>
                            <option value='0' selected='selected'> Go to </option>
                            <option value='1'>Dashboard</option>
                            <option value='2'>Statistic</option>
                            <option value='3'>Timeline</option>
                            <option value='4'>Popular</option>
                            <option value='5'>Trend</option>
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
                    <th>Screen Name</th>
                    <th>Tweet</th>
                    <th>Followers</th>
                    <th>Following</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div>

<script>

    function go_to(idx, ttopic_id) {
	//alert(ttopic_id);
        //var page_id = document.getElementById(ttopic_id).value;
        var type = document.getElementById(idx).value;
	//alert(page_id);
	//alert(type);

	if(ttopic_id=='759692754985242600'){
            ttopic_id = '759692754985242625'
        }

        if (type == "1") {
            top.location = "<?php echo base_url('/ttopic/dashboard/' . $url . '/1') ?>/" + ttopic_id + "/<?php echo $topic_id;?>";
        } else if (type == "2") {
            top.location = "<?php echo base_url('/ttopic/statistic/' . $url . '/1') ?>/" + ttopic_id + "/<?php echo $topic_id;?>/month";
        } else if (type == "3") {
            top.location = "<?php echo base_url('/ttopic/timeline/' . $url . '/1') ?>/" + ttopic_id + "/<?php echo $topic_id;?>/today";
        } else if (type == "4") {
            top.location = "<?php echo base_url('/ttopic/popular/' . $url . '/1') ?>/" + ttopic_id + "/<?php echo $topic_id;?>";
        } else if (type == "5") {
            top.location = "<?php echo base_url('/ttopic/trend/' . $url . '/1') ?>/" + ttopic_id+ "/<?php echo $topic_id;?>/month";
        }
    }
</script>
