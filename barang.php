<?php require ('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Uzi Tailor | Master Barang</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed accent-danger">
<?php 
  session_start();
  
  if (!isset($_SESSION['username'])) {
      header("Location: index.php");
  }
  
  require ('koneksi.php');
  if($_SERVER['REQUEST_METHOD']=='POST'):
    $kodebarang = $_POST['kode'];
    $namabarang = $_POST['nama'];
    $hargabarang = $_POST['harga'];
    //query untuk insert data
    $sql = "INSERT INTO master_barang (kode_barang, nama_barang, harga) VALUES ('$kodebarang', '$namabarang', '$hargabarang')";
    //eksekusi query
    if(mysqli_query($koneksi, $sql)):
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
    endif;
    mysqli_close($koneksi);
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
            <a href="barang.php" class="nav-link active">
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
            <a href="pages/widgets.html" class="nav-link">
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
            <h1 class="m-0">Master Barang</h1>
            <br>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">
              Tambah</button>
            <!-- Modal -->
            <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Barang</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                      <label for="kode">Kode Barang</label>
                      <input type="text" class="form-control" name="kode" placeholder="Kode Barang" required>
                    </div>
                    <div class="form-group">
                      <label for="nama">Nama Barang</label>
                      <input type="text" class="form-control" name="nama" placeholder="Nama Barang" required>
                    </div>
                    <div class="form-group">
                      <label for="harga">Harga Barang</label>
                      <input type="number" class="form-control" name="harga" placeholder="Harga Barang" required>
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
              </div>
            <!-- Modal -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Master Barang</li>
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
            <h3 class="card-title"></h3>

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
                  <th>No</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Harga Barang</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                    //call koneksi.php
                    include 'koneksi.php';
                    //mysqli_query untuk menjalankan query
                    $data = mysqli_query($koneksi,"SELECT kode_barang, nama_barang, harga FROM master_barang");
                    //no
                    $no = 1;
                    //while untuk menampilkan data
                    while($d = mysqli_fetch_array($data)){
                ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $d['kode_barang']; ?></td>
                    <td><?php echo $d['nama_barang']; ?></td>
                    <td><?php echo $d['harga']; ?></td>
                    <td>
                        <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modal<?php echo $d['kode_barang']; ?>">Edit</a>
                        <a href="./delete/delete_barang.php?kode_barang=<?php echo $d['kode_barang']; ?>" class="btn btn-danger">Hapus</a>
                        <!-- Modal -->
                        <div class="modal fade" id="modal<?php echo $d['kode_barang']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel"><b>Edit Barang</b></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                <form action="./edit/edit_barang.php" method="POST">
                                  <div class="form-group">
                                    <label for="kode">Kode Barang</label>
                                    <input type="text" class="form-control" name="kode" placeholder="Kode Barang" value="<?php echo $d['kode_barang']; ?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="nama">Nama Barang</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Nama Barang" value="<?php echo $d['nama_barang']; ?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="harga">Harga Barang</label>
                                    <input type="number" class="form-control" name="harga" placeholder="Harga Barang" value="<?php echo $d['harga']; ?>" required>
                                  </div>
                                  <br>
                                  <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                  <button type="submit" name="tambah" class="btn btn-warning">Edit</button>
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
  <?php include 'footer.php' ?>
</div>
<!-- ./wrapper -->
</body>
</html>
