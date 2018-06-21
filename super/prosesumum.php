<?php
    include "fungsitransaksi.php";
    $id = $_POST['id'];
    $data = query("SELECT * from barang b inner join jenis_barang j on b.id_jenis_barang = j.id_jenis_barang where id_barang = '$id' ")[0];
    $kode = kodejualumum();    
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8" align="center">
                <div>
                    <img src="../img/barang/<?=$data['gambar']?>" width="230" height="250" alt="">
                </div>
                <div sty class="text-value-sm">
                    <?=$data['nama_barang']?>
                </div>
                <div style="font-size:16px; color:#c20808;">
                    Rp<?= number_format($data['harga_jual'],0,",",".")?>
                </div>
                <div class="brand-card-body">
                    <div>
                        <div>STOK</div>
                        <div class="text-value"><?=$data['stok']?> <?=$data['keterangan_stok']?></div>
                    </div>
                    <div>
                        <div>JENIS</div>
                        <div class="text-value"><?=$data['jenis']?></div>
                    </div>
                </div>
            </div>

                    
        <form action="" method="post">
            <input type="hidden" name="id_jual_umum" value="<?= $kode?>">
            <input type="hidden" name="id_barang" value="<?=$id?>">
            <input type="hidden" name="harga" value="<?=$data['harga_jual']?>">
            <input type="hidden" name="id_user" value="US001">

            <div class="btn-group mt-3">
            <button type="submit" name="msk_keranjang" class="btn keranjang">Masukan Keranjang <i class="fa fa-cart-arrow-down"></i></button>
                <a href="bayarumum.php?id=<?=$id?>" class="btn bayar">Bayar
                    <i class="fa fa-money"></i>
                </a>
            </div>  
        </form>
        </div>
    </div>