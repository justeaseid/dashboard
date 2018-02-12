<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
    </ul>

    <div class="tab-content">
        <!--<div class="tab-pane" id="settings">-->
        <form class="form-horizontal" action="<?php echo base_url('/twitter/insert_crawler/' . $url . '/1') ?>" method="post">

            <div class="form-group">
                <label for="inputToken" class="col-sm-2 control-label">Token Name</label>
                <div class="col-sm-10">
                    <select class="form-control select2" style="width: 100%;" name="token">
                        <?php
                        if ($json_token->num_rows() > 0) {
                            $i = 0;
                            foreach ($json_token->result_array() as $row) {
                                if($i==0)
                                    echo '<option value="'.$row['tk_id'].'" selected="selected">'.$row['tk_name'].'</option>';
                                else 
                                    echo '<option value="'.$row['tk_id'].'">'.$row['tk_name'].'</option>';
                                $i++;
                            }
                        }
                        ?>
                    </select>
                </div>
            </div><!-- /.form-group -->
            <div class="form-group">
                <label for="inputPage" class="col-sm-2 control-label">Account Name</label>
                <div class="col-sm-10">
                    <select class="form-control select2" style="width: 100%;" name="page">
                        <?php
                        if ($json_page->num_rows() > 0) {
                            $j = 0;
                            foreach ($json_page->result_array() as $row) {
                                if($j==0)
                                    echo '<option value="'.$row['acc_id'].'" selected="selected">@'.$row['acc_screen_name'].'</option>';
                                else
                                    echo '<option value="'.$row['acc_id'].'">@'.$row['acc_screen_name'].'</option>';
                                $j++;
                            }
                        }
                        ?>
                    </select>
                </div>
            </div><!-- /.form-group -->
            
            <div class="form-group">
                <label for="inputTokenKey" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <?php echo $status;?>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <a class="btn btn-primary" href="<?php echo base_url('/twitter/crawler/'.$url.'/1');?>">Back</a>
                    <button type="submit" class="btn btn-success">Submit</button>
                    
                </div>
            </div>

        </form>
        <!--</div>-->


    </div>

</div>