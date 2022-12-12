<?php require ('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Uzi Tailor | Order on Progress</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed accent-danger">
<?php
  session_start();
  require ('koneksi.php');

  if (!isset($_SESSION['login'])) {
      header("Location: index.php");
  }
  
  if(isset($_POST['lunas'])) {
    $kodetrx = $_POST['kode'];
    $sisabayar = $_POST['sisabayar'];
    $dibayar = $_POST['dibayar'];
    $tgljadi = $_POST['tgljadi'];

    if(isset($_POST['bayar'])) {
      $bayar = $_POST['bayar'];
      if($bayar < $sisabayar) {
        echo "<script type='text/javascript'>
          Swal.fire({
            title: 'Peringatan!',
            text: 'Status transaksi menjadi pending !',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'OK'
          }).then(result => {
            if(result.isConfirmed){
                window.location.href = 'pending.php?detail=$kodetrx&jadi=$tgljadi';
            }
        })
        </script>";
      } else if ($bayar >= $sisabayar) {
        $bayar = $bayar + $dibayar;
        $query="UPDATE `transaksi` SET  `dibayar`='$bayar', `sisa_pembayaran`='0', `status`='4', tgl_jadi='$tgljadi' WHERE kode_transaksi='$kodetrx'";
        mysqli_query($koneksi, $query);
        echo '<script>window.location="struk.php?detail='.$kodetrx.'"</script>';
      }
    } else {
      $bayar = 0;
    }
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
            <a href="konfirmasi.php" class="nav-link">
            <i class="nav-icon fa fa-solid fa-check"></i>
              <p>
                Konfirmasi Pesanan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="progress.php" class="nav-link active">
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
            <h1 class="m-0">Order on Progress</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Order on Progress</li>
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
              </thead>
              <tbody>
              <?php
                //call koneksi.php
                include 'koneksi.php';
                //mysqli_query untuk menjalankan query
                $data = mysqli_query($koneksi,"SELECT transaksi.kode_transaksi,transaksi.total, transaksi.dibayar, transaksi.sisa_pembayaran, transaksi.waktu, transaksi.tgl_jadi, status.nama_status FROM transaksi JOIN status ON transaksi.status = status.id_status WHERE transaksi.status != 1 AND transaksi.status !=4");
                //no
                $no = 1;
                //while untuk menampilkan data
                while($d = mysqli_fetch_array($data)){
              ?>
                  <td><?php echo $no;?></td>
                  <td><?php echo $d['kode_transaksi']; ?></td>
                  <td><?php echo $d['waktu']; ?></td>
                  <td><?php echo $d['tgl_jadi']; ?></td>
                  <td><?php echo $d['nama_status']; ?></td>
                  <td>
                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal<?php echo $d['kode_transaksi']; ?>">Pelunasan</a>
                    <!-- Modal -->
                    <div class="modal fade" id="modal<?php echo $d['kode_transaksi']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><b>Pelunasan</b></h5>
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
                                <input type="date" class="form-control" name="tgljadi" placeholder="Tanggal Jadi" value="<?php echo $d['tgl_jadi']; ?>" required>
                              </div>
                              <div class="form-group">
                                <label for="total">Total</label>
                                <input type="text" class="form-control" name="total" placeholder="Total" value="<?php echo $d['total']; ?>" readonly>
                              </div>
                              <div class="form-group">
                                <label for="jadi">Sisa Pembayaran</label>
                                <input type="text" class="form-control" name="sisabayar" placeholder="Sisa Pembayaran" value="<?php echo $d['sisa_pembayaran']; ?>" readonly>
                              </div>
                              <div class="form-group">
                                <label for="bayar">Dibayar</label>
                                <input type="number" class="form-control" name="bayar" placeholder="Bayar" value="0" required>
                                <input type="hidden" class="form-control" name="dibayar" placeholder="Dibayar" value="<?php echo $d['dibayar']; ?>">
                              </div>
                              <br>
                              <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                              <button type="submit" name="lunas" class="btn btn-success">Submit</button>
                            </div>
                            </form>
                            </div>
                          </div>
                        </div>
                        </div>
                    <!-- Modal -->
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
