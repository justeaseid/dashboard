<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#settings" data-toggle="tab"><?php echo $title; ?> Settings</a></li>
        </ul>

        <div class="tab-content">
            <?php echo $status; ?>
            <form class="form-horizontal" action="<?php echo base_url('/log/insert_log/' . $url . '/1') ?>" method="post">
                <div class="form-group">
                    <label for="inputBio" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="user_id" id="inputUserID">
                            <?php
                            if ($data_result->num_rows() > 0) {
                                $i = 0;
                                foreach ($data_result->result_array() as $row) {
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
                    <label for="inputBio" class="col-sm-2 control-label">Type</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="type" id="inputType">
                            <?php
                            if ($type == "") {
                                echo '<option value="log" selected="selected">-- Type --</option>';
                            } else {
                                echo '<option value="' . $type . '" selected="selected">' . $type . '</option>';
                            }
                            ?>
                            <option value="blog">Blog</option>
                            <option value="campaign">Campaign</option>
                            <option value="case category">Case Category</option>
                            <option value="article category">Article Category</option>
                            <option value="donation">Donation</option>
                            <option value="lawyer">Lawyer</option>
                            <option value="log">Log</option>
                            <option value="operational cost">Operational Cost</option>
                            <option value="payment">Payment</option>
                            <option value="report">Report</option>
                            <option value="user">User</option>
                            <option value="user level">User Level</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputBio" class="col-sm-2 control-label">Action</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="action" id="inputAction">
                            <?php
                            if ($type == "") {
                                echo '<option value="create" selected="selected">-- Action --</option>';
                            } else {
                                echo '<option value="' . $action . '" selected="selected">' . $action . '</option>';
                            }
                            ?>
                            <option value="create">Create</option>
                            <option value="update">Update</option>
                            <option value="delete">Delete</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputActivity" class="col-sm-2 control-label">Activity</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" id="inputActivity" name="activity"><?php echo $activity; ?></textarea>
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