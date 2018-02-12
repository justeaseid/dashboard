<div class="box box-primary">
    <div class="box-header with-border">
        <!-- form search all info by date -->
        <div class="form-group" style="padding-top: 10px;">
            <!-- get date from user input -->

            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-search"></i>
                </div>

                <!-- input date from user -->
                <input id="keyword" type="text" class="form-control pull-right" value="<?php echo $keyword; ?>">
                <div class="input-group-btn">
                    <button id="search" type="submit" class="btn btn-primary btn-block btn-flat" onclick="search();">Search</button>
                </div>

            </div><!-- /.input group -->
            <?php echo $status; ?>
        </div><!-- /.form group -->
    </div>

    <div class="box-body">
        <!-- define all chart -->
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Page ID</th>
                    <th>Page Name</th>
                    <th>Add</th>
                    <th>Go to</th>
                </tr>
            </thead>
            <tbody>
                <!-- table content -->
                <?php
                if ($json_count > 0) {
                    foreach ($json_data as $nrow) {
                        $row = (array) $nrow;
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo '<td><button id="add" type="" class="btn btn-secondary" onclick="insert(' . $row['id'] . ');">Add</button></td>';
//                        echo '<td><button id="view" type="" class="btn btn-primary" onclick="view(' . $row['id'] . ');">View</button></td>';
                        echo '<td><a class="btn btn-primary fa fa-facebook" href="' .FACEBOOK. $row['id'] . '" target="_blank"></a></td>';
                        echo "</tr>";
                    }
                } 
                ?>
                <!-- EOT -->
            </tbody>
            <tfoot>
                <tr>
                    <th>Page ID</th>
                    <th>Page Name</th>
                    <th>Add</th>
                    <th>Go to</th>
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div>

<script>
    //2014-02-10 - 2015-08-20
    function search() {
        var keyword = document.getElementById("keyword").value;
        top.location = "<?php echo base_url('/facebook/search/' . $url . '/1') ?>/" + keyword;
    }

    function view(facebook_id) {
        window.open("<?php echo FACEBOOK ?>/" + facebook_id, '_blank');
    }

    function insert(facebook_id) {
        var keyword = document.getElementById("keyword").value;
        top.location = "<?php echo base_url('/facebook/insert/' . $url . '/1') ?>/" + keyword+"/"+facebook_id;
    }
</script>
