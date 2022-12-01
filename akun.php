<?php require ('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Uzi Tailor | Master Akun</title>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini layout-fixed accent-danger">
<?php 
  session_start();
  
  if (!isset($_SESSION['username'])) {
      header("Location: index.php");
  }
  
  require ('koneksi.php');
  if($_SERVER['REQUEST_METHOD']=='POST'):
    $username = $_POST['username'];
    $password = $_POST['password'];
    $namakaryawan = $_POST['nama_karyawan'];
    $alamat = $_POST['alamat'];
    $kelamin = $_POST['kelamin'];
    $no_hp = $_POST['no_hp'];
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./image/" . $filename;
    if(isset($_POST['level'])) {
      $level = $_POST['level'];
      if ($level == "Admin") {
        $level = '1';
      } else if ($level = "Karyawan") {
        $level = '2';
      }
    }
    //query untuk insert data
    $sql = "INSERT INTO `karyawan` (`id_karyawan`, `username`, `nama_karyawan`, `alamat_karyawan`, `jenis_kelamin`, `no_hp`, `foto_profil`, `password`, `level`) VALUES ('', '$username', '$namakaryawan', '$alamat', '$kelamin', '$no_hp', '$filename', '$password', '$level')";
    //eksekusi query
    if(mysqli_query($koneksi, $sql)):
      move_uploaded_file($tempname, $folder);
      echo "<script type='text/javascript'>
      Swal.fire({
        title: 'Berhasil',
        text: 'Data berhasil ditambahkan',
        icon: 'success',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.value) {
          header('Location: barang.php');
        }
      })
    </script>";
      header("Location: akun.php");
      mysqli_close($koneksi);
    else:
      echo "<script type='text/javascript'>
      Swal.fire({
        title: 'Gagal',
        text: 'Data gagal ditambahkan',
        icon: 'error',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.value) {
          header('Location: barang.php');
        }
      })
    </script>";
    mysqli_close($koneksi);
    endif;
  endif;
?>
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.html" class="nav-link">Transaksi</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <?php require 'navbar.php' ?>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-danger elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link bg-danger">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <?php require 'profile.php';?>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="transaksi.php" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Transaksi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="progress.php" class="nav-link">
              <i class="nav-icon fa fa-shopping-basket"></i>
              <p>
                Order on Progress
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="barang.php" class="nav-link">
              <i class="nav-icon fas fa-tshirt"></i>
              <p>
                Master Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pembeli.php" class="nav-link">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Data Pembeli
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="riwayat.php" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Riwayat Transaksi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="laporan.php" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Laporan Penjualan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="akun.php" class="nav-link active">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Master Akun
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="konfigurasi.php" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Konfigurasi
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Master Akun</h1>
            <br>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
              Tambah</button> 
              <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Akun</b></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="nohp">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                  </div>
                  <div class="form-group">
                    <label for="nohp">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                    <label for="id">Nama Karyawan </label>
                    <input type="text" class="form-control" name="nama_karyawan" placeholder="Nama Karyawan" required>
                  </div>
                  <div class="form-group">
                    <label for="nama">Alamat</label>
                    <input type="text" class="form-control" name="alamat" placeholder="Alamat" required>
                  </div>
                  <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" name="kelamin">
                          <option>Laki - Laki</option>
                          <option>Perempuan</option>
                        </select>
                  </div>
                  <div class="form-group">
                    <label for="nohp">No HP</label>
                    <input type="number" class="form-control" name="no_hp" placeholder="No HP" required>
                  </div>
                  <div class="form-group">
                    <label for="uploadfile">Foto Profil</label>
                    <div class="form-group">
                      <input class="form-control" type="file" name="uploadfile" value="" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Level</label>
                    <select class="form-control" name="level">
                      <option>Admin</option>
                      <option>Karyawan</option>
                    </select>
                  </div>
                  <br>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                  <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                </div>
                </form>
                </div>
              </div>
            </div>
          <!-- Modal -->
          </div>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Master Akun</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0" style="height: 400px;">
            <table class="table table-head-fixed text-nowrap">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Jenis Kelamin</th>
                  <th>No Hp</th>
                  <th>Level</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
                //call koneksi.php
                include 'koneksi.php';
                //mysqli_query untuk menjalankan query
                $data = mysqli_query($koneksi,"select id_karyawan, username, nama_karyawan, alamat_karyawan, jenis_kelamin, no_hp, level from karyawan where level != 'Admin'");
                //no
                $no = 1;
                //while untuk menampilkan data
                while($d = mysqli_fetch_array($data)){
            ?>
                        <td><?php echo $d['nama_karyawan']; ?></td>
                        <td><?php echo $d['alamat_karyawan']; ?></td>
                        <td><?php echo $d['jenis_kelamin']; ?></td>
                        <td><?php echo $d['no_hp']; ?></td>
                        <td><?php echo $d['level']; ?></td>
                        <td>
                          <a href="./delete/delete_akun.php?id_karyawan=<?php echo $d['id_karyawan']; ?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                <?php
                    }
              ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php include 'footer.php' ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
</body>
</html>
