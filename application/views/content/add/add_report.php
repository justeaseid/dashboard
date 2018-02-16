<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#settings" data-toggle="tab"><?php echo $title; ?> Settings</a></li>
        </ul>

        <div class="tab-content">
            <?php echo $status; ?>
            <form class="form-horizontal" action="<?php echo base_url('/report/insert_report/' . $url . '/1') ?>" method="post">
                <div class="form-group">
                    <label for="inputBio" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="user_id" id="inputUserID">
                            <?php
                            if ($user_result->num_rows() > 0) {
                                $i = 0;
                                foreach ($user_result->result_array() as $row) {
                                    if ($i == 0) {
                                        if ($user_id == "") {
                                            echo '<option value="1" selected="selected">-- Name --</option>';
                                        } else {
                                            echo '<option value="' . $user_id . '" selected="selected">-- Name --</option>';
//                                            echo '<option value="' . $user_id . '" selected="selected">' . $name . '</option>';
                                        }
                                    }
                                    echo '<option value="' . $row['user_id'] . '">' . $row['name'] . '</option>';
                                    $i++;
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputCampaign" class="col-sm-2 control-label">Campaign</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="campaign_id" id="inputCampaign">
                            <?php
                            if ($campaign_result->num_rows() > 0) {
                                $i = 0;
                                foreach ($campaign_result->result_array() as $row) {
                                    if ($i == 0) {
                                        if ($campaign_id == "") {
                                            echo '<option value="1" selected="selected">-- Campaign --</option>';
                                        } else {
                                            echo '<option value="' . $campaign_id . '" selected="selected">-- Campaign --</option>';
//                                            echo '<option value="' . $user_id . '" selected="selected">' . $name . '</option>';
                                        }
                                    }
                                    echo '<option value="' . $row['campaign_id'] . '">' . $row['titles'] . '</option>';
                                    $i++;
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="inputMessage" class="col-sm-2 control-label">Message</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" id="inputMessage" name="message" ><?php echo $message; ?></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="inputValid" class="col-sm-2 control-label">Validation</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="is_valid" id="inputValid">
                            <?php
                            if ($is_promoted == "") {
                                echo '<option value="not valid" selected="selected">-- Validation --</option>';
                            } else {
                                echo '<option value="' . $is_valid . '" selected="selected">' . $is_valid . '</option>';
                            }
                            ?>
                            <option value="valid">Valid</option>
                            <option value="not valid">Not Valid</option>
                        </select>
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