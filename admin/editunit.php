<?php
    $link = $_GET['id'];
    $judul = "Koperasi Bahagia";
    $lokasi1 = "Administrasi";
    $lokasi2 = "Unit kerja";
    $lokasi3 = "Edit Unit Kerja";
    $linklokasi2 = "unitkerja.php";
    $linklokasi3 = "editunit.php?id=$link";
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsi.php";
    $id = $_GET['id'];
    $data = query("SELECT * FROM unit_kerja where id_unit_kerja = '$id'")[0];    
?>
<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Edit Unit Kerja</h2>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-5 ">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="">ID Unit Kerja</label>
                        <input type="text" class="form-control" name="id_unit_kerja" id="idunit" value="<?=$data['id_unit_kerja']?>" readonly>
                    </div>    
                    <div class="form-group">
                        <label for="unitkerja">Unit Kerja</label>
                        <input type="text" class="form-control" name="unit_kerja" id="unitkerja" value="<?=$data['unit_kerja']?>" required>
                    </div>
                    <div class="form-group">
                        <label for="gajipokok">Gaji Pokok</label>
                        <input type="number" class="form-control" name="gaji_pokok" id="gajipokok" min="100000" value="<?=$data['gaji_pokok']?>" required>
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
        if (editunit($_POST) > 0) {
            echo "
            <script>
            alert('Data berhasil diedit');
            document.location.href = 'unitkerja.php';
            </script>
            ";
        } else {
            echo "
            <script>
            alert('Data gagal diedit');
            document.location.href = 'editunit.php?id=$id';            
            </script>
            ";
            echo("<br>");
            echo mysqli_error($koneksi);        
        }
    }
?>