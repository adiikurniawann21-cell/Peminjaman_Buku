<?php
include'../koneksi.php';
$anggota = mysqli_query($koneksi,"SELECT*FROM anggota");
$buku = mysqli_query($koneksi,"SELECT*FROM buku WHERE status='tersedia'");
?>
<h4>🛒Data Peminjaman</h4>
<a href="?halaman=input_peminjaman" class="btn btn-secondary">
    ➕Tambah Data Peminjaman
</a>
<table class="table table-bordered mt-3">
    <tr>
        <td>No</td>
        <td>NIS</td>
        <td>nama anggota</td>
        <td>Judul buku</td>
        <td>Tanggal pinjam</td>
        <td>Kelola</td>
    </tr>
    <?php
    include'../koneksi.php';
    $no = 1;
    $query ="SELECT*FROM transaksi,buku,anggota
    WHERE buku.id_buku=transaksi.id_buku AND anggota.id_anggota=transaksi.id_anggota
    AND transaksi.status_transaksi='peminjaman' ORDER BY transaksi.id_transaksi DESC";
    $data = mysqli_query($koneksi, $query);
    foreach($data as $peminjam){ ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $peminjam['nis'] ?></td>
            <td><?= $peminjam['nama_anggota'] ?></td>
            <td><?= $peminjam['judul_buku'] ?></td>
            <td><?= $peminjam['tgl_pinjam'] ?></td>
            <td>
                 <?php
                 $pesan = "✅ Pengembalian buku oleh $peminjam[nama_anggota], Buku $peminjam[judul_buku]";
                 $isi = "'$pesan',$peminjam[id_transaksi],$peminjam[id_buku]";
                 ?>
                 <a onclick="pengembalian(<?= $isi ?>)" class="btn btn-success">✅ Pengembalian</a>
                 <?php
                 $pesan = "🗑 Anda yakin ingin menghapus buku oleh $peminjam[nama_anggota], Buku $peminjam[judul_buku]";
                 $isi = "'$pesan',$peminjam[id_transaksi],$peminjam[id_buku]";
                 ?>
                 <a onclick="hapus(<?= $isi ?>)" class="btn btn-danger">🗑 Hapus</a>
            </td>
         </tr>
    <?php } ?>
</table>
<h4>✅ Data Pengembalian</h4>

<table class="table table-bordered mt-3">
    <tr>
        <td>No</td>
        <td>NIS</td>
        <td>nama anggota</td>
        <td>Judul buku</td>
        <td>Tanggal pinjam</td>
        <td>Tanggal pengembalian</td>
        <td>Kelola</td>
    </tr>
    <?php
    include'../koneksi.php';
    $no = 1;
    $query ="SELECT*FROM transaksi,buku,anggota
    WHERE buku.id_buku=transaksi.id_buku AND anggota.id_anggota=transaksi.id_anggota
    AND transaksi.status_transaksi='Pengembalian' ORDER BY transaksi.id_transaksi DESC";
    $data = mysqli_query($koneksi, $query);
    foreach($data as $peminjam){ ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $peminjam['nis'] ?></td>
            <td><?= $peminjam['nama_anggota'] ?></td>
            <td><?= $peminjam['judul_buku'] ?></td>
            <td><?= $peminjam['tgl_pinjam'] ?></td>
            <td><?= $peminjam['tgl_kembali'] ?></td>
            <td>
                 <?php
                 $pesan = "🗑 Anda yakin ingin menghapus buku oleh $peminjam[nama_anggota], Buku $peminjam[judul_buku]";
                 $isi = "'$pesan',$peminjam[id_transaksi],$peminjam[id_buku]";
                 ?>
                 <a onclick="hapus(<?= $isi ?>)" class="btn btn-danger">🗑 Hapus</a>
            </td>
         </tr>
    <?php } ?>
</table>
<script>
   function pengembalian(pesan,id_transaksi,id_buku){
      if(confirm(pesan)){
         window.location.href = '?halaman=proses_pengembalian&id='+id_transaksi+'$buku='+id_buku;
      }
   }
   function hapus(pesan,id_transaksi,id_buku){
      if(confirm(pesan)){
         window.location.href = '?halaman=hapus&id='+id_transaksi+'$buku='+id_buku;
      }
   }
</script>