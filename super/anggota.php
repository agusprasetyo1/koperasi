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
    <div class="row justify-content-center">
        <div class="col-sm-12 col-lg-12 ">
            <a href="tambahanggota.php" class="btn btn-primary mb-2">Tambah data</a>

            <div style="float:right;">
                <form action="" method="post" class="input-group btn-group form-inline  " >
                    <input type="text" size="25" name="inputcari" id="inputcari" class="form-control" placeholder="Masukan nama anggota"  required>
                    <input type="submit" class="btn btn-success" name="cari"  id="cari"  value="Cari">
                </form>
            </div>
            <table class="table table-striped table-hover table-bordered table-align-middle">
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
            </table>
        </div>
    </div>
</div>
<?php
    include "template/footer.php";
?>