<?php
    $judul = "Koperasi Bahagia";
    $lokasi1 = "Administrasi";
    $lokasi2 = "Barang";
    $lokasi3 = "";
    $linklokasi2 = "barang.php";
    $linklokasi3 = "";
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsi.php";

    $barang = query("select * from barang b inner join jenis_barang j on b.id_jenis_barang = j.id_jenis_barang");
?>

<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Barang</h2>
    <div class="row justify-content-center">
        <div class="col-sm-12 col-lg-12 ">
            <a href="tambahbarang.php" class="btn btn-primary mb-2">Tambah data</a>
            <div style="float:right;">
                <form action="" method="get" class="input-group btn-group form-inline  " >
                    <input type="text" size="25" name="cari" id="inputcari" class="form-control" placeholder="Masukan keyword pencarian"  required>
                    <input type="submit" class="btn btn-success" id="cari"  value="Cari">
                </form>
            </div>
            <table class="table table-striped table-hover table-bordered table-align-middle">
                <tr align="center">
                    <th>No</th>
                    <th>ID Barang</th>
                    <th>Jenis</th>
                    <th>Nama</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok Barang</th>
                    <th>Keterangan</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
                <?php
                    $i = 1;
                    foreach ($barang as $data) {
                ?>
                <tr align="center">
                    <td><?=$i++?>.</td>
                    <td><?=$data['id_barang']?></td>
                    <td><?=$data['jenis']?></td>
                    <td><?=$data['nama_barang']?></td>
                    <td>Rp. <?=number_format($data['harga_beli'],0,',','.')?></td>
                    <td>Rp. <?=number_format($data['harga_jual'],0,',','.')?></td>
                    <td><?=$data['stok']?></td>
                    <td><?=$data['keterangan_stok']?></td>
                    <td><img src="../img/" alt="" height="100" width="90"></td>
                    <td>
                        <div class="btn-group">
                            <a href="editjenis.php?id=<?=$data['id_jenis_barang']?>"  class="btn btn-info">Edit</a>
                            <a href="hapusjenis.php?id=<?=$data['id_jenis_barang']?>" onclick="return confirm('Apakah anda ingin menghapus data ini ?')" class="btn btn-danger">Hapus</a>
                        </div>
                    </td>
                </tr>
                    <?php } ?>
            </table>
        </div>
    </div>
</div>
<?php
    include "template/footer.php";
?>