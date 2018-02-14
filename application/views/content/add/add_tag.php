<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#settings" data-toggle="tab"><?php echo $title; ?> Settings</a></li>
        </ul>

        <div class="tab-content">
            <?php echo $status; ?>
            <form class="form-horizontal" action="<?php echo base_url('/tag/insert_tag/'.$url.'/1') ?>" method="post">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="name" value="<?php echo $name;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputBio" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" id="inputBio" name="description"><?php echo $description;?></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-danger" onclick="window.history.go(-1); return false;">
                            <i class="fa "></i> Back
                        </button>
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </div>
                </div>
            </form>
            <!--</div>-->

        </div>

    </div>
</div>