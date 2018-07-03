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
    $id = $_GET['id'];
    $data = query("SELECT * FROM barang where id_barang = '$id'")[0];    
?>
<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Tambah Unit Kerja</h2>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-5 ">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" class="form-horizontal" name="tambahbarang" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="">ID Barang</label>
                        <input type="text" class="form-control" name="id_barang" id="idunit" value="<?=$data['id_barang']?>" readonly>
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
                        <input type="text" class="form-control" name="nama" id="nama" value="<?=$data['nama_barang']?>" placeholder="Nama Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="hargabeli">Harga Beli</label>
                        <input type="number" class="form-control" onfocus="hapus();" name="hargabeli" id="hargabeli" value="<?=$data['harga_beli']?>" placeholder="Harga beli" required>
                    </div>
                    <div class="form-group">
                        <label for="hargajual">Harga Jual</label>
                        <div class="input-group btn-group">
                            <input type="text" class="form-control" value="<?=$data['harga_jual']?>" name="hargajual" id="hargajual" placeholder="Rp. " readonly required>
                            <input type="button" class="btn btn-dark" onclick="hitung();" value="Hitung">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="text" class="form-control" name="stok" id="stok" value="<?=$data['stok']?>" placeholder="Stock barang" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan Stok</label>
                        <input type="text" class="form-control" name="keterangan" value="<?=$data['keterangan_stok']?>" id="keterangan" placeholder="Keterangan stok" required>
                    </div>
                    <label for="gambar">Gambar</label>
                    <div class="form-group input-group">
                        <img src="../img/barang/<?=$data['gambar']?>" width="100" height="100" alt="">
                        <input type="file" class="form-control ml-1" name="gambar" id="gambar">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-success" name="submit" value="Simpan">
                    </div> 
                    <input type="hidden" name="gambarlama" value="<?=$data['gambar']?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function hitung() {
        var input = document.getElementById('hargabeli').value;
        var hitung = (input * 1) + ((input * 1) * 0.2);
        document.getElementById('hargajual').value = hitung;
    }
    function hapus() {
        
        document.getElementById('hargajual').value = '';
        // document.getElementById('nama').value = 'sadasd';
    }
</script>
<?php
    include "template/footer.php";
    if (isset($_POST['submit'])) {
        if (editbarang($_POST) > 0) {
            echo "
            <script>
            alert('Data berhasil diedit');
            document.location.href = 'barang.php';
            </script>
            ";
        } else {
            echo "
            <script>
            alert('Data gagal diedit');
            document.location.href = 'editbarang.php?id=$id';            
            </script>
            ";
            echo("<br>");
            echo mysqli_error($koneksi);        
        }
    }
?>
