<div style="width: 100%;height: 30px;">
    <div style="float: left;display: inline-table;">
        <h4>
            <b>
                Trending Topic - <?php echo $pg_name;?>
            </b>

        </h4>
    </div>

    <div style="float: right;">
        <select class="form-control select2" style="width: 100%;" name="pg_array" id="page" onchange="change_page();">
            <?php
            if ($pg_array->num_rows() > 0) {
                $i = 0;
                foreach ($pg_array->result_array() as $row) {
                    if ($i == 0) {
                        echo '<option value="all" selected="selected">-- Pages --</option>';
                        echo '<option value="all"> All Pages </option>';
                    }
                    echo '<option value="' . $row['acc_id'] . '">' . $row['acc_name'] . '</option>';
                    $i++;
                }
            }
            ?>
        </select>
    </div>

</div>

<script>
    //2014-02-10 - 2015-08-20
    function change_page() {
        var page_id = document.getElementById('page').value;
        top.location = "<?php echo base_url('/ttopic/trends/' . $url . '/' . $id_user) ?>/" + page_id;
    }
</script>