<?php
session_start();
if(empty($_SESSION['id_anggota'])){
header("location:../login-anggota.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Anggota | Aplikasi Perpustakaan Sekolah Digital</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: linear-gradient(135deg, #667eea 0%, #ff4040 100%) !important;">
    <div class="container mt-4 mb-4">
        <h3> Halaman Anggota | Aplikasi Perpustakaan Sekolah Digital</h3>
          <a href="dashboard.php" class="btn btn-success text-white">📊 Dashboard</a>
          <a href="?halaman=history" class="btn btn-success text-white">📖 History Peminjaman</a>
          <a href="logout.php" class="btn btn-danger text-white">🚪 Logout</a>
            <div class="card p-3 mt-3">
                <?php
                $halaman = isset($_GET['halaman']) ? $_GET['halaman']:"";
               if(file_exists($halaman.".php")){
                     include $halaman.".php";
            }else{ ?>
                <h3>Selamat Datang <?= $_SESSION['nama_anggota']; ?>👋</h3>
                <form action="?halaman=cari" method="post">
                    <label class="text-muted"><b>Pencarian Buku :</b></label>
                    <input type="text" name="kunci" class="form-control mb-2" required placeholder="Masukan Judul Buku">
                    <button type="submit" class="btn btn-primary">🔎 cari</button>
                </form>
                <hr>
                <h4>🛒Buku Yang dipinjam :</h4>
                <table class="table table-bordered">
                    <tr class="fw-bold">
                        <td>No</td>
                        <td>Judul Buku</td>
                        <td>Tanggal Pinjam</td>
                        <td>Pengembalian</td>
                    </tr>
                    <?php
                    include'../koneksi.php';
                    $no=1;
                    $query = "SELECT*FROM transaksi,buku WHERE buku.id_buku=transaksi.id_buku AND transaksi.
                    id_anggota='$_SESSION[id_anggota]' AND status_transaksi='Peminjaman'";
                    $data = mysqli_query($koneksi, $query);
                    foreach($data as $peminjaman){ ?>
                          <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $peminjaman['judul_buku'] ?></td>
                            <td><?= $peminjaman['tgl_pinjam'] ?></td>
                            <td>
                               <?php
                               $link = "'Pengembalian Buku $peminjaman[judul_buku]', $peminjaman[id_transaksi], $peminjaman[id_buku]"
                               ?>
                               <a onclick="pengembalian(<?= $link ?>)" class="btn btn-success">
                                  ✅ Pengembalian
                                </a>
                            </td>
                          </tr>
                    <?php } ?>
    
                </table>
                <hr>
                <h4>📚 Daftar Buku :</h4>
                <div class="row">
                <?php   
                $data_buku = mysqli_query($koneksi,"SELECT*FROM buku ORDER BY id_buku DESC");
                foreach($data_buku as $buku){
                ?>
                <div class="col-md-3">
                    <div class="card shadow-sm p-3 d-flex">
                         <h5><?= $buku['judul_buku'] ?></h5>
                         <p><strong>Pengarang :</strong> <?= $buku['pengarang'] ?></p>
                         <p><strong>Penerbit :</strong> <?= $buku['penerbit'] ?></p>
                         <p><strong>Diterbitkan tahun :</strong> <?= $buku['tahun_terbit'] ?></p>
                         <?php if($buku['status']=="tersedia"){ ?>
                         <span class="badge bg-success mb-1">✅ Tersedia</span>
                         <?php
                         $link = "'❓ apakah anda yakin ingin meminjam buku $buku[judul_buku]',$buku[id_buku]";
                         ?>
                         <a onclick="pinjam(<?= $link ?>)" class="btn btn-primary text-white">🛒 Pinjam</a>
                         <?php }else{ ?>
                         <span class="badge bg-danger mb-1">❌ Tidak tersedia</span>
                         <a class="btn btn-primary text-white disabled">🛒Pinjam</a>
                         <?php } ?>
                    </div>
                </div>
                <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <script>
         function pinjam(pesan,id_buku){
            if(confirm(pesan)){
                window.location.href = '?halaman=peminjaman&id='+id_buku;
            }
         }
         function pengembalian(pesan,id_transaksi,id_buku){
            if(confirm(pesan)){
                window.location.href = '?halaman=pengembalian&id='+id_transaksi+'$buku'+id_buku;
            }
         }
        </script>
</body>
</html>