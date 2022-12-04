<?php require 'header.php' ?>
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
          <button type="button" class="btn btn-danger swalDefaultSuccess"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
        <script>
          $(function() {
            $('.swalDefaultSuccess').click(function() {
              Swal.fire({
                title: "Logout",
                text: "Apakah yakin anda ingin logout ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Ya, logout!",
                closeOnConfirm: false
              }).then((result) => {
                if (result.value) {
                  Swal.fire(
                    'Berhasil !',
                    'Anda telah logout.',
                    'success'
                  )
                  //add delay time
                  setTimeout(function() {
                    window.location.href = "logout.php";
                  }, 2000);
                }
              })
            });
          });
        </script>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->