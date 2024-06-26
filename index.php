<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location: login.php");
    exit;
} else {
    $koneksi = include("config/connection.php");
    $data_id = isset($_SESSION["id"]) ? $_SESSION["id"] : "";
    $id_role = isset($_SESSION["id_role"]) ? $_SESSION["id_role"] : "";
    $data_nama = isset($_SESSION["nama_user"]) ? $_SESSION["nama_user"] : "";
    $data_user = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
    $data_level = isset($_SESSION["status_user"]) ? $_SESSION["status_user"] : "";
}
include "config/connection.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tugas Akhir</title>
    <link rel="icon" href="assets/dist/img/penduduk.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="assets/plugins/alert.js"></script>
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
                <img src="assets/dist/img/penduduk.png" alt="Logo Penduduk" class="brand-image">
                <span class="brand-text"> TUGAS AKHIR</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-2 pb-2 mb-2 d-flex">
                    <div class="image">
                        <img src="assets/dist/img/admin.ico">
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
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Kelola Data
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="?page=penduduk" class="nav-link">
                                        <i class="nav-icon far fa-circle text-warning"></i>
                                        <p>Data Penduduk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?page=kk" class="nav-link">
                                        <i class="nav-icon far fa-circle text-warning"></i>
                                        <p>Data Kartu Keluarga</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Sirkulasi Penduduk
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="?page=kematian" class="nav-link">
                                        <i class="nav-icon far fa-circle text-warning"></i>
                                        <p>Data Meninggal</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?page=izin_tinggal" class="nav-link">
                                        <i class="nav-icon far fa-circle text-warning"></i>
                                        <p>Data Izin Tinggal</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?page=pindah" class="nav-link">
                                        <i class="nav-icon far fa-circle text-warning"></i>
                                        <p>Data Pindah</p>
                                    </a>
                                </li>
                            </ul>
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
                                    <a href="?page=surat_kematian" class="nav-link">
                                        <i class="nav-icon far fa-circle text-warning"></i>
                                        <p>Laporan Surat Kematian</p>
                                    </a>
                                <li class="nav-item">
                                    <a href="?page=surat_izin_tinggal" class="nav-link">
                                        <i class="nav-icon far fa-circle text-warning"></i>
                                        <p>Laporan Surat Izin Tinggal</p>
                                    </a>
                                </li>
                        </li>
                        <li class="nav-item">
                            <a href="?page=surat_pindah" class="nav-link">
                                <i class="nav-icon far fa-circle text-warning"></i>
                                <p>Laporan Surat Pindah</p>
                            </a>
                        </li>
                    </ul>
                    </li>
                    <li class="nav-header">Setting</li>
                    <li class="nav-item">
                        <a onclick="return confirm('Apakah Anda yakin ingin keluar?')" href="logout.php" class="nav-link">
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
                                //kartu KK
                            case 'kk':
                                include "pages/kk/index.php";
                                break;
                            case 'tambah_kk':
                                include "pages/kk/tambah_kk.php";
                                break;
                            case 'anggota':
                                include "pages/kk/anggota.php";
                                break;
                            case 'hapus_anggota':
                                include "pages/kk/hapus_anggota.php";
                                break;

                                //penduduk
                            case 'penduduk':
                                include "pages/penduduk/index.php";
                                break;
                            case 'tambah_penduduk':
                                include "pages/penduduk/tambah_penduduk.php";
                                break;
                            case 'detail_penduduk':
                                include "pages/penduduk/detail_penduduk.php";
                                break;
                            case 'edit_penduduk':
                                include "pages/penduduk/edit_penduduk.php";
                                break;

                                //laporan Kematian
                            case 'detail_laporan_kematian':
                                include "surat/detail_laporan_kematian.php";
                                break;
                            case 'edit_laporan_kematian':
                                include "surat/edit_laporan_kematian.php";
                                break;
                            case 'proses_kematian':
                                include "surat/proses_kematian.php";
                                break;

                                //laporan Pindah
                            case 'detail_laporan_pindah':
                                include "surat/detail_laporan_pindah.php";
                                break;
                            case 'edit_laporan_pindah':
                                include "surat/edit_laporan_pindah.php";
                                break;
                            case 'proses_pindah':
                                include "surat/proses_pindah.php";
                                break;

                                //laporan Izin Tinggal
                            case 'detail_laporan_izin_tinggal':
                                include "surat/detail_laporan_izin_tinggal.php";
                                break;
                            case 'edit_laporan_izin_tinggal':
                                include "surat/edit_laporan_izin_tinggal.php";
                                break;
                            case 'proses_izin_tinggal':
                                include "surat/proses_izin_tinggal.php";
                                break;

                                //kematian
                            case 'kematian':
                                include "pages/kematian/index.php";
                                break;
                            case 'tambah_kematian':
                                include "pages/kematian/tambah_kematian.php";
                                break;
                            case 'detail_kematian':
                                include "pages/kematian/detail_kematian.php";
                                break;
                            case 'edit_kematian':
                                include "pages/kematian/edit_kematian.php";
                                break;

                                //pindah
                            case 'pindah':
                                include "pages/pindah/index.php";
                                break;
                            case 'detail_pindah':
                                include "pages/pindah/detail_pindah.php";
                                break;
                            case 'edit_pindah':
                                include "pages/pindah/edit_pindah.php";
                                break;

                                //Izin Tinggal
                            case 'izin_tinggal':
                                include "pages/izin_tinggal/index.php";
                                break;
                            case 'detail_izin_tinggal':
                                include "pages/izin_tinggal/detail_izin_tinggal.php";
                                break;
                            case 'edit_izin_tinggal':
                                include "pages/izin_tinggal/edit_izin_tinggal.php";
                                break;

                                //suket
                            case 'surat_izin_tinggal':
                                include "surat/surat_izin_tinggal.php";
                                break;
                            case 'surat_kematian':
                                include "surat/surat_kematian.php";
                                break;
                            case 'surat_pindah':
                                include "surat/surat_pindah.php";
                                break;

                                //default
                            default:
                                echo "<center><h1> 404 Page Not Found!</h1></center>";
                                break;
                        }
                    } else {
                        if ($data_level == "Admin") {
                            include "pages/home/index.php";
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

    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="assets/plugins/datatables/jquery.dataTables.js"></script>
    <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="assets/dist/js/adminlte.min.js"></script>
    <script src="assets/dist/js/demo.js"></script>
    <script src="assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
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