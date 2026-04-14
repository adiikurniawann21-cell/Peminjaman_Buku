<?php
session_start();
if(empty($_SESSION['id_admin'])){
header("location:../login-admin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin | Aplikasi Perpustakaan Sekolah Digital</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #ff4040 100%); }
        .btn { 
            margin: 5px; 
            border-radius: 25px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transition: all 0.3s; 
        }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.2); }
        .card { border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); border: none; }
        h4 { font-weight: bold; text-align: center; margin-bottom: 1.5rem; }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-4 mb-4">
        <h4>📚 Halaman Admin | Aplikasi Perpustakaan Sekolah Digital</h4>
        
        <div class="text-center mb-4">
            <a href="dashboard.php" class="btn btn-success text-white">📊 Dashboard</a>
            <a href="?halaman=data_buku" class="btn btn-success text-white">📖 Buku</a>
            <a href="?halaman=data_anggota" class="btn btn-success text-white">👥 Anggota</a>
            <a href="?halaman=data_peminjaman" class="btn btn-success text-white">🔄 Peminjaman</a>
            <a href="logout.php" class="btn btn-danger text-white">🚪 Logout</a>
        </div>
        
        <div class="card p-4">
            <?php
            $halaman = isset($_GET['halaman']) ? $_GET['halaman']:"";
            if(file_exists($halaman.".php")){
                include $halaman.".php";
            }else{ ?>
                <div class="text-center py-4">
                    <h4>👋 Selamat Datang <?= $_SESSION['nama_admin']; ?></h4>
                    <p class="text-muted text-justify">
                        Aplikasi Perpustakaan Sekolah Digital merupakan sistem berbasis web yang dirancang untuk membantu pengelolaan data buku,data anggota dan data peminjaman secara terorganisir dan cepat.
                    </p>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>