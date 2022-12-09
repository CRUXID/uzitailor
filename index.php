<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Uzi Tailor | Log in</title>
</head>
<body class="hold-transition login-page">
<?php 
require ('header.php');
session_start();
  require ('koneksi.php');
  if($_SERVER['REQUEST_METHOD']=='POST'):
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM karyawan WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $sql);
    if ($result->num_rows > 0):
        $row = mysqli_fetch_assoc($result);
        $_SESSION['login'] = "login";
        $_SESSION['username'] = $row['username'];
        $_SESSION['idk'] = $row['id_karyawan'];
        echo "<script type='text/javascript'>
          Swal.fire({
            title: 'Berhasil',
            text: 'Berhasil Login',
            icon: 'success',
          })
          setTimeout(function() {
            window.location.href = 'transaksi.php';
          }, 1000);
        </script>";
    else:
      echo "<script type='text/javascript'>
        Swal.fire({
          title: 'Gagal',
          text: 'Gagal Login',
          icon: 'error',
        })
      </script>";
    endif;
endif;
?>
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Uzi</b>Tailor</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Login untuk masuk ke sistem</p>

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
          </div>
          <div class="col-4">
          <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
          <div class="col-4">
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
</body>
</html>