<div class="box box-primary">
    <div class="box-body">
        <!-- define all chart -->

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Token Name</th>
                    <th>Apps</th>
                    <th>Secret Key</th>
                    <th>Token</th>
                    <!--<th>Delete</th>-->
                </tr>
            </thead>
            <tbody>
                <!-- table content -->
                <?php
                if ($json_result->num_rows() > 0) {
                    $i = 0;
                    foreach ($json_result->result_array() as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['tk_name'] . "</td>";
                        echo "<td>" . $row['tk_apps'] . "</td>";
                        echo "<td>" . $row['tk_secret'] . "</td>";
                        echo "<td>" . $row['tk_token'] . "</td>";
//                        echo '<td><button id="delete' . $i . '" type="" class="btn btn-fourth" onclick="delete_instagram(' . $row['tk_id'] . ');">Delete</button></td>';
                        echo "</tr>";
                        $i++;
                    }
                }
                ?>
                <!-- EOT -->
            </tbody>
            <tfoot>
                <tr>
                    <th>Token Name</th>
                    <th>Apps</th>
                    <th>Secret Key</th>
                    <th>Token</th>
                    <!--<th>Delete</th>-->
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div>

<script>
    //2014-02-10 - 2015-08-20
    function delete_instagram(instagram_id) {
        top.location = "<?php echo base_url('/instagram/token_delete/' . $url . '/1') ?>/" + instagram_id;
    }
</script>
