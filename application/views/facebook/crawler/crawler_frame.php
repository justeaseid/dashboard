<div class="box box-primary">
    <div class="box-body">
        <!-- define all chart -->
        
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <!--<th>Crawler ID</th>-->
                    <th>Token Name</th>
                    <!--<th>Page ID</th>-->
                    <th>Page Name</th>
                    <th>Last Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <!-- table content -->
                <?php
                if ($json_result->num_rows() > 0) {
                    $i = 0;
                    foreach ($json_result->result_array() as $row) {
                        echo "<tr>";
//                        echo "<td>" . $row['cw_id'] . "</td>";
                        echo "<td>" . $row['tk_name'] . "</td>";
//                        echo "<td>" . $row['pg_id'] . "</td>";
                        echo "<td>" . $row['pg_name'] . "</td>";
//                        echo "<td>" . $row['last_update'] . "</td>";
                        echo "<td>" . date("d F Y h:i:s A", strtotime($row["last_update"])+21600) . "</td>";
                        echo '<td><button id="delete' . $i . '" type="" class="btn btn-fourth" onclick="delete_facebook(' . $row['cw_id'] . ');">Delete</button></td>';
                        echo "</tr>";
                        $i++;
                    }
                }
                ?>
                <!-- EOT -->
            </tbody>
            <tfoot>
                <tr>
                    <!--<th>Crawler ID</th>-->
                    <th>Token Name</th>
                    <!--<th>Page ID</th>-->
                    <th>Page Name</th>
                    <th>Last Update</th>
                    <th>Delete</th>
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div>

<script>
    //2014-02-10 - 2015-08-20
    function delete_facebook(facebook_id) {
        top.location = "<?php echo base_url('/facebook/crawler_delete/' . $url . '/1') ?>/" + facebook_id;
    }
</script>