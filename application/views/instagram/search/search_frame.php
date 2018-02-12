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
                    <th>Followers</th>
                    <th>Friends</th>
                    <th>Posts</th>
                    <th>Add</th>
                    <th>Go to</th>
                </tr>
            </thead>
            <tbody>
                <!-- table content -->
                <?php
                if ($json_status == 1) {
                    foreach ($json_data as $nrow) {
                        $row = (array) $nrow;
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['followers'] . "</td>";
                        echo "<td>" . $row['follows'] . "</td>";
                        echo "<td>" . $row['posts'] . "</td>";
                        echo '<td><button id="add" type="" class="btn btn-secondary" onclick="insert(' . $row['id'] . ');">Add</button></td>';
                        echo '<td><a class="btn btn-primary fa fa-instagram" href="' . INSTAGRAM . $row['username'] . '" target="_blank"></a></td>';
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
                    <th>Followers</th>
                    <th>Friends</th>
                    <th>Posts</th>
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
        top.location = "<?php echo base_url('/instagram/search/' . $url . '/1') ?>/" + keyword;
    }

    function view(instagram_id) {
        window.open("<?php echo INSTAGRAM ?>/" + instagram_id, '_blank');
    }

    function insert(instagram_id) {
        var keyword = document.getElementById("keyword").value;
        top.location = "<?php echo base_url('/instagram/insert/' . $url . '/1') ?>/" + keyword + "/" + instagram_id;
    }
</script>
