<?php require ('header.php'); ?>
<?php 
  require ('koneksi.php');
  $dataselect = mysqli_query($koneksi, "SELECT * FROM master_barang");
  $jsArray = "var nama_barang = new Array();";
  $jsArray2 = "var harga = new Array();";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Uzi Tailor | Transaksi</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed accent-danger">
<?php 
  session_start();
  
  if (!isset($_SESSION['login'])) {
      header("Location: index.php");
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
            <a href="transaksi.php" class="nav-link active">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Transaksi   
              </p>
            </a>
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
            <h1 class="m-0">Transaksi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item "><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Transaksi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <form method="post">
          <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-3 mb-3">
              <label class="small text-muted mb-1">Kode Produk</label>
              <div class="position-relative">
                <input type="text" name="Ckdproduk" class="form-control form-control-sm" list="datalist1" onchange="changeValue(this.value)" required autofocus>
                <datalist id="datalist1">
                    <?php if(mysqli_num_rows($dataselect)) {?>
                        <?php while($row_brg= mysqli_fetch_array($dataselect)) {?>
                            <option value="<?php echo $row_brg["kode_barang"]?>"> <?php echo $row_brg["kode_barang"]?>
                        <?php $jsArray .= "nama_barang['" . $row_brg['nama_barang'] . "'] = {nama_barang:'" . addslashes($row_brg['nama_barang']) . "'};";
                        $jsArray2 .= "harga['" . $row_brg['kode_barang'] . "'] = {harga:'" . addslashes($row_brg['harga']) . "'};"; } ?>
                    <?php } ?>
                </datalist>
              </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-3 mb-3">
              <label class="small text-muted mb-1">Nama Produk</label>
              <input type="text" name="nama" id="nama" class="form-control form-control-sm bg-light" readonly> 
            </div>

            <div class="col-8 col-sm-4 col-md-4 col-lg-2 mb-3">
              <label class="small text-muted mb-1">Harga</label>
              <input type="number" name="harga" placeholder="0" id="harga" onchange="InputSub()"
              class="form-control form-control-sm bg-light" readonly>
            </div>

            <div class="col-4 col-sm-4 col-md-4 col-lg-1 mb-3">
              <label class="small text-muted mb-1">Qty</label>
              <input type="number" name="qty" id="qty" onchange="InputSub()" placeholder="0" class="form-control form-control-sm" required>
            </div>

            <div class="col-sm-8 col-md-8 col-lg-3 mb-3">
              <label class="small text-muted mb-1">Subtotal</label>
              <div class="input-group">
                <input type="number" name="subtotal" placeholder="0" id="subtotal" onchange="InputSub()" class="form-control form-control-sm bg-light mr-2" readonly>
              <div class="input-group-append">
                <button type="reset" class="btn btn-danger btn-sm mr-2">Reset</button>
                <button type="submit" name="InputCart" class="btn btn-primary btn-sm">Simpan</button>
              </div>
              </div>
            </div>
          </div>
        </form>
        <?php 
          if(isset($_POST['InputCart']))
          {
              $kode = htmlspecialchars($_POST['kode']);
              $nama = htmlspecialchars($_POST['nama']);
              $harga = htmlspecialchars($_POST['harga']);
              $qty = htmlspecialchars($_POST['qty']);
              $subtotal = htmlspecialchars($_POST['sub_total']);

              $cekDulu = mysqli_query($koneksi,"SELECT * FROM cart ");
              $liat = mysqli_num_rows($cekDulu);
              $f = mysqli_fetch_array($cekDulu);
              $inv_c = $f['invoice'];
              $ii = htmlspecialchars($_POST['Cqty']);

              if($liat>0){
                $cekbrg = mysqli_query($koneksi,"SELECT * FROM cart WHERE kode_produk='$Input1' and invoice='$inv_c'");
                $liatlg = mysqli_num_rows($cekbrg);
                $brpbanyak = mysqli_fetch_array($cekbrg);
                $jmlh = $brpbanyak['qty'];
                $jmlh1 = $brpbanyak['harga'];
                
                if($liatlg>0){
                  $i = htmlspecialchars($_POST['Cqty']);
                  $baru = $jmlh + $i;
                  $baru1 = $jmlh1 * $baru;

                  $updateaja = mysqli_query($koneksi,"UPDATE cart SET qty='$baru', subtotal='$baru1' WHERE invoice='$inv_c' and kode_produk='$Input1'");
                  if($updateaja){
                    echo '<script>window.location="index.php"</script>';
                  } else {
                    echo '<script>window.location="index.php"</script>';
                  }
                } else {
                $tambahdata = mysqli_query($koneksi,"INSERT INTO cart (invoice,kode_produk,nama_produk,harga,harga_modal,qty,subtotal)
                values('$inv_c','$Input1','$Input2','$Input3','$hrg_m','$ii','$Input5')");
                if ($tambahdata){
                    echo '<script>window.location="index.php"</script>';
                } else { echo '<script>window.location="index.php"</script>';
                }
                };
          } else {
            
            $queryStar = mysqli_query($koneksi, "SELECT max(invoice) as kodeTerbesar FROM inv");
            $data = mysqli_fetch_array($queryStar);
            $kodeInfo = $data['kodeTerbesar'];
            $urutan = (int) substr($kodeInfo, 8, 2);
            $urutan++;
            $huruf = "AD";
            $oi = $huruf . date("jnyGi") . sprintf("%02s", $urutan);
              
              $bikincart = mysqli_query($koneksi,"INSERT INTO inv (invoice,pembayaran,kembalian,status) values('$oi','','','proses')");
              if($bikincart){
                $tambahuser = mysqli_query($koneksi,"INSERT INTO cart (invoice,kode_produk,nama_produk,harga,harga_modal,qty,subtotal)
                values('$oi','$Input1','$Input2','$Input3','$hrg_m','$ii','$Input5')");
                if ($tambahuser){
                  echo '<script>window.location="index.php"</script>';
                } else { echo '<script>window.location="index.php"</script>';
                }
              } else {
                
              }
          }
          };
          $DataInv = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM cart LIMIT 1"));
          $noinv = $DataInv['kode_transaksi'];
          ?>
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
</body>
</html>
