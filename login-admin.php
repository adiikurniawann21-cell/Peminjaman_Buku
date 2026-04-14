<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Aplikasi Perpustakaan Sekolah Digital</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: linear-gradient(135deg, #667eea 0%, #ff4040 100%) !important;">
    <div class ="vh-100 row justify-content-center align-content-center">
        <form method="post" action="#" class="col-md-3 border p-4 bg-white rounded-4">
            <img src="logo.png" width="120px" class="mx-auto d-block">
            <h4 class="text-center">Login Admin</h4>
            <h5 class="text-center mb-3">Aplikasi Perpustakaan Sekolah Digital</h5>
            <input type="text" name="username" class="form-control mb-3" placeholder="Masukan Username" required>
            <input type="password" name="password" class="form-control mb-3" placeholder="Masukan Password" required>
            <button name="tombol" type="submit" class="btn btn-success w-100 mb-2">Login</button>
            <a href="login-anggota.php" class="text-decoration-none">Login Anggota</a>
        </form>
    </div>
</body>
</html>
<?php
if(isset($_POST['tombol'])){
    include'koneksi.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT*FROM admin WHERE username='$username' AND password='$password'";
    $data = mysqli_query($koneksi, $query);
    if(mysqli_num_rows($data)>0){
         $data = mysqli_fetch_array($data);
         session_start();
         $_SESSION['id_admin'] = $data['id_admin'];
         $_SESSION['username'] = $data['username'];
         $_SESSION['nama_admin'] = $data['nama_admin'];
         header("Location:admin/dashboard.php");
    }else{
         echo"<script>alert('❌Maaf Login Gagal'); window.location.assign('login-admin.php');</script>";
    }
}
    