<?php
    $judul = "Koperasi Bahagia";
    $lokasi1 = "Administrasi";
    $lokasi2 = "Anggota";
    $lokasi3 = "Edit Anggota";
    $linklokasi2 = "anggota.php";
    $linklokasi3 = "editanggota.php";
    include "template/header.php";   
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsi.php";
    $kodeanggota = kodeanggota();
    $id = $_GET['id'];
    $data = query("SELECT * FROM anggota where id_anggota = '$id'")[0];
?>
<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Edit Anggota</h2>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-5 ">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="">ID Anggota</label>
                        <input type="text" class="form-control" name="id_anggota" value="<?=$id?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Anggota</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?=$data['nama']?>" placeholder="Nama Anggota" required>
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
                        <input type="text" class="form-control" name="npp" id="npp" maxlength="5" value="<?=$data['npp']?>" placeholder="Nomer Pokok Pegawai" required>
                    </div>
                    <div class="form-group">
                        <label for="tempat">Tempat, Tanggal lahir</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Tempat" value="<?=$data['tempat']?>" name="tempat" id="tempat" required>
                            <input type="date" class="form-control" placeholder="tanggal" value="<?=$data['tgl_lahir']?>" name="tgl_lahir" required>
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
                        <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="2" placeholder="Alamat"><?=$data['alamat']?></textarea>
                    </div>
                        <label>Foto Anggota</label>
                    <div class="form-group input-group">
                        <img src="../img/anggota/<?=$data['gambar']?>" width="100" height="100" alt="">
                        <input type="file" class="form-control ml-1" name="gambar" id="gambar" >
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
<?php
    include "template/footer.php";

    if (isset($_POST['submit'])) {
        if (editanggota($_POST) > 0) {
            echo "
            <script>
            alert('Data berhasil diedit');
            document.location.href = 'anggota.php';
            </script>
            ";
        } else {
            echo "
            <script>
            alert('Data gagal ditambahkan');
            // document.location.href = 'editanggota.php';            
            </script>
            ";
            echo("<br>");
            echo mysqli_error($koneksi);        
        }
    }
?>
