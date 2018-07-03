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
            <table class="table table-striped table-hover table-bordered table-align-middle" id="data">
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>ID Barang</th>
                        <th>Jenis</th>
                        <th>Nama</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stok Barang</th>
                        <th>Keterangan</th>
                        <th>Gambar</th>
                    </tr>
                </thead>
                <tbody>
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
                    <td>
                        <?=$data['stok']?>
                    </td>
                    <td><?=$data['keterangan_stok']?></td>
                    <td><img src="../img/barang/<?=$data['gambar']?>" alt="" height="100" width="90"></td>
                </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mb-3"></div>
<?php
    include "template/footer.php";
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#data').DataTable();
    });
</script>