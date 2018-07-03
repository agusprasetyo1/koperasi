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

    $user = query("SELECT * from user where akses = '2' OR akses = '3' ");

    ?>

<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">User</h2>
    <div class="row justify-content-center">
        <div class="col-sm-12 col-lg-12 ">
            <a href="registrasi.php" class="btn btn-primary mb-2">Registrasi User</a>

            <table class="table table-striped table-hover table-bordered table-align-middle" id="data">
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>ID User</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Akses</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
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

                    
