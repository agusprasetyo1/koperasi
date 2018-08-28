<?php
    $judul = "Koperasi Bahagia";
    $lokasi1 = "Super Admin";
    $lokasi2 = "Ubah Password";
    $lokasi3 = "";
    $linklokasi2 = "";
    $linklokasi3 = "";
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";  
    include "fungsi.php";
?>
    <h2 align="center" class="pt-3 pb-3">Ubah Password</h2>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-5 ">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="idunit">Password lama</label>
                        <input type="password" autofocus="on" class="form-control" name="passwordlama" id="idunit" required>
                    </div>    
                    <div class="form-group">
                        <label for="passwordbaru">Password Baru</label>
                        <input type="password" class="form-control" name="passwordbaru" id="passwordbaru" required>
                    </div>
                    <div class="form-group">
                        <label for="konfirmasipass">Konfirmasi password baru</label>
                        <input type="password" class="form-control" name="konfirmasipass" id="konfirmasipass" required>
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
    if (isset($_POST['submit'])) {
        $passwordlama = $_POST['passwordlama'];
        $passwordbaru = $_POST['passwordbaru'];
        $konfirmasipass = $_POST['konfirmasipass'];
        $id_user = $_SESSION['id_user'];
        
        $data = query("SELECT * FROM user where id_user = '$id_user' ")[0];
        
        if (password_verify($passwordlama, $data['password'])) {
            if ($passwordbaru != $konfirmasipass) {
                echo "<script>alert('Password yang anda masukan tidak sesuai');</script>";
                return false;
            }
            $password = password_hash($passwordbaru,PASSWORD_DEFAULT);
            mysqli_query($koneksi, "UPDATE user SET password = '$password' where id_user = '$id_user' ");
            if (mysqli_affected_rows($koneksi) > 0) {
                echo "<script>
                alert('Password berhasil dirubah');
                window.location = './';
                </script>";
            }
        }else{
            echo "<script>alert('Password yang anda masukan tidak sesuai');</script>";
        }
    }

?>
<?php 
    include "template/footer.php";
?>