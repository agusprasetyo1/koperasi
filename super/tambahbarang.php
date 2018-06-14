<?php
    $judul = "Koperasi Bahagia";
    $lokasi1 = "Administrasi";
    $lokasi2 = "Barang";
    $lokasi3 = "Tambah Barang";
    $linklokasi2 = "barang.php";
    $linklokasi3 = "tambahbarang.php";
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsi.php";
    $kodebarang = kodebarang();
    
?>
<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Tambah Unit Kerja</h2>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-5 ">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" class="form-horizontal">
                    <div class="form-group ">
                        <label for="">ID Barang</label>
                        <input type="text" class="form-control" name="id_unit_kerja" id="idunit" value="<?=$kodebarang?>" readonly>
                    </div>    
                    <div class="form-group">
                        <label for="jenis">Jenis Barang</label>
                        <select name="jenis" id="jenis" style="text-align:center;" class="form-control select-dropdown" required>
                            <option value="" selected disabled>Pilih Jenis Barang</option>
                            <?php
                            include "../koneksi/koneksi.php";
                            $query = mysqli_query($koneksi, "select * from jenis_barang");
                            while ($show = mysqli_fetch_assoc($query)) {
                                echo "<option value='$show[id_jenis_barang]'>$show[jenis]</option>";
                            }
                            ?>
                    </select>
                </div>
                    <div class="form-group">
                        <label for="nama">Nama Barang</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="hargabeli">Harga Beli</label>
                        <input type="text" class="form-control" name="hargabeli" id="hargabeli" placeholder="Harga beli" required>
                    </div>
                    <div class="form-group">
                        <label for="hargabeli">Harga Jual</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="hargajual" id="hargajual" placeholder="Harga Jual" readonly required>
                            <input type="button" value="Hitung">
                        </div>
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