<div class="box box-primary">
    <div class="box-body">
        <!-- define all chart -->
        <div style="display: inline-block;width: 100%;">
            <div style="float: left;">
                <h4><b><?php echo $title; ?> Data</b></h4>
            </div>
            <div style="float: right;">
                <a class="btn btn-primary" href="<?php echo base_url('/payment/add/' . $url . '/' . $id_user);?>">Tambahkan</a>
            </div>
        </div>

        <hr>
        
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Acc Number</th>
                    <th>Acc Name</th>
                    <th>Branch</th>
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
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['account_number'] . "</td>";
                        echo "<td>" . $row['account_name'] . "</td>";
                        echo "<td>" . $row['branch'] . "</td>";
                        echo '<td><button id="edit' . $i . '" type="" class="btn btn-primary" onclick="edit_data(' . $row['payment_id'] . ');">Edit</button></td>';
                        echo '<td><button id="delete' . $i . '" type="" class="btn btn-danger" onclick="delete_data(' . $row['payment_id'] . ');">Delete</button></td>';
                        echo "</tr>";
                        $i++;
                    }
                }
                ?>
                <!-- EOT -->
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Acc Number</th>
                    <th>Acc Name</th>
                    <th>Branch</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div>

<script>
    function delete_data(data_id) {
        top.location = "<?php echo base_url('/payment/delete/' . $url . '/' . $id_user) ?>/" + data_id;
    }

    function edit_data(data_id) {
        top.location = "<?php echo base_url('/payment/edit/' . $url . '/' . $id_user) ?>/" + data_id;
    }
</script>