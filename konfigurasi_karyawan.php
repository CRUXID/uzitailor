<?php require ('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Uzi Tailor | Master Akun</title>  
</head>

<body class="hold-transition sidebar-mini layout-fixed accent-danger">
<?php
  session_start();
  include 'koneksi.php';
  include 'user.php';
  
  if (!isset($_SESSION['login'])) {
      header("Location: index.php");
  }

  if(isset($_POST['update'])) {
    require ('koneksi.php');
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $nama = htmlspecialchars($_POST['nama']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $no_hp = htmlspecialchars($_POST['no_hp']);

    $query="UPDATE `karyawan` SET `username`='$username',`nama_karyawan`='$nama',`alamat_karyawan`='$alamat',`no_hp`='$no_hp', `password`='$password' WHERE id_karyawan='$uid'";
    mysqli_query($koneksi, $query);
    header("Location: konfigurasi.php");
  }
?>
<div class="wrapper">
  <!-- Navbar -->
  <?php require 'navbar.php' ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-danger elevation-4">
    <!-- Brand Logo -->
    <?php require 'logo.php' ?>

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
          <li class="nav-item">
            <a href="transaksi_karyawan.php" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Transaksi   
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="konfirmasi_karyawan.php" class="nav-link">
            <i class="nav-icon fa fa-solid fa-check"></i>
              <p>
                Konfirmasi Pesanan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="progress_karyawan.php" class="nav-link">
              <i class="nav-icon fa fa-shopping-basket"></i>
              <p>
                Order on Progress
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="barang_karyawan.php" class="nav-link">
              <i class="nav-icon fas fa-tshirt"></i>
              <p>
                Master Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pembeli_karyawan.php" class="nav-link">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Data Pembeli
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="riwayat_karyawan.php" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Riwayat Transaksi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="konfigurasi_karyawan.php" class="nav-link active">
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
            <h1 class="m-0">Konfigurasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Konfigurasi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <?php require 'profileconf.php' ?>
          </div>
          <!-- /.col -->
          <div class="col-md-9">
          <div class="card">
    <div class="card-body">
        <form method="POST">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $usernamek ?>" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo $passwordk ?>" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="nama_karyawan">Nama Karyawan </label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Karyawan" value="<?php echo $namak ?>" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?php echo $alamatk ?>" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="nohp">No HP</label>
                    <input type="number" class="form-control" name="no_hp" placeholder="No HP" value="<?php echo $no_hpk ?>" required>
                </div>
            </div>
        </div>
          <button type="submit" class="btn btn-primary float-right" name="update">Update</button>
        </form>
    </div>
</div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
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
</body>
</html>
