<div class="box box-primary">
    <div class="box-body">
        <!-- define all chart -->
        <div style="display: inline-block;width: 100%;">
            <div style="float: left;">
                <h4><b><?php echo $title; ?> Data</b></h4>
            </div>
            <div style="float: right;">
                <a class="btn btn-primary" href="<?php echo base_url('/campaign/add/' . $url . '/' . $id_user);?>">Tambahkan</a>
            </div>
        </div>

        <hr>
        
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Apv. Donation</th>
                    <th>Ops. Cost</th>
                    <th>city</th>
                    <th>Verification</th>
                    <th>Status</th>
                    <th>Edit</th>
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
                        echo '<td style="word-wrap: break-word">' . $row['titles'] . "</td>";
                        echo '<td>' . $row['username'] . "</td>";
                        echo "<td>Rp " . number_format($row['approved_donation'], 0, '.', ',') . "</td>";
                        echo "<td>" . $row['percentage'] . "</td>";
                        echo "<td>" . $row['city'] . "</td>";
                        echo "<td>" . $row['verification_status'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo '<td><button id="edit' . $i . '" type="" class="btn btn-primary" onclick="edit_data(' . $row['campaign_id'] . ');">Edit</button></td>';
                        echo '<td><button id="delete' . $i . '" type="" class="btn btn-danger" onclick="delete_data(' . $row['campaign_id'] . ');">Delete</button></td>';
                        echo "</tr>";
                        $i++;
                    }
                }
                ?>
                <!-- EOT -->
            </tbody>
            <tfoot>
                <tr>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Apv. Donation</th>
                    <th>Ops. Cost</th>
                    <th>city</th>
                    <th>Verification</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div>

<script>
    function delete_data(data_id) {
        top.location = "<?php echo base_url('/campaign/delete/' . $url . '/' . $id_user) ?>/" + data_id;
    }

    function edit_data(data_id) {
        top.location = "<?php echo base_url('/campaign/edit/' . $url . '/' . $id_user) ?>/" + data_id;
    }
</script>
