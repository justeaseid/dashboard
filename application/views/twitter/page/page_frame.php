<div class="box box-primary">
    <div class="box-body">
        <!-- define all chart -->
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Screen Name</th>
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
                        echo "<td>" . $row['acc_id'] . "</td>";
                        echo "<td>@" . $row['acc_screen_name'] . "</td>";
                        $description = $row['acc_description'];
                        if ($description == "NULL")
                            $description = "No Description";
                        else
                            $description = substr($description, 0, 350)."...";
                        echo "<td>" . $description . "</td>";
                        
                        $status_data = $row['status'];
                        if($status_data=="yes"){
                            echo '<td><button id="add' . $i . '" type="" class="btn btn-fourth" onclick="add_twitter(' . $row['acc_id'] . ');" disabled>Add</button></td>';
                        }else{
                            echo '<td><button id="add' . $i . '" type="" class="btn btn-fourth" onclick="add_twitter(' . $row['acc_id'] . ');">Add</button></td>';
                        }
//                        echo '<td><button id="delete' . $i . '" type="" class="btn btn-fourth" onclick="delete_twitter(' . $row['acc_id'] . ');">Delete</button></td>';
//                        echo '<td><button id="view' . $i . '" type="" class="btn btn-primary" onclick="view(' . $row['pg_id'] . ');">View</button></td>';
                        echo '<td><a class="btn btn-primary fa fa-twitter" href="' .TWITTER. $row['acc_screen_name'] . '" target="_blank"></a></td>';
                        echo "</tr>";
                        $i++;
                    }
                }
                ?>
                <!-- EOT -->
            </tbody>
            <tfoot>
                <tr>
                    <th>User ID</th>
                    <th>Screen Name</th>
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
    function view(twitter_id) {
        window.open("<?php echo TWITTER ?>/" + twitter_id, '_blank');
    }

    function delete_twitter(twitter_id) {
        top.location = "<?php echo base_url('/twitter/page_delete/' . $url . '/' . $id_user) ?>/" + twitter_id;
    }
    
    function add_twitter(twitter_id) {
        top.location = "<?php echo base_url('/twitter/page_add/' . $url . '/' . $id_user) ?>/" + twitter_id;
    }
</script>
