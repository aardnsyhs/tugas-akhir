<?php
$host = "localhost";
$user = "root";
$pass = "root";
$database = "penduduk";

$koneksi = mysqli_connect($host, $user, $pass, $database) or die("gagal koneksi ke database");
