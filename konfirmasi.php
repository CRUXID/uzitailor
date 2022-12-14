<?php require ('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Uzi Tailor | Konfirmasi Pesanan</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed accent-danger">
<?php
  session_start();
  include 'koneksi.php';
  include 'user.php';
  
  if (!isset($_SESSION['login'])) {
      header("Location: index.php");
  }
  
  if(isset($_POST['lunas'])) {
    $kodetrx = $_POST['kode'];
    $tgljadi = $_POST['jadi'];
    $total = $_POST['total'];
    $dibayar = $_POST['dibayar'];
    $sisa = $_POST['sisa'];
    
    $query="UPDATE `transaksi` SET `karyawan`='$uid', `total`='$total', `dibayar`='$dibayar', `sisa_pembayaran`='$sisa', `status`='2', `tgl_jadi`='$tgljadi' WHERE kode_transaksi='$kodetrx'";
    mysqli_query($koneksi, $query);
    echo "<script type='text/javascript'>
      Swal.fire({
        title: 'Berhasil',
        text: 'Transaksi Dikonfirmasi!',
        icon: 'success',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.value) {
          header('Location: konfirmasi.php');
        }
      })
    </script>";
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
          </li>
          <li class="nav-item">
            <a href="konfirmasi.php" class="nav-link active">
            <i class="nav-icon fa fa-solid fa-check"></i>
              <p>
                Konfirmasi Pesanan
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
            <a href="akun.php" class="nav-link">
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
            <h1 class="m-0">Konfirmasi Pesanan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Konfirmasi Pesanan</li>
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
                  <th>Kode Transaksi</th>
                  <th>Waktu Pembelian</th>
                  <th>Tanggal Jadi</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              <thead>
              <tbody>
              <?php
                //call koneksi.php
                include 'koneksi.php';
                //mysqli_query untuk menjalankan query
                $data = mysqli_query($koneksi,"SELECT transaksi.kode_transaksi,transaksi.waktu, transaksi.tgl_jadi, status.nama_status, transaksi.total, transaksi.dibayar, transaksi.sisa_pembayaran FROM transaksi JOIN status ON transaksi.status = status.id_status WHERE transaksi.status = 1");
                //no
                $no = 1;
                //while untuk menampilkan data
                while($d = mysqli_fetch_array($data)){
            ?>
            <tr>
            <td><?php echo $no;?></td>
                        <td><?php echo $d['kode_transaksi']; ?></td>
                        <td><?php echo $d['waktu']; ?></td>
                        <td><?php echo $d['tgl_jadi']; ?></td>
                        <td><?php echo $d['nama_status']; ?></td>
                        <td>
                          <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal<?php echo $d['kode_transaksi']; ?>">Konfirmasi</a>
                          <!-- Modal -->
                          <div class="modal fade" id="modal<?php echo $d['kode_transaksi']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><b>Konfirmasi</b></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                  <form method="POST">
                                    <div class="form-group">
                                      <label for="kode">Kode Transaksi</label>
                                      <input type="text" class="form-control" name="kode" placeholder="Kode Transaksi" value="<?php echo $d['kode_transaksi']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                      <label for="beli">Tanggal Beli</label>
                                      <input type="text" class="form-control" name="beli" placeholder="Waktu Pembelian" value="<?php echo $d['waktu']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                      <label for="jadi">Tanggal Jadi</label>
                                      <input type="date" class="form-control" name="jadi" placeholder="Tanggal Jadi" value="<?php echo $d['tgl_jadi']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                      <label for="total">Total</label>
                                      <input type="number" class="form-control" name="total" placeholder="Total" value="<?php echo $d['total']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                      <label for="dibayar">Dibayar</label>
                                      <input type="number" class="form-control" onchange="sisabayar()" name="dibayar" id="bayar" placeholder="Dibayar" value="<?php echo $d['dibayar']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                      <label for="sisa">Sisa Pembayaran</label>
                                      <input type="number" class="form-control" name="sisa" id="sisa" placeholder="Sisa Pembayaran" value="<?php echo $d['sisa_pembayaran']; ?>" readonly>
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                    <button type="submit" name="lunas" class="btn btn-success">konfirmasi</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                          </div>
                </td>
            </tr>
            <?php 
                $no++;
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
  <script>
    function sisabayar() {
      var total = parseInt(document.getElementById('total').value);
      var bayar = parseInt(document.getElementById('bayar').value);
      var sisa = total - bayar;

      document.getElementById('sisa').value = sisa;
    }
  </script>
  <script>
    $(function () {
      $("#tb1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
      }).buttons().container().appendTo('#tb1_wrapper .col-md-6:eq(0)');
    });
  </script>
</div>
</body>
</html>
