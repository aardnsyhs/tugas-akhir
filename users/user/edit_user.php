<?php
if (isset($_GET['id_user'])) {
    $sql_cek = "SELECT * FROM user WHERE id_user='" . $_GET['id_user'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
?>

<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Ubah User
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <input type='hidden' class="form-control" name="id_user" value="<?= $data_cek['id_user']; ?>" readonly />
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama User</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nama_user" name="nama_user" value="<?= $data_cek['nama_user']; ?>" readonly />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="username" name="username" value="<?= $data_cek['username']; ?>" readonly />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="pass" name="password" value="<?= $data_cek['password']; ?>" />
                    <input id="mybutton" onclick="change()" type="checkbox" class="form-checkbox"> Lihat Password
                </div>
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-primary">
            <a href="?page=user" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['Ubah'])) {
    $sql_cek = "SELECT * FROM user WHERE id_user='" . $_POST['id_user'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
    if ($data_cek['password_changed'] == 1) {
        echo "<script>
              Swal.fire({title: 'Gagal Ubah Password', text: 'Anda hanya dapat mengubah password sekali.', icon: 'error', confirmButtonText: 'OK'
              }).then((result) => {
                  if (result.value) {
                      window.location = 'index.php?page=user';
                  }
              })</script>";
    } else {
        $sql_ubah = "UPDATE user SET
            password='" . md5($_POST['password']) . "',
            password_changed = 1
            WHERE id_user='" . $_POST['id_user'] . "'";
        $query_ubah = mysqli_query($koneksi, $sql_ubah);
        mysqli_close($koneksi);
        if ($query_ubah) {
            echo "<script>
                  Swal.fire({title: 'Ubah Password Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
                  }).then((result) => {
                      if (result.value) {
                          window.location = 'index.php?page=user';
                      }
                  })</script>";
        } else {
            echo "<script>
                  Swal.fire({title: 'Ubah Password Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
                  }).then((result) => {
                      if (result.value) {
                          window.location = 'index.php?page=edit_user';
                      }
                  })</script>";
        }
    }
}
?>

<script type="text/javascript">
    document.getElementById("nama_user").disabled = true;
    document.getElementById("username").disabled = true;

    function change() {
        const password = document.getElementById('pass').type;
        if (password == 'password') {
            document.getElementById('pass').type = 'text';
            document.getElementById('mybutton').innerHTML;
        } else {
            document.getElementById('pass').type = 'password';
            document.getElementById('mybutton').innerHTML;
        }
    }
</script>