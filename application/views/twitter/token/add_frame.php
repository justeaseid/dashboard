<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
    </ul>

    <div class="tab-content">
        <!--<div class="tab-pane" id="settings">-->
        <form class="form-horizontal" action="<?php echo base_url('/twitter/insert_token/'.$url.'/1') ?>" method="post">
            <div class="form-group">
                <label for="inputTokenName" class="col-sm-2 control-label">Token Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" name="token_name" value="<?php echo $token_name;?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAppsID" class="col-sm-2 control-label">Consumer Key</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputConsumerKey" name="consumer_key" value="<?php echo $consumer_key;?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAppsID" class="col-sm-2 control-label">Consumer Secret</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputConsumerSecret" name="consumer_secret" value="<?php echo $consumer_secret;?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputSecretKey" class="col-sm-2 control-label">Token Key</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputTokenKey" name="token_key" value="<?php echo $token_key;?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputSecretKey" class="col-sm-2 control-label">Token Secret</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputTokenSecret" name="token_secret" value="<?php echo $token_secret;?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputSubmit" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <?php echo $status;?>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <a class="btn btn-primary" href="<?php echo base_url('/twitter/token/'.$url.'/1');?>">Back</a>
                    <button type="submit" class="btn btn-success">Submit</button>
                    
                </div>
            </div>
        </form>
        <!--</div>-->


    </div>

</div>