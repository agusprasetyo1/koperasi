<?php
    $judul = "Koperasi Bahagia";
    $lokasi1 = "Administrasi";
    $lokasi2 = "User";
    $lokasi3 = "Registrasi";
    $linklokasi2 = "user.php";
    $linklokasi3 = "registrasi.php";
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsi.php";
    $kodeuser = kodeuser();
    
?>
<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Registrasi User</h2>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-5 ">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="">ID User</label>
                        <input type="text" class="form-control" name="id_user" value="<?=$kodeuser?>" readonly>
                    </div>    
                    <div class="form-group">
                        <label for="jenis">Nama</label>
                        <input type="text" class="form-control" name="nama" id="jenis" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password2">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="password2" id="password2" required>
                    </div>
                    <div class="form-group">
                        <label for="akses">Akses</label>
                        <select name="akses" id="akses" class="form-control">
                            <option value="" selected disabled>Pilih akses</option>
                            <option value="2">Kasir</option>
                            <option value="3">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-success" name="submit" value="Simpan">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    include "template/footer.php";
    if (isset($_POST['submit'])) {
        if (registrasi($_POST) > 0) {
            echo "
            <script>
            alert('Data user berhasil ditambahkan');
            document.location.href = 'user.php';
            </script>
            ";
        } else {
            echo "
            <script>
            alert('Data gagal ditambahkan');
            // document.location.href = 'tambahjenis.php';            
            </script>
            ";
            echo("<br>");
            echo mysqli_error($koneksi);        
        }
    }
?>