<?php
    $link = $_GET['id'];
    $judul = "Koperasi Bahagia";
    $lokasi1 = "Administrasi";
    $lokasi2 = "Barang";
    $lokasi3 = "Tambah Stok";
    $linklokasi2 = "barang.php";
    $linklokasi3 = "editjenis.php?id=$link";
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsi.php";
    $id = $_GET['id'];
    $data = query("SELECT * FROM barang where id_barang = '$id'")[0];
    $stokawal = $data['stok'];    
?>
<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Tambah stok barang</h2>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-5 ">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="idunit" value="<?=$data['nama_barang']?>" readonly>
                    </div>    
                    <div class="form-group">
                        <label for="jenis">Jumlah penambahan stok</label>
                        <input type="number" class="form-control" min="1" value="1" name="jumlah" id="jumlah" required>
                    </div>
                    <input type="hidden" name="stokawal" value="<?=$stokawal?>">
                    <input type="hidden" name="id_barang" value="<?=$data['id_barang']?>">
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
        if (tambahstok($_POST) > 0) {
            echo "
            <script>
                alert('Penambahan stok sukses');
                document.location.href = 'barang.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Data gagal diedit');
                document.location.href = 'tambahstok.php?id=$id';            
            </script>
            ";
            echo("<br>");
            echo mysqli_error($koneksi);        
        }
    }
?>