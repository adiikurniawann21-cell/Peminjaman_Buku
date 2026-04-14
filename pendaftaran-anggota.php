<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Anggota - Aplikasi Perpustakaan Sekolah Digital</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: linear-gradient(135deg, #667eea 0%, #ff4040 100%) !important;">
    <div class ="vh-100 row justify-content-center align-content-center">
        <form method="post" action="#" class="col-md-3 border p-3 bg-white rounded-4">
            <img src="logo.png" width="120px" class="mx-auto d-block">
            <h4 class="text-center">Pendaftaran Anggota</h4>
            <h5 class="text-center mb-3">Aplikasi Perpustakaan Sekolah Digital</h5>
            <input type="text" name="nis" class="form-control mb-3" placeholder="Masukan NIS" required>
            <input type="text" name="nama_anggota" class="form-control mb-3" placeholder="Masukan Nama Anggota" required>
            <input type="text" name="username" class="form-control mb-3" placeholder="Masukan Username" required>
            <input type="text" name="password" class="form-control mb-3" placeholder="Masukan Password" required>
            <input type="text" name="kelas" class="form-control mb-3" placeholder="Masukan Kelas" required>
            <button name="tombol" type="submit" class="btn btn-success w-100 mb-2">Daftar</button>
            <a href="login-anggota.php" class="text-decoration-none">Login Anggota</a><br>
            <a href="login-admin.php" class="text-decoration-none">Login Admin</a>
        </form>
    </div>
        </form>
    </div>
</body>
</html>
<?php
if(isset($_POST['tombol'])){
    include'koneksi.php';
    $nis = $_POST['nis'];
    $nama_anggota = $_POST['nama_anggota'];
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $kelas = $_POST['kelas'];

    $query = "INSERT INTO anggota(nis,nama_anggota,username,password,kelas) VALUES('$nis','$nama_anggota','$username','$pass','$kelas')";
    $data = mysqli_query($koneksi, $query);
    if($data){
         session_start();
         $_SESSION['id_anggota'] = mysqli_insert_id($koneksi);
         $_SESSION['username'] = $username;
         $_SESSION['nama_admin'] = $nama_anggota;
         header("Location:anggota/dashboard.php");
    }else{
         echo"<script>alert('❌Maaf Login Gagal'); window.location.assign('login-amggota.php');</script>";
    }
}
    