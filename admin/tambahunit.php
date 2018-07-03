<?php
    $judul = "Koperasi Bahagia";
    $lokasi1 = "Administrasi";
    $lokasi2 = "Unit kerja";
    $lokasi3 = "Tambah Unit Kerja";
    $linklokasi2 = "unitkerja.php";
    $linklokasi3 = "tambahunit.php";
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsi.php";
    $kodebarang = kodeunit();
    
?>
<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Tambah Unit Kerja</h2>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-5 ">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="">ID Unit Kerja</label>
                        <input type="text" class="form-control" name="id_unit_kerja" id="idunit" value="<?=$kodebarang?>" readonly>
                    </div>    
                    <div class="form-group">
                        <label for="unitkerja">Unit Kerja</label>
                        <input type="text" class="form-control" name="unit_kerja" id="unitkerja" required>
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
        if (tambahunit($_POST) > 0) {
            echo "
            <script>
            alert('Data berhasil ditambahkan');
            document.location.href = 'unitkerja.php';
            </script>
            ";
        } else {
            echo "
            <script>
            alert('Data gagal ditambahkan');
            document.location.href = 'tambahunit.php';            
            </script>
            ";
            echo("<br>");
            echo mysqli_error($koneksi);        
        }
    }
?>