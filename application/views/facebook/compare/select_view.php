<div class="box box-default">
    <div class="box-header with-border">
        <div class="input-group-sm">
            <form class="form-horizontal" action="<?php echo base_url('/compare/result/' . $url . '/1') ?>" method="post" onsubmit="return checkvalue(this);">
                <div class="input-group-addon">
                    <i class="fa fa-facebook-f"></i>
                </div>
                <select class="form-control select2"  multiple="multiple" data-placeholder="Select FB Page" id="fb_page" name="fb_page[]" style="width: 100%;">
                    <?php
                    if ($select_page->num_rows() > 0) {
                        $i = 0;
                        foreach ($select_page->result_array() as $row) {
                            echo '<option value="' . $row['pg_id'] . '">' . $row['pg_name'] . '</option>';
                            $i++;
                        }
                    }
                    ?>
                </select>
                <div class="input-group-btn">
                    <button id="search" type="submit" class="btn btn-primary btn-block btn-flat" onclick="search();">Search</button>
                </div>
            </form>
        </div>
    </div> 
</div>

<script>
    function checkvalue() {
        var mystring = document.getElementById('fb_page').value;
        if (!mystring.match(/\S/)) {
            alert('Empty value is not allowed!');
            return false;
        } else {
            var len_value= $('#fb_page option:selected').length;
            if(len_value!=3){
                alert("Selected value must be 3!");
                return false;
            }else{
                return true;
            }
        }
    }
</script>