<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#settings" data-toggle="tab"><?php echo $title;?> Settings</a></li>
        </ul>

        <div class="tab-content">
            <!--<div class="tab-pane" id="settings">-->
            <?php echo $status; ?>
            <form class="form-horizontal" action="<?php echo base_url('/user/edit_user/'.$url.'/1') ?>" method="post">
                <input type="hidden" name="data_id" value="<?php echo $user_id; ?>" />
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="name" value="<?php echo $name; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputID" class="col-sm-2 control-label">ID Card</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputID" name="idcard" value="<?php echo $id_card; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputBio" class="col-sm-2 control-label">User Level</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="level_id" id="inputUserLevel">
                            <?php
                            if ($data_result->num_rows() > 0) {
                                $i = 0;
                                foreach ($data_result->result_array() as $row) {
                                    if ($i == 0) {
                                        if ($level_id == "") {
                                            echo '<option value="1" selected="selected">-- Level --</option>';
                                        } else {
                                            echo '<option value="' . $level_id . '" selected="selected">-- Level --</option>';
//                                            echo '<option value="' . $user_id . '" selected="selected">' . $name . '</option>';
                                        }
                                    }
                                    echo '<option value="' . $row['level_id'] . '">' . $row['name'] . '</option>';
                                    $i++;
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" name="email" value="<?php echo $email; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" name="password" value="<?php echo $password; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputRole" class="col-sm-2 control-label">Job Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputRole" name="job_title" value="<?php echo $job_title; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPhone" class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPhone" name="phone_number" value="<?php echo $phone_number; ?>">
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
                        <!--<input type="text" class="form-control" id="inputStreet" name="street" value="<?php // echo $street;  ?>">-->
                        <textarea class="form-control" rows="3" id="inputStreet" name="street" ><?php echo $street; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputBirhtday" class="col-sm-2 control-label">Birthday</label>
                    <div class="col-sm-10">
                        <!--<input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" name="birthday" value="<?php // echo $email;  ?>">-->
                        <input type="text" class="form-control" id="birthday" name="birthday" value="<?php echo $birthday; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputBio" class="col-sm-2 control-label">Bio</label>
                    <div class="col-sm-10">
                        <!--<input type="textarea" row class="form-control" id="inputBirhtday" name="bio" value="<?php // echo $bio;     ?>">-->
                        <textarea class="form-control" rows="3" id="inputBio" name="short_bio" ><?php echo $short_bio; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPP" class="col-sm-2 control-label">Profile Picture</label>
                    <div class="col-sm-10">
                        <input type="file" id="inputPP" name="profile_picture">
                    </div>
                </div>


                <div class="form-group">
                    <label for="inputSex" class="col-sm-2 control-label">Gender</label>
                    <!--<div class="radio">-->
                    <div class="radio col-sm-10">
                        <label>
                            <input type="radio" name="gender" id="radio_male" value="male" <?php echo $male; ?>>
                            Male
                        </label>
                        <label>
                            <input type="radio" name="gender" id="radio_female" value="female" <?php echo $female; ?>>
                            Female
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputStatus" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" name="status_account" id="inputStatus">
                            <?php
                            if ($status_account == "") {
                                echo '<option value="inactive" selected="selected">-- Status --</option>';
                            } else {
                                echo '<option value="' . $status_account . '" selected="selected">' . $status_account . '</option>';
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