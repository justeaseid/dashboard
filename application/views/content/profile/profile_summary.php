<div class="box box-primary">
    <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?php echo $profile_image; ?>" alt="<?php echo $name; ?>">
        <h3 class="profile-username text-center"><?php echo $name; ?></h3>
        <p class="text-muted text-center">Member since <b><?php echo date("d F Y", strtotime($date_created)); ?></b></p>
        <p class="text-muted text-center">Has access as <b><?php echo $access; ?></b></p>
    </div><!-- /.box-body -->
</div>