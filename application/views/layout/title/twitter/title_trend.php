<div style="width: 100%;height: 30px;">
    <div style="float: left;display: inline-table;">
        <a class="btn btn-warning" href="<?php echo base_url('/twitter/monitoring/' . $url . '/' . $id_user); ?>">Back</a>
    </div>


    <div style="float: right;">
        <select class="form-control select2" style="width: 150px;" name="type" id="type" onchange="change_timeline();">
            <option value="all" selected="selected">-- Date Range --</option>
            <option value="all">All</option>
            <option value="today">Today</option>
            <option value="week">Week</option>
            <option value="month">Month</option>
            <option value="year">Year</option>
        </select>
    </div>
</div>

<script>
    //2014-02-10 - 2015-08-20
    function change_timeline() {
        var page_id = document.getElementById('page_id').value;
        var type = document.getElementById('type').value;
        top.location = "<?php echo base_url('/twitter/trend/' . $url . '/1') ?>/" + page_id + "/" + type;
    }
</script>