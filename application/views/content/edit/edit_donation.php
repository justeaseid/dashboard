<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#settings" data-toggle="tab"><?php echo $title; ?> Settings</a></li>
        </ul>

        <div class="tab-content">
            <?php echo $status; ?>
            <form class="form-horizontal" action="<?php echo base_url('/donation/edit_donation/' . $url . '/1') ?>" method="post">
                <input type="hidden" name="data_id" value="<?php echo $donation_id; ?>" />
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
                    <label for="inputPayment" class="col-sm-2 control-label">Payment Method</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="payment_id" id="inputPayment">
                            <?php
                            if ($payment_result->num_rows() > 0) {
                                $i = 0;
                                foreach ($payment_result->result_array() as $row) {
                                    if ($i == 0) {
                                        if ($payment_id == "") {
                                            echo '<option value="1" selected="selected">-- Payment --</option>';
                                        } else {
                                            echo '<option value="' . $payment_id . '" selected="selected">-- Payment --</option>';
//                                            echo '<option value="' . $user_id . '" selected="selected">' . $name . '</option>';
                                        }
                                    }
                                    echo '<option value="' . $row['payment_id'] . '">' . $row['name'] . '</option>';
                                    $i++;
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputForCampaign" class="col-sm-2 control-label">for Campaign</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputForCampaign" name="amount_for_campaign" value="<?php echo $amount_for_campaign; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputForCompany" class="col-sm-2 control-label">for Company</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputForCompany" name="amount_for_company" value="<?php echo $amount_for_company; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputComment" class="col-sm-2 control-label">Comment</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" id="inputComment" name="comment" ><?php echo $comment; ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputAnymous" class="col-sm-2 control-label">Is Anymous</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="is_anymous" id="inputAnymous">
                            <?php
                            if ($is_promoted == "") {
                                echo '<option value="no" selected="selected">-- Anymous Mode --</option>';
                            } else {
                                echo '<option value="' . $is_anymous . '" selected="selected">' . $is_anymous . '</option>';
                            }
                            ?>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputExp" class="col-sm-2 control-label">Expired Donation</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="strdate" name="expired_date" value="<?php echo $expired_date; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputVerStatus" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="status" id="inputVerStatus">
                            <?php
                            if ($status == "") {
                                echo '<option value="inactive" selected="selected">-- Donation Status --</option>';
                            } else {
                                echo '<option value="' . $status . '" selected="selected">' . $status . '</option>';
                            }
                            ?>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>  
                <div class="form-group">
                    <label for="inputVerCode" class="col-sm-2 control-label">Verification Code</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputVerCode" name="verification_code" value="<?php echo $verification_code; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPP" class="col-sm-2 control-label">Struk Payment</label>
                    <div class="col-sm-10">
                        <input type="file" id="inputPP" name="struk_payment">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-danger" onclick="window.history.go(-1); return false;">
                            <i class="fa "></i> Back
                        </button>
                        <button type="submit" class="btn btn-primary">Edit</button>

                    </div>
                </div>
            </form>
            <!--</div>-->

        </div>

    </div>
</div>