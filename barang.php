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
  require ('koneksi.php');
  require ('query.php');
  $crud = new crud();

  if (!isset($_SESSION['login'])) {
      header("Location: index.php");
  }
  
  if(isset($_POST['tambah'])):
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

  if(isset($_POST['edit'])):
    $kodebarang = $_POST['kode'];
    $namabarang = $_POST['nama'];
    $harga      = $_POST['harga'];
    // query SQL untuk update data
    $query="UPDATE master_barang SET kode_barang='$kodebarang',nama_barang='$namabarang',harga='$harga' WHERE kode_barang='$kodebarang'";
    if(mysqli_query($koneksi, $query)):
      echo "<script type='text/javascript'>
        Swal.fire({
          title: 'Berhasil',
          text: 'Data Berhasil Diubah',
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
          text: 'Data Gagal Diubah',
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
                  <form method="POST">
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
          <!-- /.card-header -->
          <div class="card-body table-responsive" style="height: 450px;">
            <table class="table table-bordered table-striped" id="tb1">
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
                $data = $crud->selectBarang();
                $no = 1;
                if($data->num_rows > 0){
                  while($d = $data->fetch(PDO::FETCH_ASSOC)){
              ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $d['kode_barang']; ?></td>
                    <td><?php echo $d['nama_barang']; ?></td>
                    <td><?php echo $d['harga']; ?></td>
                    <td>
                        <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modal<?php echo $d['kode_barang']; ?>"><i class="nav-icon fa fa-pencil"></i></a>
                        <a href="./delete/delete_barang.php?kode_barang=<?php echo $d['kode_barang']; ?>" class="btn btn-danger delete"><i class="nav-icon fa fa-trash"></i></a>
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
                                <form method="POST">
                                  <div class="form-group">
                                    <label for="kode">Kode Barang</label>
                                    <input type="text" class="form-control" name="kode" placeholder="Kode Barang" value="<?php echo $d['kode_barang']; ?>" readonly>
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
                                  <button type="submit" name="edit" class="btn btn-warning">Edit</button>
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
  <?php include 'footer.php' ?>
</div>
<!-- ./wrapper -->
<?php if(@$_SESSION['sukses']){ ?>
    <script>
        Swal.fire({            
            icon: 'success',                   
            title: 'Sukses',    
            text: 'data berhasil dihapus',                        
            timer: 3000,                                
            showConfirmButton: false
        })
    </script>
<?php unset($_SESSION['sukses']); } ?>
<script>
  $(function () {
    $("#tb1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#tb1_wrapper .col-md-6:eq(0)');
  });
</script>
<script>
    $('.delete').on('click',function(){
        var getLink = $(this).attr('href');
        Swal.fire({
            title: "Yakin hapus data?",            
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonColor: '#3085d6',
            cancelButtonText: "Batal"
        
        }).then(result => {
            //jika klik ya maka arahkan ke proses.php
            if(result.isConfirmed){
                window.location.href = getLink
            }
        })
        return false;
    });
</script>
</body>
</html>
