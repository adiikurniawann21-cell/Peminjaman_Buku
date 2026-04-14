<?php
$kunci = isset($_POST['kunci'])?$_POST['kunci']:'';
?>
 <form action="?halaman=cari" method="post">
                    <label class="text-muted"><b>Pencarian Buku :</b></label>
                    <input type="text" name="kunci" class="form-control mb-2" required placeholder="Masukan Judul Buku">
                    <button type="submit" class="btn btn-primary mb-4">🔎 cari</button>
                </form>
<h4>🔎 Pencarian Buku "<?= $kunci ?>"</h4>
                <div class="row">
                <?php   
                include'../koneksi.php';
                $data_buku = mysqli_query($koneksi,"SELECT*FROM buku WHERE judul_buku LIKE '%$kunci%'");
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
                    <?php } ?>
                    </div>