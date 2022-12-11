<?php require ('header.php'); ?>
<?php 
  require ('koneksi.php');
  $dataselect = mysqli_query($koneksi, "SELECT * FROM master_barang");
  $datapembeli = mysqli_query($koneksi, "SELECT * FROM data_pembeli");
  $jsArray = "var nama_produk = new Array();";
  $jsArray1 = "var harga_jual = new Array();";
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
                <input type="text" name="kode" class="form-control form-control-sm" list="datalist1" onchange="changeValue(this.value)" required autofocus>
                <datalist id="datalist1">
                    <?php if(mysqli_num_rows($dataselect)) {?>
                        <?php while($row_brg= mysqli_fetch_array($dataselect)) {?>
                            <option value="<?php echo $row_brg["kode_barang"]?>"> <?php echo $row_brg["nama_barang"]?> </option>
                            <?php $jsArray .= "nama_produk['" . $row_brg['kode_barang'] . "'] = {nama_produk:'" . addslashes($row_brg['nama_barang']) . "'};";
                              $jsArray1 .= "harga_jual['" . $row_brg['kode_barang'] . "'] = {harga_jual:'" . addslashes($row_brg['harga']) . "'};"; } ?>
                        <?php } ?>
                </datalist>
              </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-3 mb-3">
              <label class="small text-muted mb-1">Nama Barang</label>
              <input type="text" name="nama" id="nama_produk" class="form-control form-control-sm bg-light" readonly> 
            </div>

            <div class="col-8 col-sm-4 col-md-4 col-lg-2 mb-3">
              <label class="small text-muted mb-1">Harga</label>
              <input type="number" name="harga" placeholder="0" id="harga_jual" onchange="InputSub()"
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
          include 'koneksi.php';
          include 'user.php';
          if(isset($_POST['InputCart']))
          {
              $kode = htmlspecialchars($_POST['kode']);
              $nama = htmlspecialchars($_POST['nama']);
              $harga = htmlspecialchars($_POST['harga']);
              $qty = htmlspecialchars($_POST['qty']);
              $subtotal = htmlspecialchars($_POST['subtotal']);

              $cekDulu = mysqli_query($koneksi,"SELECT * FROM cart ");
              $liat = mysqli_num_rows($cekDulu);
              $f = mysqli_fetch_array($cekDulu);
              $inv_c = $f['invoice'];
              $ii = htmlspecialchars($_POST['qty']);

              if($liat>0){
                $cekbrg = mysqli_query($koneksi,"SELECT * FROM cart WHERE kode_barang='$kode' and invoice='$inv_c'");
                $liatlg = mysqli_num_rows($cekbrg);
                $brpbanyak = mysqli_fetch_array($cekbrg);
                $jmlh = $brpbanyak['qty'];
                $jmlh1 = $brpbanyak['harga'];
                
                if($liatlg>0){
                  $i = htmlspecialchars($_POST['qty']);
                  $baru = $jmlh + $i;
                  $baru1 = $jmlh1 * $baru;

                  $updateaja = mysqli_query($koneksi,"UPDATE cart SET qty='$baru', sub_total='$baru1' WHERE invoice='$inv_c' and kode_barang='$kode'");
                  if($updateaja){
                    echo '<script>window.location="transaksi.php"</script>';
                  } else {
                    echo '<script>window.location="transaksi.php"</script>';
                  }
                } else {
                $tambahdata = mysqli_query($koneksi,"INSERT INTO cart (invoice,kode_barang,nama_barang,harga,qty,sub_total)
                values('$inv_c','$kode','$nama','$harga','$ii','$subtotal')");
                if ($tambahdata){
                    echo '<script>window.location="transaksi.php"</script>';
                } else { echo '<script>window.location="transaksi.php"</script>';
                }
                };
          } else {
            
            $queryStar = mysqli_query($koneksi, "SELECT max(kode_transaksi) as kodeTerbesar FROM transaksi");
            $data = mysqli_fetch_array($queryStar);
            $kodeInfo = $data['kodeTerbesar'];
            $urutan = (int) substr($kodeInfo, 8, 2);
            $urutan++;
            $huruf = "AD";
            $oi = $huruf . date("jnyGi") . sprintf("%02s", $urutan);
            
            $tambahuser = mysqli_query($koneksi,"INSERT INTO cart (invoice,kode_barang,nama_barang,harga,qty,sub_total)values('$oi','$kode','$nama','$harga','$ii','$subtotal')");
              if ($tambahuser){
                echo '<script>window.location="transaksi.php"</script>';
              } else { echo '<script>window.location="transaksi.php"</script>';
              }

          }
          };
          $DataInv = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM cart LIMIT 1"));
          //jika tidak ada data di cart
          if($DataInv == null){
            $noinv = "AD".date("jnyGi")."01";
          } else {
            $noinv = $DataInv['invoice'];
          }
          ?>
        <div class="bg-danger p-2 text-white" style="border-radius:0.25rem;">
          <h5 class="mb-0">No. Invoice : <?php echo $noinv ?></h5>
        </div>
        <br>
        <table class="table table-bordered table-striped" id="cart">
        <thead>
          <tr>
            <th>#</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        $no = 1;
        $tot_bayar = 0;
        $data_cart = mysqli_query($koneksi,"SELECT * FROM cart");
        while($d = mysqli_fetch_array($data_cart)){
            ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $d['kode_barang']; ?></td>
            <td><?php echo $d['nama_barang']; ?></td>
            <td>Rp.<?php echo $d['harga']; ?></td>
            <td><?php echo $d['qty']; ?></td>
            <td>Rp.<?php echo $d['sub_total']; ?></td>
            <td><a class="btn btn-danger btn-xs" href="?hapus=<?php echo $d['id_cart']; ?>">
                <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
              </td>
          </tr>
          <?php } ?>
        </tbody>
        </table>
        <?php 
          if(!empty($_GET['hapus'])){
            $idcart = $_GET['hapus'];
            $hapus_data_Cart = mysqli_query($koneksi, "DELETE FROM cart WHERE id_cart='$idcart'");
                if($hapus_data_Cart){
                    echo '<script>history.go(-1);</script>';
                } else {
                    echo '<script>alert("Gagal Hapus Data keranjang");history.go(-1);</script>';
                }
          };
          if(!empty($_GET['hapusAll'])){
            $noinvoicenya = $_GET['hapusAll'];
            $hapus_data_Cart_all = mysqli_query($koneksi, "DELETE FROM cart WHERE invoice='$noinvoicenya'");
            $hapus_data_Cart_all1 = mysqli_query($koneksi, "DELETE FROM transaksi WHERE kode_transaksi='$noinvoicenya'");
                if($hapus_data_Cart_all&&$hapus_data_Cart_all1){
                    echo '<script>history.go(-1);</script>';
                } else {
                    echo '<script>alert("Gagal Hapus Data keranjang");history.go(-1);</script>';
                }
          };
              $itungtrans = mysqli_query($koneksi,"SELECT SUM(sub_total) as jumlahtrans FROM cart");
              $itungtrans2 = mysqli_fetch_assoc($itungtrans);
              $itungtrans3 = $itungtrans2['jumlahtrans'];
          ?>
        <div class="bg-light p-3" style="border-radius:0.25rem;">
          <div class="row gy-3 align-items-center row-home">
            <div class="col-md-8 col-lg-6 mb-4">
            <form method="post">
              <input type="hidden" id="totalCart" value="<?php echo $itungtrans3; ?>">
              <div class="row">
                <label for="pembayaran" class="col-4 col-sm-4 col-md-4 col-lg-3 col-form-label col-form-label-sm mb-2">Pembeli</label>
                <div class="col-8 col-sm-8 col-md-8 col-lg-9 mb-2">
                  <input type="text" name="pembeli" class="form-control form-control-sm" list="datalist2" onchange="changeValue(this.value)" required autofocus>
                    <datalist id="datalist2">
                        <?php if(mysqli_num_rows($datapembeli)) {?>
                            <?php while($row_brg= mysqli_fetch_array($datapembeli)) {?>
                                <option value="<?php echo $row_brg["id_pembeli"]?>"> <?php echo $row_brg["nama_pembeli"]?> </option>
                            <?php } ?>
                        <?php } ?>
                    </datalist>
                </div>
                <label for="kembalian" class="col-4 col-sm-4 col-md-4 col-lg-3 col-form-label col-form-label-sm mb-2">Tanggal Jadi</label>
                <div class="col-8 col-sm-8 col-md-8 col-lg-9 mb-2">
                  <input type="date" name="tgljadi" class="form-control form-control-sm" value="<?=date("Y-m-d");?>" required>
                </div>
                <label for="pembayaran" class="col-4 col-sm-4 col-md-4 col-lg-3 col-form-label col-form-label-sm mb-2">DP Awal</label>
                <div class="col-8 col-sm-8 col-md-8 col-lg-9 mb-2">
                  <input type="text" name="pembayaran" onchange="procesBayar()" class="form-control form-control-sm" id="pembayaran" placeholder="0" required>
                </div>
                <label for="kembalian" class="col-4 col-sm-4 col-md-4 col-lg-3 col-form-label col-form-label-sm mb-2">Sisa Pembayaran</label>
                <div class="col-8 col-sm-8 col-md-8 col-lg-9 mb-2">
                  <input type="text" class="form-control form-control-sm bg-light" id="kembalian" placeholder="0" readonly>
                  <input type="hidden" name="kembalian" id="kembalian1">
                </div>
                <div class="col-sm-12 text-right">
              <div class="d-block d-sm-block d-md-none d-lg-none py-1"></div>
              <?php 
              $on = mysqli_query($koneksi,"SELECT * FROM cart");
              $x1 = mysqli_num_rows($on);
              if($x1>0){
                ?>
                <a href="?hapusAll=<?php echo $noinv ?>" onclick="javascript:return confirm('Anda yakin ingin menghapus semua data keranjang ?');"
              class="btn btn-danger btn-sm px-3 mr-2"><i class="fa fa-trash-alt mr-1"></i>Hapus Semua</a>
                <button type="submit" name="import" class="btn btn-primary btn-sm px-3">
                <i class="fa fa-check mr-1"></i>Simpan</button>
              <?php } else { ?>
                  <button class="btn btn-danger btn-sm px-3 mr-2" disabled>
                  <i class="fa fa-trash-alt mr-1"></i>Hapus Semua</button>
                  <button class="btn btn-primary btn-sm px-3" disabled>
                  <i class="fa fa-check mr-1"></i>Simpan</button>
              <?php  } ?>
            </div>
              </div>
              </form>
            </div>

            <div class="col-md-4 col-lg-6 mb-2 text-danger text-right">
              <p class="small text-muted mb-0">Total Item</p>
              <h3 class="mb-0" style="font-weight:600;">Rp. <?php echo $itungtrans3 ?></h3>
            </div>

          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php 
    if(isset($_POST['import']))
    {
        $Ipembayaran = htmlspecialchars($_POST['pembayaran']);
        $Ikembalian = htmlspecialchars($_POST['kembalian']);
        $waktu = date("Y-m-d H:i:s");
        $idpem = htmlspecialchars($_POST['pembeli']);
        $tgljadi = htmlspecialchars($_POST['tgljadi']);

        $UpdCart = mysqli_query($koneksi,"INSERT INTO transaksi (kode_transaksi,waktu,karyawan,id_pembeli,total,dibayar,sisa_pembayaran,status,tgl_jadi) values('$noinv','$waktu','$uid','$idpem','$itungtrans3','$Ipembayaran','$Ikembalian','2','$tgljadi')"); 

        $UpdLap = mysqli_query($koneksi, "INSERT INTO detail_transaksi (kode_transaksi,kode_barang,qty,sub_total) SELECT invoice,kode_barang,qty,sub_total FROM cart") or die (mysqli_connect_error());
        
        $DelCart = mysqli_query($koneksi,"DELETE FROM cart") or die (mysqli_connect_error());
        
        if($UpdCart&&$UpdLap&&$DelCart){
          echo "<script type='text/javascript'>
            Swal.fire({
              title: 'Berhasil',
              text: 'Transaksi berhasil ditambahkan',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then((result) => {
              if (result.value) {
                window.location.href='transaksi.php';
              }
            })
          </script>";
        } else {
        echo "<script type='text/javascript'>
          Swal.fire({
            title: 'Gagal',
            text: 'Transaksi gagal ditambahkan',
            icon: 'error',
            confirmButtonText: 'OK'
          }).then((result) => {
            if (result.value) {
              window.location.href='transaksi.php';
            }
          })
        </script>";
        }
    };
  ?>              
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  
  <script type="text/javascript">
      <?php echo $jsArray,$jsArray1 ?>
        function changeValue(kode_barang) {
          document.getElementById("nama_produk").value = nama_produk[kode_barang].nama_produk;
          document.getElementById("harga_jual").value = harga_jual[kode_barang].harga_jual;
        };
        function InputSub() {
        var harga_jual =  parseInt(document.getElementById('harga_jual').value);
        var jumlah_beli =  parseInt(document.getElementById('qty').value);
        var jumlah_harga = harga_jual * jumlah_beli;
          document.getElementById('subtotal').value = jumlah_harga;
      };
      function procesBayar() {
      var harga_Cart =  parseInt(document.getElementById('totalCart').value);
      var pembayaran_Cart =  parseInt(document.getElementById('pembayaran').value);
      var kembali_cart;

      if(pembayaran_Cart < harga_Cart){
        kembali_Cart = (pembayaran_Cart - harga_Cart) * -1;
        document.getElementById('kembalian1').value = kembali_Cart;
        document.getElementById('kembalian').value = kembali_Cart;
      } else if (pembayaran_Cart >= harga_Cart){
        kembali_Cart = pembayaran_Cart - harga_Cart;
        document.getElementById('kembalian1').value = kembali_Cart;
        document.getElementById('kembalian').value = kembali_Cart;
      }

      };
  </script>
</div>
  <?php include 'footer.php' ?>
  <script>
    $(function () {
      $("#cart").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,
      }).buttons().container().appendTo('#tb1_wrapper .col-md-6:eq(0)');
    });
  </script>
<!-- ./wrapper -->
</body>
</html>
