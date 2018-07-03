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

    ?>

<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Anggota</h2>
    <div class="row justify-content-center">
        <div class="col-sm-12 col-lg-12 ">
            <a href="tambahanggota.php" class="btn btn-primary mb-2">Tambah data</a>

            <table class="table table-striped table-hover table-bordered table-align-middle" id="data">
                <thead >
                    <tr align="center">
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
                        <th>Aksi</th>
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
                    <td>
                        <div class="btn-group">
                            <a href="editanggota.php?id=<?=$data['id_anggota']?>"  class="btn btn-info">Edit</a>
                            <a href="hapusanggota.php?id=<?=$data['id_anggota']?>" onclick="return confirm('Apakah anda ingin menghapus data ini ?')" class="btn btn-danger">Hapus</a>
                        </div>
                    </td>
                </tr>
                    <?php } ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
    include "template/footer.php";
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#data').DataTable();
    });
</script>
