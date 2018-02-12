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
                    <th>User ID</th>
                    <th>Screen Name</th>
                    <th>Name</th>
                    <th>Tweet</th>
                    <th>Followers</th>
                    <th>Following</th>
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
                        echo "<td>" . $row['id_str'] . "</td>";
                        echo "<td><b>@" . $row['screen_name'] . "</b></td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . number_format($row['statuses_count'], 0, '.', ',') . "</td>";
                        echo "<td>" . number_format($row['followers_count'], 0, '.', ',') . "</td>";
                        echo "<td>" . number_format($row['friends_count'], 0, '.', ',') . "</td>";
                        echo '<td><button id="add" type="" class="btn btn-secondary" onclick="insert(' . $row['id_str'] . ',\'' . $row['screen_name'] . '\');">Add</button></td>';
//                        echo '<td><button id="view" type="" class="btn btn-primary" onclick="view(' . $row['id'] . ');">View</button></td>';
                        echo '<td><a class="btn btn-primary fa fa-twitter" href="' .TWITTER. $row['screen_name'] . '" target="_blank"></a></td>';
                        echo "</tr>";
                    }
                } 
                ?>
                <!-- EOT -->
            </tbody>
            <tfoot>
                <tr>
                    <th>User ID</th>
                    <th>Screen Name</th>
                    <th>Name</th>
                    <th>Tweet</th>
                    <th>Followers</th>
                    <th>Following</th>
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
        top.location = "<?php echo base_url('/twitter/search/' . $url . '/1') ?>/" + keyword;
    }

    function view(twitter_id) {
        window.open("<?php echo TWITTER ?>/" + twitter_id, '_blank');
    }

    function insert(twitter_id, twitter_name) {
        var keyword = document.getElementById("keyword").value;
        top.location = "<?php echo base_url('/twitter/insert/' . $url . '/1') ?>/" + keyword+"/"+twitter_id+"/"+twitter_name;
    }
</script>
