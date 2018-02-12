<div style="width: 100%;height: 30px;">
    <div style="float: left;display: inline-table;">
        <a class="btn btn-warning" href="<?php echo base_url('/itopic/monitoring/' . $url . '/' . $id_user . '/'. $topic_id); ?>">Back to <b><?php echo strtoupper($topic_name);?></b></a>
    </div>


    <div style="float: right;">
        <select class="form-control select2" style="width: 100%;" name="dw_year" id="year" onchange="change_year();">
            <?php
            if ($dw_year->num_rows() > 0) {
                $i = 0;
                foreach ($dw_year->result_array() as $row) {
                    if ($i == 0)
                        echo '<option value="' . $row['d_year'] . '" selected="selected">-- Year --</option>';
//                    else
//                        echo '<option value="' . $row['d_year'] . '">' . $row['d_year'] . '</option>';
                    echo '<option value="' . $row['d_year'] . '">' . $row['d_year'] . '</option>';
                    $i++;
                }
            }
            ?>
        </select>
    </div>
</div>

<script>
    //2014-02-10 - 2015-08-20
    function change_year() {
        var page_id = document.getElementById('page_id').value;
        var year = document.getElementById('year').value;
        top.location = "<?php echo base_url('/itopic/dashboard/' . $url . '/1') ?>/" + page_id + "/<?php echo $topic_id;?>/" + year;
    }
</script>