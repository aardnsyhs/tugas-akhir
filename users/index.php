<?php
session_start();
include("../config/connection.php");
include("../function/function.php");
if (!isset($_SESSION["username"])) {
    header("location: login.php");
    exit;
} else {
    $data_id = isset($_SESSION["id"]) ? $_SESSION["id"] : "";
    $id_role = isset($_SESSION["id_role"]) ? $_SESSION["id_role"] : "";
    $data_nama = isset($_SESSION["nama_user"]) ? $_SESSION["nama_user"] : "";
    $data_level = isset($_SESSION["status_user"]) ? $_SESSION["status_user"] : "";
}

$query = "SELECT id_penduduk, nik_penduduk FROM `penduduk` WHERE id_user = '$data_id'";
$hasil_penduduk = mysqli_query($koneksi, $query);
$data_penduduk = mysqli_fetch_assoc($hasil_penduduk);
$id_penduduk = $data_penduduk['id_penduduk'];
$nik_penduduk = $data_penduduk['nik_penduduk'];

$query = "SELECT * FROM `anggota_keluarga` JOIN `penduduk` ON anggota_keluarga.id_penduduk = penduduk.id_penduduk 
JOIN `kk` ON anggota_keluarga.id_kk = kk.id_kk 
WHERE anggota_keluarga.id_penduduk = '$id_penduduk'";
$data_anggota_keluarga = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tugas Akhir</title>
    <link rel="icon" href="../assets/dist/img/penduduk.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="../assets/plugins/alert.js"></script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#">
                        <i class="fas fa-bars text-white"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link">
                        <font color="white">
                            <b>APLIKASI PENDATAAN PENDUDUK</b>
                        </font>
                    </a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index.php" class="brand-link">
                <img src="../assets/dist/img/penduduk.png" alt="Logo Penduduk" class="brand-image">
                <span class="brand-text"> TUGAS AKHIR</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-2 pb-2 mb-2 d-flex">
                    <div class="image">
                        <img src="../assets/dist/img/admin.ico">
                    </div>
                    <div class="info">
                        <a href="index.php" class="d-block">
                            <?= $data_nama; ?>
                        </a>
                        <span class="badge badge-success">
                            <?= $data_level; ?>
                        </span>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <?php foreach ($data_anggota_keluarga as $kk) : ?>
                                <?php $encoded_no_kk = base64_encode($kk['no_kk']); ?>
                                <a href="?page=anggota&no_kk=<?= $encoded_no_kk ?>" class="nav-link">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>
                                        Kartu Keluarga
                                    </p>
                                </a>
                            <?php endforeach ?>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Kelola Laporan
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="?page=lapor_kematian" class="nav-link">
                                        <i class="nav-icon far fa-circle text-warning"></i>
                                        <p>Lapor Kematian</p>
                                    </a>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon far fa-circle text-warning"></i>
                                        <p>Lapor Izin Tinggal</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <?php foreach ($data_anggota_keluarga as $kk) : ?>
                                        <?php $encoded_no_kk = encrypt($kk['no_kk']); ?>
                                        <a href="?page=lapor_pindah&no_kk=<?= $encoded_no_kk ?>" class="nav-link">
                                            <i class="nav-icon far fa-circle text-warning"></i>
                                            <p>Lapor Pindah</p>
                                        </a>
                                </li>
                            <?php endforeach ?>
                        </li>
                    </ul>
                    </li>
                    <li class="nav-header">Setting</li>
                    <li class="nav-item">
                        <a href="?page=user" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Pengguna Sistem
                            </p>
                        </a>
                    </li>
                    <li class="nav-header"></li>
                    <li class="nav-item">
                        <a onclick="return confirm('Apakah Anda yakin ingin keluar?')" href="../logout.php" class="nav-link">
                            <i class="nav-icon fas fa-arrow-circle-right"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                </nav>
            </div>
        </aside>
        <div class="content-wrapper">
            <section class="content-header">
            </section>
            <section class="content">
                <div class="container-fluid">
                    <?php
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        switch ($page) {
                                //Pengguna
                            case 'user':
                                include "user/index.php";
                                break;
                            case 'edit_user':
                                include "user/edit_user.php";
                                break;

                                //kartu KK
                            case 'anggota':
                                include "kk/anggota.php";
                                break;

                                //kematian
                            case 'lapor_kematian':
                                include "kematian/lapor_kematian.php";
                                break;

                                //pindah
                            case 'lapor_pindah':
                                include "pindah/lapor_pindah.php";
                                break;
                            case 'hapus_anggota_pindah':
                                include "pindah/hapus_anggota_pindah.php";
                                break;

                                //suket
                            case 'suket-domisili':
                                include "surat/suket_domisili.php";
                                break;
                            case 'surat_kematian':
                                include "surat/surat_kematian.php";
                                break;
                            case 'suket-pindah':
                                include "surat/suket_pindah.php";
                                break;

                                //default
                            default:
                                echo "<center><h1> 404 Page Not Found!</h1></center>";
                                break;
                        }
                    } else {
                        if ($id_role == "4") {
                            include "home/index.php";
                        }
                    }
                    ?>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                Copyright &copy;
                Ardiansyah Sulistyo
            </div>
            <b>TUGAS AKHIR 2024</b>
        </footer>
        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>

    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="../assets/plugins/datatables/jquery.dataTables.js"></script>
    <script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="../assets/dist/js/adminlte.min.js"></script>
    <script src="../assets/dist/js/demo.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
    <script>
        $(function() {
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>

</body>

</html>