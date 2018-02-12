<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
    </ul>

    <div class="tab-content">
        <!--<div class="tab-pane" id="settings">-->
        <?php echo $status;?>
        <form class="form-horizontal" action="<?php echo base_url('/service/submit_edit_profile/'.$url) ?>" method="post">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" name="name" value="<?php echo $name; ?>">
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
                <label for="inputRole" class="col-sm-2 control-label">Role</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputRole" name="role" value="<?php echo $role; ?>">
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
                    <button type="submit" class="btn btn-danger">Edit</button>
                </div>
            </div>
        </form>
        <!--</div>-->


    </div>

</div>