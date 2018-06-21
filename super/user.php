<?php
    $judul = "Koperasi Bahagia";
    $lokasi1 = "Administrasi";
    $lokasi2 = "User";
    $lokasi3 = "";
    $linklokasi2 = "user.php";
    $linklokasi3 = "";
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsi.php";

    $user = query("select * from user");
    if (isset($_POST['cari'])) {
        $user = cariuser($_POST['inputcari']);
    }

    ?>

<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">User</h2>
    <div class="row justify-content-center">
        <div class="col-sm-12 col-lg-12 ">
            <a href="registrasi.php" class="btn btn-primary mb-2">Registrasi User</a>

            <div style="float:right;">
                <form action="" method="post" class="input-group btn-group form-inline  " >
                    <input type="text" size="25" name="inputcari" id="inputcari" class="form-control" placeholder="Masukan nama user"  required>
                    <input type="submit" class="btn btn-success" name="cari"  id="cari"  value="Cari">
                </form>
            </div>
            <table class="table table-striped table-hover table-bordered table-align-middle">
                <tr align="center">
                    <th>No</th>
                    <th>ID User</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Akses</th>
                    <th>Aksi</th>
                </tr>
                <?php
                    $i = 1;
                    foreach ($user as $data) {
                        if ($data['akses'] == 1) {
                            $akses = "Pemilik";
                        }else if($data['akses'] == 2){
                            $akses = "Kasir";
                        }else if($data['akses'] == 3){
                            $akses = "admin";
                        }
                ?>
                <tr align="center">
                    <td><?=$i++?>.</td>
                    <td><?=$data['id_user']?></td>
                    <td><?=$data['nama']?></td>
                    <td><?=$data['username']?></td>
                    <td><?=$akses?></td>
                    <td>
                        <div class="btn-group">
                            <a href="hapususer.php?id=<?=$data['id_user']?>" onclick="return confirm('Apakah anda ingin menghapus data ini ?')" class="btn btn-danger">Hapus</a>
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