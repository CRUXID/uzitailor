<!-- Profile Image -->
<div class="card card-danger card-outline">
    <?php
        $uname = $_SESSION['username'];
        require ('koneksi.php');
        $data = mysqli_query($koneksi,"SELECT * FROM karyawan WHERE username='$uname'");
        while($d = mysqli_fetch_array($data)){
    ?>
    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="<?php echo "image/" .$d['foto_profil']; ?>" alt="User profile picture">
        </div>
        <h3 class="profile-username text-center"><?php echo $d['nama_karyawan']; ?></h3>
        <p class="text-muted text-center"><?php echo $d['level']; ?></p>
        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
            <b>Alamat</b> <a class="float-right"><?php echo $d['alamat_karyawan']; ?></a>
            </li>
            <li class="list-group-item">
            <b>No Hp</b> <a class="float-right"><?php echo $d['no_hp']; ?></a>
            </li>
        </ul>
    </div>
    <!-- /.card-body -->
    <?php } ?>
</div>