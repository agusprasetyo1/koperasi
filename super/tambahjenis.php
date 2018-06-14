<?php
    $judul = "Koperasi Bahagia";
    $lokasi1 = "Administrasi";
    $lokasi2 = "Jenis Barang";
    $lokasi3 = "Edit Jenis Barang";
    $linklokasi2 = "jenisbarang.php";
    $linklokasi3 = "tambahjenis.php";
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsi.php";
    $kodebarang = kodejenis();
    
?>
<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Tambah Jenis Barang</h2>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-5 ">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="">ID Jenis Barang</label>
                        <input type="text" class="form-control" name="id_jenis_barang" value="<?=$kodebarang?>" readonly>
                    </div>    
                    <div class="form-group">
                        <label for="jenis">Jenis Barang</label>
                        <input type="text" class="form-control" name="jenis" id="jenis" required>
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
        if (tambahjenis($_POST) > 0) {
            echo "
            <script>
            alert('Data berhasil ditambahkan');
            document.location.href = 'jenisbarang.php';
            </script>
            ";
        } else {
            echo "
            <script>
            alert('Data gagal ditambahkan');
            document.location.href = 'tambahjenis.php';            
            </script>
            ";
            echo("<br>");
            echo mysqli_error($koneksi);        
        }
    }
?>