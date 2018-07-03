<?php
    $judul = "Koperasi Bahagia";
    $lokasi1 = "Administrasi";
    $lokasi2 = "Jenis Barang";
    $lokasi3 = "";
    $linklokasi2 = "unitkerja.php";
    $linklokasi3 = "";
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsi.php";

    $jenis = query("select * from jenis_barang");
?>

<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Jenis Barang</h2>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-6 ">
            <a href="tambahjenis.php" class="btn btn-primary mb-2">Tambah data</a>
            <table class="table table-striped table-hover table-bordered" id="data">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>ID Jenis</th>
                            <th>Jenis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                    $i = 1;
                    foreach ($jenis as $data) {
                        ?>
                <tr align="center">
                    <td><?=$i++?>.</td>
                    <td><?=$data['id_jenis_barang']?></td>
                    <td><?=$data['jenis']?></td>
                    <td>
                        <div class="btn-group">
                            <a href="editjenis.php?id=<?=$data['id_jenis_barang']?>"  class="btn btn-info">Edit</a>
                            <a href="hapusjenis.php?id=<?=$data['id_jenis_barang']?>" onclick="return confirm('Apakah anda ingin menghapus data ini ?')" class="btn btn-danger">Hapus</a>
                        </div>
                    </td>
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
