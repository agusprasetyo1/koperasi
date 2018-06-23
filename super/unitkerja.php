<?php
    $judul = "Koperasi Bahagia";
    $lokasi1 = "Administrasi";
    $lokasi2 = "Unit kerja";
    $lokasi3 = "";
    $linklokasi2 = "unitkerja.php";
    $linklokasi3 = "";
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsi.php";

    $unitkerja = query("select * from unit_kerja");
?>

<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Unit Kerja</h2>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-6 ">
            <a href="tambahunit.php" class="btn btn-primary mb-2">Tambah data</a>
            <table class="table table-striped table-hover table-bordered">
                <tr align="center">
                    <th>No</th>
                    <th>ID Unit Kerja</th>
                    <th>Unit Kerja</th>
                    <th>Gaji Pokok</th>
                    <th>Aksi</th>
                </tr>
                <?php
                    $i = 1;
                    foreach ($unitkerja as $data) {
                ?>
                <tr align="center">
                    <td><?=$i++?>.</td>
                    <td><?=$data['id_unit_kerja']?></td>
                    <td><?=$data['unit_kerja']?></td>
                    <td>Rp<?=number_format($data['gaji_pokok'], 0, ",", ".")?></td>
                    <td>
                        <div class="btn-group">
                            <a href="editunit.php?id=<?=$data['id_unit_kerja']?>"  class="btn btn-info">Edit</a>
                            <a href="hapusunit.php?id=<?=$data['id_unit_kerja']?>" onclick="return confirm('Apakah anda ingin menghapus data ini ?')" class="btn btn-danger">Hapus</a>
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