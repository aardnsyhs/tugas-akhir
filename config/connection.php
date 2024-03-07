<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "penduduk";

$koneksi = mysqli_connect($host, $user, $pass, $database) or die("gagal koneksi ke database");
