<div style="width: 100%;height: 30px;">
    <div style="float: left;display: inline-table;">
        <a class="btn btn-warning" href="<?php echo base_url('/ftopic/monitoring/' . $url . '/' . $id_user . '/'. $topic_id); ?>">Back to <b><?php echo strtoupper($topic_name);?></b></a>
    </div>


<!--    <div style="float: right;">
        <select class="form-control select2" style="width: 150px;" name="type" id="type" onchange="change_timeline();">
            <option value="all" selected="selected">-- Tag Type --</option>
            <option value="all">All</option>
            <option value="comment">Comment</option>
            <option value="photo">Photo</option>
            <option value="video">Video</option>
            <option value="link">Link</option>
            <option value="status">Status</option>
            <option value="offer">Offer</option>
        </select>
    </div>-->
</div>

<script>
    //2014-02-10 - 2015-08-20
    function change_timeline() {
        var page_id = document.getElementById('page_id').value;
        var type = document.getElementById('type').value;
        top.location = "<?php echo base_url('/ftopic/timeline/' . $url . '/1') ?>/" + page_id+"/<?php echo $topic_id;?>/"+type;
    }
</script>