<?php include "config/connection.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login | Tugas Akhir </title>
    <link rel="icon" href="assets/dist/img/izin.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <center>
                    <i class="fa fa-users" style="font-size: 7rem;"></i>
                    <br>
                    <h5>
                        <b>APLIKASI PENDATAAN PENDUDUK</b>
                    </h5>
                    <br>
                </center>
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-info btn-block btn-flat" name="btnLogin" title="Masuk Sistem">
                                <b>Login</b>
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/dist/js/adminlte.min.js"></script>
    <script src="assets/plugins/alert.js"></script>

</body>

</html>

<?php
if (isset($_POST['btnLogin'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, md5($_POST['password']));

    $sql_login = "SELECT * FROM `user` JOIN `role` ON role.id_role=user.id_role WHERE BINARY username='$username' AND password='$password'";
    $query_login = mysqli_query($koneksi, $sql_login);
    $data_login = mysqli_fetch_array($query_login, MYSQLI_BOTH);
    $jumlah_login = mysqli_num_rows($query_login);

    if ($jumlah_login == 1) {
        session_start();
        $_SESSION["id"] = $data_login["id_user"];
        $_SESSION["nama_user"] = $data_login["nama_user"];
        $_SESSION["username"] = $data_login["username"];
        $_SESSION["password"] = $data_login["password"];

        if (isset($data_login["status_user"])) {
            $_SESSION["status_user"] = $data_login["status_user"];
        } else {
            $_SESSION["status_user"] = "";
        }

        echo "<script>
            Swal.fire({title: 'Login Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
            }).then((result) => {if (result.value)
                {window.location = 'index.php';}
            })</script>";
    } else {
        echo "<script>
            Swal.fire({title: 'Login Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value)
                {window.location = 'login.php';}
            })</script>";
    }
}
?>