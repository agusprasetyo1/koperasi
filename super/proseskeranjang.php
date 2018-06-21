<?php
    include "fungsitransaksi.php";
    $id = $_POST['id'];
    
    $q1 = mysqli_query($koneksi, "SELECT * from detil_jual_umum d inner join barang b on d.id_barang = b.id_barang where status = '$id'");
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
        <?php
            while ($data = mysqli_fetch_array($q1)) {
        ?>
            <div class="col-md-12 mb-1" style="background:#e9e9e9">
                <div>
                    <div style="margin:5px 0;font-size:17px;">
                        <img src="../img/barang/<?=$data['gambar']?>" width="90" height="100" alt="">
                        <?=$data['nama_barang']?>
                        <a href="hapuskeranjang.php?umum=<?=$data['id_detil_umum']?>" class="btn btn-danger" style="float:right;margin-top:8%;">Hapus</a>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
            <div class="btn-group mt-3">
                <a href="keranjang_bayar.php" class="btn keranjang">Bayar
                    <i class="fa fa-cart-arrow-down"></i>
                </a>
            </div>
    </div>