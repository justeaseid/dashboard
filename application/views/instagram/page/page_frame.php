<div class="box box-primary">
    <div class="box-body">
        <!-- define all chart -->
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Page ID</th>
                    <th>Page Name</th>
                    <th>Description</th>
                    <th>Add</th>
                    <!--<th>Delete</th>-->
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
                        echo "<td>" . $row['pg_id'] . "</td>";
                        echo "<td>" . $row['pg_name'] . "</td>";
                        $description = $row['pg_description'];
                        if ($description == "NULL")
                            $description = "No Description";
                        else
                            $description = substr($description, 0, 350) . "...";
                        echo "<td>" . $description . "</td>";
                        $status_data = $row['status'];
                        if($status_data=="yes"){
                            echo '<td><button id="add' . $i . '" type="" class="btn btn-fifth" onclick="add_instagram(' . $row['pg_id'] . ');" disabled>Add</button></td>';
                        }else{
                            echo '<td><button id="add' . $i . '" type="" class="btn btn-fifth" onclick="add_instagram(' . $row['pg_id'] . ');">Add</button></td>';
                        }
//                        echo '<td><button id="delete' . $i . '" type="" class="btn btn-fourth" onclick="delete_instagram(' . $row['pg_id'] . ');">Delete</button></td>';
//                        echo '<td><button id="view' . $i . '" type="" class="btn btn-primary" onclick="view(' . $row['pg_id'] . ');">View</button></td>';
                        echo '<td><a class="btn btn-primary fa fa-instagram" href="' . INSTAGRAM . $row['pg_name'] . '" target="_blank"></a></td>';
                        echo "</tr>";
                        $i++;
                    }
                }
                ?>
                <!-- EOT -->
            </tbody>
            <tfoot>
                <tr>
                    <th>Page ID</th>
                    <th>Page Name</th>
                    <th>Description</th>
                    <th>Add</th>
                    <!--<th>Delete</th>-->
                    <th>Go to</th>
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div>

<script>
    //2014-02-10 - 2015-08-20
    function view(instagram_id) {
        window.open("<?php echo INSTAGRAM ?>/" + instagram_id, '_blank');
    }

    function delete_instagram(instagram_id) {
        top.location = "<?php echo base_url('/instagram/page_delete/' . $url . '/' . $id_user) ?>/" + instagram_id;
    }

    function add_instagram(instagram_id) {
        top.location = "<?php echo base_url('/instagram/page_add/' . $url . '/' . $id_user) ?>/" + instagram_id;
    }
</script>