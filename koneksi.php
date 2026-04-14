<?php
$server = "localhost";
$pengguna = "root";
$password = "";
$database = "peminjaman_buku";
$koneksi = mysqli_connect($server,$pengguna,$password,$database);
if(!$koneksi){
    echo"koneksi error".mysqli_error();
}

