<?php
    $judul = "Koperasi Bahagia";
    $lokasi1 = "Administrasi";
    $lokasi2 = "Anggota";
    $lokasi3 = "";
    $linklokasi2 = "anggota.php";
    $linklokasi3 = "";
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsi.php";

    $anggota = query("SELECT * from anggota a inner join unit_kerja u on a.id_unit_kerja = u.id_unit_kerja order by id_anggota");
    if (isset($_POST['cari'])) {
        $anggota = carianggota($_POST['inputcari']);
    }

    ?>

<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Anggota</h2>
    <div class="row">
        <!-- <div class="col-md-12"> -->
            <table class="table table-striped table-hover table-bordered table-align-middle" id="data">
                <thead align="center" style="font-weight:bolder">
                    <tr>
                        <th>No</th>
                        <th>ID Anggota</th>
                        <th>NPP</th>
                        <th>Nama</th>
                        <th>Unit Kerja</th>
                        <th>Tempat, Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Tanggal Jadi Anggota</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i = 1;
                    foreach ($anggota as $data) {
                        ?>
                <tr align="center">
                    <td><?=$i++?>.</td>
                    <td><?=$data['id_anggota']?></td>
                    <td><?=$data['npp']?></td>
                    <td><?=$data['nama']?></td>
                    <td><?=$data['unit_kerja']?></td>
                    <td><?=$data['tempat']?>, <?=date("d-m-Y", strtotime($data['tgl_lahir']))?></td>
                    <td><?=$data['jenis_kelamin']?></td>
                    <td><?=$data['alamat']?></td>
                    <td><?= date("d-m-Y", strtotime($data['tgl_jadi_anggota'])) ?></td>
                    <td><img src="../img/anggota/<?=$data['gambar']?>" alt="" height="130" width="100"></td>
                </tr>
                <?php } ?>
            </tbody>
            </table>
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