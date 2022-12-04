<?php require ('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Uzi Tailor | Data Pembeli</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed accent-danger">
<?php 
  session_start();
  
  if (!isset($_SESSION['username'])) {
      header("Location: index.php");
  }
  
  require ('koneksi.php');
  if($_SERVER['REQUEST_METHOD']=='POST'):
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['nohp'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    //query untuk insert data
    $sql = "INSERT INTO `data_pembeli`(`id_pembeli`, `nama_pembeli`, `alamat`, `no_hp`, `username`, `password`) VALUES ('','$nama','$alamat','$nohp','$username','$password')";
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
          header('Location: pembeli.php');
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
          header('Location: pembeli.php');
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
            <a href="pembeli.php" class="nav-link active">
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
            <h1 class="m-0">Data Pembeli</h1>
            <br>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">
              Tambah</button>
              <!-- Modal -->
          <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Pembeli</b></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama Pembeli</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Pembeli" required>
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" name="alamat" placeholder="Alamat Pembeli" required>
                  </div>
                  <div class="form-group">
                    <label for="nohp">No Hp</label>
                    <input type="number" class="form-control" name="nohp" placeholder="No Hp" required>
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
              <li class="breadcrumb-item active">Data Pembeli</li>
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
                  <th>Nama Pembeli</th>
                  <th>Alamat</th>
                  <th>No HP</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
                //call koneksi.php
                include 'koneksi.php';
                //mysqli_query untuk menjalankan query
                $data = mysqli_query($koneksi,"SELECT id_pembeli, nama_pembeli,alamat,no_hp,username,password FROM data_pembeli");
                //no
                $no = 1;
                //while untuk menampilkan data
                while($d = mysqli_fetch_array($data)){
              ?>
                        <td><?php echo $d['nama_pembeli']; ?></td>
                        <td><?php echo $d['alamat']; ?></td>
                        <td><?php echo $d['no_hp']; ?></td>
                        <td>
                        <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modal<?php echo $d['id_pembeli']; ?>"><i class="nav-icon fa fa-pencil"></i></a>
                        <button type="button" class="btn btn-danger delete"><i class="nav-icon fa fa-trash"></i></button>
                        <script>
                          $(function() {
                            $('.delete').click(function() {
                              Swal.fire({
                                title: "Hapus Data Pembeli",
                                text: "Apakah yakin anda ingin Hapus ?",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Ya, Hapus!",
                                closeOnConfirm: false
                              }).then((result) => {
                                if (result.value) {
                                  Swal.fire(
                                    'Berhasil !',
                                    'berhasil Hapus Data.',
                                    'success'
                                  )
                                  //add delay time
                                  setTimeout(function() {
                                    window.location.href = './delete/delete_pembeli.php?id_pembeli=<?php echo $d['id_pembeli']; ?>';
                                  }, 1000);
                                }
                              })
                            });
                          });
                        </script>
                          <!-- Modal -->
                        <div class="modal fade" id="modal<?php echo $d['id_pembeli']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel"><b>Edit Barang</b></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                <form action="./edit/edit_pembeli.php" method="POST">
                                <div class="form-group">
                                      <label for="username">Username</label>
                                      <input type="text" class="form-control" name="username" placeholder="Username"  value="<?php echo $d['username']; ?>"required>
                                    </div>
                                    <div class="form-group">
                                      <label for="password">Password</label>
                                      <input type="password" class="form-control" name="password" placeholder="Password"  value="<?php echo $d['password']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                      <label for="nama">Nama Pembeli</label>
                                      <input type="text" class="form-control" name="nama" placeholder="Nama Pembeli"  value="<?php echo $d['nama_pembeli']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                      <label for="alamat">Alamat</label>
                                      <input type="text" class="form-control" name="alamat" placeholder="Alamat Pembeli"  value="<?php echo $d['alamat']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                      <label for="nohp">No Hp</label>
                                      <input type="number" class="form-control" name="nohp" placeholder="No Hp"  value="<?php echo $d['no_hp']; ?>"required>
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
</body>
</html>
