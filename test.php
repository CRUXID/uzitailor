<div class="card">
              <div class="card-body">
                  <?php
                    $uname = $_SESSION['username'];
                    require ('koneksi.php');
                    $data = mysqli_query($koneksi,"SELECT * FROM karyawan WHERE username='$uname'");
                    while($d = mysqli_fetch_array($data)){
                  ?>
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $d['username']; ?>" required>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo $d['password']; ?>" required>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="nama_karyawan">Nama Karyawan </label>
                                <input type="text" class="form-control" name="nama_karyawan" placeholder="Nama Karyawan" value="<?php echo $d['nama_karyawan']; ?>" required>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?php echo $d['alamat_karyawan']; ?>" required>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="nohp">No HP</label>
                                <input type="number" class="form-control" name="no_hp" placeholder="No HP" value="<?php echo $d['no_hp']; ?>" required>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="uploadfile">Foto Profil</label>
                                <div class="form-group">
                                    <input class="form-control" type="file" name="uploadfile" value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                      <button type="submit" class="btn btn-primary float-right" name="tambah">Update</button>
                  </form>
                  <?php } ?>
              </div>
            </div>