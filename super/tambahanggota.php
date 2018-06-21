<?php
    $judul = "Koperasi Bahagia";
    $lokasi1 = "Administrasi";
    $lokasi2 = "Anggota";
    $lokasi3 = "Tambah Anggota";
    $linklokasi2 = "anggota.php";
    $linklokasi3 = "tambahanggota.php";
    include "template/header.php";   
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsi.php";
    $kodeanggota = kodeanggota();

?>
<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Tambah Anggota</h2>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-5 ">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="">ID Anggota</label>
                        <input type="text" class="form-control" name="id_anggota" value="<?=$kodeanggota?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Anggota</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Anggota" required>
                    </div>    
                    <div class="form-group">
                        <label for="unit">Unit Kerja</label>
                        <select name="unit" id="jenis" style="text-align:center;" class="form-control select-dropdown" required>
                            <option value="" selected disabled>Pilih Unit Kerja</option>
                            <?php
                            include "../koneksi/koneksi.php";
                            $query = mysqli_query($koneksi, "select * from unit_kerja");
                            while ($show = mysqli_fetch_assoc($query)) {
                                echo "<option value='$show[id_unit_kerja]'>$show[unit_kerja]</option>";
                            }
                            ?>
                    </select>
                </div>
                    <div class="form-group">
                        <label for="npp">NPP (Nomer Pokok Pegawai)</label>
                        <input type="text" class="form-control" name="npp" id="npp" maxlength="5" placeholder="Nomer Pokok Pegawai" required>
                    </div>
                    <div class="form-group">
                        <label for="tempat">Tempat, Tanggal lahir</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Tempat" name="tempat" id="tempat" required>
                            <input type="date" class="form-control" placeholder="tanggal" name="tgl_lahir" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stok">Jenis Kelamin</label>
                        <select name="jeniskelamin" id="stok" class="form-control select-dropdown">
                            <option value="" selected disabled>Pilih jenis kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="2" placeholder="Alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Foto Anggota</label>
                        <input type="file" class="form-control" name="gambar" id="gambar" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-success" name="submit" value="Simpan">
                    </div>
                    <input type="hidden" name="jadianggota" value=<?=date("Y-m-d")?>>  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    include "template/footer.php";

    if (isset($_POST['submit'])) {
        if (tambahanggota($_POST) > 0) {
            echo "
            <script>
            alert('Data berhasil ditambahkan');
            document.location.href = 'anggota.php';
            </script>
            ";
        } else {
            echo "
            <script>
            alert('Data gagal ditambahkan');
            // document.location.href = 'tambahanggota.php';            
            </script>
            ";
            echo("<br>");
            echo mysqli_error($koneksi);        
        }
    }
?>
