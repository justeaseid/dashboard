<div class="col-md-8">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
        </ul>

        <div class="tab-content">
            <!--<div class="tab-pane" id="settings">-->
            <?php echo $status; ?>
            <form class="form-horizontal" action="<?php echo base_url('/service/submit_edit_profile/') ?>" method="post">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="name" value="<?php echo $name; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputUserName" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputUserName" name="username" value="<?php echo $username; ?>" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputID" class="col-sm-2 control-label">ID Card</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputID" name="idcard" value="<?php echo $idcard; ?>" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" name="email" value="<?php echo $email; ?>" disabled>
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
                        <input type="text" class="form-control" id="inputRole" name="role" value="<?php echo $job_title; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPhone" class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPhone" name="phone" value="<?php echo $phone; ?>">
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
                        <input type="text" class="form-control" id="inputStreet" name="street" value="<?php echo $street; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputBirhtday" class="col-sm-2 control-label">Birhtday</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" value="<?php echo $birthday; ?>">
                        <!--<input type="text" class="form-control" id="datepicker" name="birhtday" value="<?php // echo $birhtday; ?>">-->
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputBio" class="col-sm-2 control-label">Bio</label>
                    <div class="col-sm-10">
                        <!--<input type="textarea" row class="form-control" id="inputBirhtday" name="bio" value="<?php // echo $bio; ?>">-->
                        <textarea class="form-control" rows="3" id="inputBio"><?php echo $bio; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPP" class="col-sm-2 control-label">Profile Picture</label>
                    <div class="col-sm-10">
                        <input type="file" id="inputPP">
                    </div>
                </div>


                <div class="form-group">
                    <label for="inputSex" class="col-sm-2 control-label">Gender</label>
                    <!--<div class="radio">-->
                    <div class="radio col-sm-10">
                        <label>
                            <input type="radio" name="sex" id="radio_male" value="male" <?php echo $is_male; ?>>
                            Male
                        </label>
                        <label>
                            <input type="radio" name="sex" id="radio_female" value="female" <?php echo $is_female; ?>>
                            Female
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </form>
            <!--</div>-->

        </div>

    </div>
</div>