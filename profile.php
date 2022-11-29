<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <?php
        $uname = $_SESSION['username'];
        require ('koneksi.php');
        $data = mysqli_query($koneksi,"SELECT * FROM karyawan WHERE username='$uname'");
        while($d = mysqli_fetch_array($data)){
    ?>
        <div class="image">
            <img src="<?php echo "image/" .$d['foto_profil']; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block"><b><?php echo $d['nama_karyawan']?></b></a>
        </div>
    <?php } ?>
</div>