<?php require ('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Uzi Tailor | Riwayat Transaksi</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed accent-danger">
<?php
  session_start();
  require ('koneksi.php');
  require ('config.php');
  require ('query.php');
  $crud = new crud();
  
  if (!isset($_SESSION['login'])) {
      header("Location: index.php");
  }
?>
<div class="wrapper">
  <!-- Navbar -->
  <?php require ('navbar.php'); ?>
  
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
            <a href="riwayat_karyawan.php" class="nav-link active">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Riwayat Transaksi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="konfigurasi_karyawan.php" class="nav-link">
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
            <h1 class="m-0">Riwayat Transaksi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Riwayat Transaksi</li>
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
          <!-- /.card-header -->
          <div class="card-body table-responsive" style="height: 450px;">
            <table class="table table-bordered table-striped" id="tb1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No Transaksi</th>
                  <th>Karyawan</th>
                  <th>Pembeli</th>
                  <th>Waktu</th>
                  <th>Total</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $data = $crud->selectRiwayat();
                $no = 1;
                if($data->rowCount()>0) {
                    while($d=$data->fetch(PDO::FETCH_ASSOC)) { 
              ?>
            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $d['kode_transaksi']; ?></td>
                <td><?php echo $d['nama_karyawan']; ?></td>
                <td><?php echo $d['nama_pembeli']; ?></td>
                <td><?php echo $d['waktu']; ?></td>
                <td><?php echo $d['total']; ?></td>
                <td>
                  <a href="detail_karyawan.php?detail=<?php echo $d['kode_transaksi']; ?>" class="btn btn-primary delete"><i class="fa-solid fa-eye"></i></a>
                </td>
            </tr>
            <?php 
                $no++;
                }}
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
  <script>
    $(function () {
      $("#tb1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
      }).buttons().container().appendTo('#tb1_wrapper .col-md-6:eq(0)');
    });
  </script>
</div>
<!-- ./wrapper -->
</body>
</html>
