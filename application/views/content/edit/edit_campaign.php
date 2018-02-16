<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#settings" data-toggle="tab"><?php echo $title; ?> Settings</a></li>
        </ul>

        <div class="tab-content">
            <?php echo $status; ?>
            <form class="form-horizontal" action="<?php echo base_url('/campaign/edit_campaign/' . $url . '/1') ?>" method="post">
                <input type="hidden" name="data_id" value="<?php echo $campaign_id; ?>" />
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
                    <label for="inputTitle" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputTitle" name="titles" value="<?php echo $titles; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCategory" class="col-sm-2 control-label">Category</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="category_id" id="inputCategory">
                            <?php
                            if ($case_result->num_rows() > 0) {
                                $i = 0;
                                foreach ($case_result->result_array() as $row) {
                                    if ($i == 0) {
                                        if ($category_id == "") {
                                            echo '<option value="1" selected="selected">-- Category --</option>';
                                        } else {
                                            echo '<option value="' . $category_id . '" selected="selected">-- Category --</option>';
//                                            echo '<option value="' . $user_id . '" selected="selected">' . $name . '</option>';
                                        }
                                    }
                                    echo '<option value="' . $row['category_id'] . '">' . $row['name'] . '</option>';
                                    $i++;
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDesc" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" id="inputDesc" name="description"><?php echo $description; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCountry" class="col-sm-2 control-label">Country</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputCountry" name="country" value="<?php echo $country; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCity" class="col-sm-2 control-label">City</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputCity" name="city" value="<?php echo $city; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputStreet" class="col-sm-2 control-label">Street</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" id="inputStreet" name="street" ><?php echo $street; ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputLawyer" class="col-sm-2 control-label">Lawyer</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="lawyer_id" id="inputLawyer">
                            <?php
                            if ($lawyer_result->num_rows() > 0) {
                                $i = 0;
                                foreach ($lawyer_result->result_array() as $row) {
                                    if ($i == 0) {
                                        if ($lawyer_id == "") {
                                            echo '<option value="1" selected="selected">-- Lawyer --</option>';
                                        } else {
                                            echo '<option value="' . $lawyer_id . '" selected="selected">-- Lawyer --</option>';
//                                            echo '<option value="' . $user_id . '" selected="selected">' . $name . '</option>';
                                        }
                                    }
                                    echo '<option value="' . $row['lawyer_id'] . '">' . $row['name'] . '</option>';
                                    $i++;
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputMin" class="col-sm-2 control-label">Min. Donation</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputMin" name="min_donation" value="<?php echo $min_donation; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputMax" class="col-sm-2 control-label">Max. Donation</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputMax" name="max_donation" value="<?php echo $max_donation; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputApv" class="col-sm-2 control-label">Approved Donation</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputApv" name="approved_donation" value="<?php echo $approved_donation; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputExp" class="col-sm-2 control-label">Expired Donation</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="strdate" name="expired_donation" value="<?php echo $expired_donation;  ?>">
                        <!--<input type="text" class="form-control" id="expired" name="expired" value="<?php // echo $expired_donation; ?>">-->
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputOperational" class="col-sm-2 control-label">Operational Cost</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="operational_id" id="inputOperational">
                            <?php
                            if ($operational_result->num_rows() > 0) {
                                $i = 0;
                                foreach ($operational_result->result_array() as $row) {
                                    if ($i == 0) {
                                        if ($lawyer_id == "") {
                                            echo '<option value="1" selected="selected">-- Operational Cost --</option>';
                                        } else {
                                            echo '<option value="' . $operational_id . '" selected="selected">-- Operational Cost --</option>';
//                                            echo '<option value="' . $user_id . '" selected="selected">' . $name . '</option>';
                                        }
                                    }
                                    echo '<option value="' . $row['operational_id'] . '">' . $row['name'] . '</option>';
                                    $i++;
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputLaunch" class="col-sm-2 control-label">Launch Date</label>
                    <div class="col-sm-10">
                        <!--<input type="text" class="form-control" id="launch_date" name="launch_date" value="<?php // echo $launch_date;  ?>">-->
                        <input type="text" class="form-control" id="strdate1" name="launch_date" value="<?php echo $launch_date; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputVerStatus" class="col-sm-2 control-label">Verification Status</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="verification_status" id="inputVerStatus">
                            <?php
                            if ($verification_status == "") {
                                echo '<option value="inactive" selected="selected">-- Verification Status --</option>';
                            } else {
                                echo '<option value="' . $verification_status . '" selected="selected">' . $verification_status . '</option>';
                            }
                            ?>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCampStatus" class="col-sm-2 control-label">Campaign Status</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="status" id="inputCampStatus">
                            <?php
                            if ($status == "") {
                                echo '<option value="new" selected="selected">-- Campaign Status --</option>';
                            } else {
                                echo '<option value="' . $status . '" selected="selected">' . $status . '</option>';
                            }
                            ?>
                            <option value="new">New</option>
                            <option value="on review">On Review</option>
                            <option value="started">Started</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputReported" class="col-sm-2 control-label">Reported</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="is_reported" id="inputReported">
                            <?php
                            if ($is_reported == "") {
                                echo '<option value="no" selected="selected">-- Reported --</option>';
                            } else {
                                echo '<option value="' . $is_reported . '" selected="selected">' . $is_reported . '</option>';
                            }
                            ?>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPromoted" class="col-sm-2 control-label">Promoted</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="is_promoted" id="inputPromoted">
                            <?php
                            if ($is_promoted == "") {
                                echo '<option value="no" selected="selected">-- Promoted --</option>';
                            } else {
                                echo '<option value="' . $is_promoted . '" selected="selected">' . $is_promoted . '</option>';
                            }
                            ?>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
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
                    <label for="inputPP" class="col-sm-2 control-label">Cover Photo</label>
                    <div class="col-sm-10">
                        <input type="file" id="inputPP" name="cover_photo">
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