<?php include 'user.php' ?>
<!-- Profile Image -->
<div class="card card-danger card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="<?php echo "image/" .$foto ?>" alt="User profile picture">
        </div>
        <h3 class="profile-username text-center"><?php echo $namak ?></h3>
        <p class="text-muted text-center"><?php echo $levelk ?></p>
        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
            <b>Alamat</b> <a class="float-right"><?php echo $alamatk ?></a>
            </li>
            <li class="list-group-item">
            <b>No Hp</b> <a class="float-right"><?php echo $no_hpk ?></a>
            </li>
        </ul>
    </div>
    <!-- /.card-body -->
</div>