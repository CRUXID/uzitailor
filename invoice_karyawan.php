<?php require ('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Uzi Tailor | Invoice</title>  
</head>

<body class="hold-transition sidebar-mini layout-fixed accent-danger">
<?php
  session_start();
  include 'koneksi.php';
  include 'user.php';
  
  if (!isset($_SESSION['login'])) {
      header("Location: index.php");
  }

  $noinv = $_GET['detail'];
  if(!empty($_GET['detail'])){
  } else {
    echo '<script>history.go(-1);</script>';
  }; 

  $DataInv = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM transaksi WHERE kode_transaksi = '$noinv'"));
  $Dbayar = $DataInv['dibayar'];
  $Dkembali = $DataInv['sisa_pembayaran'];
  $Datee = $DataInv['waktu'];
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
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <h1 class="h3 mb-2">Invoice Transaksi
          <span class="float-right">
          <a href="transaksi_karyawan.php" class="btn btn-danger btn-sm px-3 mr-1">Kembali</a>
          <button type="button" class="btn btn-primary btn-sm px-3"  onclick="document.title='Invoice#<?php echo $noinv ?>';window.print()">Cetak</button>
          </span>
        </h1>
          <div class="bg-danger p-2 text-white" style="border-radius:0.25rem;">
            <div class="row">
                <div class="col-lg-6"><h5 class="mb-0">No. Invoice : <?php echo $noinv ?></h5></div>
                <div class="col-lg-6 text-right"><h5 class="mb-0 date-inv">Tanggal : <?php echo $Datee ?></h5></div>
            </div>
          </div>
          <table class="table table-striped table-sm table-bordered dt-responsive nowrap print-none" id="cart" width="100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Harga</th>
              <th>Qty</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
          <?php 
            $no = 1;
            $tot_bayar = 0;
            $data_laporan = mysqli_query($koneksi,"SELECT detail_transaksi.kode_barang, master_barang.nama_barang,master_barang.harga,detail_transaksi.qty,detail_transaksi.sub_total FROM detail_transaksi JOIN master_barang ON master_barang.kode_barang = detail_transaksi.kode_barang WHERE kode_transaksi = '$noinv'");
            while($d = mysqli_fetch_array($data_laporan)){
          ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $d['kode_barang']; ?></td>
              <td><?php echo $d['nama_barang']; ?></td>
              <td>Rp.<?php echo $d['harga']; ?></td>
              <td><?php echo $d['qty']; ?></td>
              <td>Rp.<?php echo $d['sub_total']; ?></td>
            </tr>
            <?php } ?>
          </tbody>
          </table>
          <?php
            $i4 = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT total FROM transaksi WHERE kode_transaksi='$noinv'"));
          ?>
          <div class="row justify-content-end mt-1">
              <div class="col-sm-6 col-md-5 col-lg-4">
                  <div class="bg-danger text-white p-2">
                      <h6 class="mb-0">Total
                          <span class="float-right">Rp.<?php echo $i4['total']; ?></span>
                      </h6>
                  </div>
                  <div class="bg-light p-2">
                      <h6 class="mb-2">Pembayaran
                      <span class="float-right">Rp.<?php echo $Dbayar; ?></span>
                      </h6>
                      <h6 class="mb-0">Sisa Pembayaran
                      <span class="float-right">Rp.<?php echo $Dkembali; ?></span>
                      </h6>
                  </div>
              </div>
          </div>
          
          <!-- data print -->
          <section id="print">
              <div class="d-none pt-5 px-5 print-show">
                  <div class="text-center mb-5 pt-2">
                      <h2 class="mb-3" style="font-size:60px;">Uzi Tailor</h2>
                      <h2 class="mb-0">Jl. Mastrip Lama</h2>
                      <h2 class="mb-4">Telp : 0895-1024-5695</h2>
                  </div>
                      <h2 class="mb-1">Invoice : <?php echo $noinv ?>
                      <span class="float-right">Kasir : <?php echo $namak ?></span></h2>
                      <h2 class="mb-1">Tanggal : <?php echo $Datee ?></h2>
                  <div class="row">
                      <div class="col-12 py-3 my-3 border-top border-bottom">
                          <div class="row">
                              <div class="col-5"><h2 class="mb-0 py-1" style="font-weight:700;">Description</h2></div>
                              <div class="col-2"><h2 class="mb-0 py-1" style="font-weight:700;">Harga</h2></div>
                              <div class="col-2"><h2 class="mb-0 py-1" style="font-weight:700;">Qty</h2></div>
                              <div class="col-3"><h2 class="mb-0 py-1" style="font-weight:700;">Jumlah</h2></div>
                          </div>
                      </div>
                      <?php 
                      $no = 1;
                      $dataprint = mysqli_query($koneksi,"SELECT detail_transaksi.kode_barang, master_barang.nama_barang,master_barang.harga,detail_transaksi.qty,detail_transaksi.sub_total FROM detail_transaksi JOIN master_barang ON master_barang.kode_barang = detail_transaksi.kode_barang WHERE kode_transaksi = '$noinv'");
                      while($c = mysqli_fetch_array($dataprint)){ ?>
                      <div class="col-12">
                          <div class="row">
                              <div class="col-5"><h2 class="mb-0 py-1" style="font-weight:500;"><?php echo $c['nama_barang']; ?></h2></div>
                              <div class="col-2"><h2 class="mb-0 py-1" style="font-weight:500;"><?php echo $c['harga']; ?></h2></div>
                              <div class="col-2"><h2 class="mb-0 py-1" style="font-weight:500;"><?php echo $c['qty']; ?></h2></div>
                              <div class="col-3"><h2 class="mb-0 py-1" style="font-weight:500;"><?php echo $c['sub_total']; ?></h2></div>
                          </div>
                      </div>
                      <?php } ?>
                      <div class="col-12 py-3 my-3 border-top">
                          <div class="row justify-content-end">
                              <div class="col-3 text-right border-bottom">
                                  <h2 class="mb-1" style="font-weight:700;">Total <span class="ml-3">:</span></h2>
                                  <h2 class="mb-1" style="font-weight:500;">DP <span class="ml-3">:</span></h2>
                                  <h2 class="mb-1" style="font-weight:500;">Kurang<span class="ml-3">:</span></h2>
                              </div>
                              <div class="col-3 border-bottom">
                                  <h2 class="mb-1" style="font-weight:700;"><?php echo $i4['total']; ?></h2>
                                  <h2 class="mb-1" style="font-weight:500;"><?php echo $Dbayar; ?></h2>
                                  <?php 
                                    if($Dkembali < 0) { 
                                  ?>
                                    <h2 class="mb-1" style="font-weight:500;">- <?php echo $Dkembali; ?></h2>
                                  <?php } else if ($Dkembali >= 0){ ?>
                                    <h2 class="mb-1" style="font-weight:500;"><?php echo $Dkembali; ?></h2>
                                  <?php } ?>
                              </div>
                          </div>
                      </div>
                      <div class="col-12 text-center mt-5">
                          <h2>* Terima Kasih Telah Berbelanja Di Uzi Tailor *</h2>
                      </div>
                  </div><!-- end row -->
              </div><!-- end box print -->
          </section> 
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
  <script>
    $(function () {
      $("#cart").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false, "bPaginate": false, "bInfo" : false,
      }).buttons().container().appendTo('#tb1_wrapper .col-md-6:eq(0)');
    });
  </script>
</div>
<!-- ./wrapper -->
</body>
</html>
