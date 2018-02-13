<div class="box box-primary">
    <div class="box-body">
        <!-- define all chart -->
        <div style="display: inline-block;width: 100%;">
            <div style="float: left;">
                <h4><b>User Data</b></h4>
            </div>
            <div style="float: right;">
                <!--<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
                <a class="btn btn-primary" href="<?php echo base_url('/user/add/' . $url . '/' . $id_user);?>">Tambahkan</a>
            </div>
        </div>

        <hr>
        
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>ID Card</th>
                    <th>Email</th>
                    <th>Created Date</th>
                    <th>Gender</th>
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
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['id_card'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['created_date'] . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        
                        $status = "";
                        $statusAcc = $row['status_account'];
                        if($statusAcc=="1"){
                            $status = "active";
                        }else{
                            $status = "inactive";
                        }
                        echo "<td>" . $status . "</td>";
                        echo '<td><button id="add' . $i . '" type="" class="btn btn-primary" onclick="add_instagram(' . $row['user_id'] . ');">Edit</button></td>';
                        echo '<td><button id="delete' . $i . '" type="" class="btn btn-danger" onclick="delete_instagram(' . $row['user_id'] . ');">Delete</button></td>';
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
                    <th>ID Card</th>
                    <th>Email</th>
                    <th>Created Date</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div>

<script>
    //2014-02-10 - 2015-08-20
    function view(instagram_id) {
        window.open("<?php // echo INSTAGRAM ?>/" + instagram_id, '_blank');
    }

    function delete_instagram(instagram_id) {
        top.location = "<?php echo base_url('/instagram/page_delete/' . $url . '/' . $id_user) ?>/" + instagram_id;
    }

    function add_instagram(instagram_id) {
        top.location = "<?php echo base_url('/instagram/page_add/' . $url . '/' . $id_user) ?>/" + instagram_id;
    }
</script>
