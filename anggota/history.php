<h4>✅ History Peminjaman :</h4>
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
                    id_anggota='$_SESSION[id_anggota]' AND status_transaksi='Pengembalian'";
                    $data = mysqli_query($koneksi, $query);
                    foreach($data as $peminjaman){ ?>
                          <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $peminjaman['judul_buku'] ?></td>
                            <td><?= $peminjaman['tgl_pinjam'] ?></td>
                            <td><?= $peminjaman['tgl_kembali'] ?></td>
                          </tr>
                    <?php } ?>
    
                </table>