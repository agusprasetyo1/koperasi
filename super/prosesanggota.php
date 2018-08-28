<?php
    session_start();
    include "fungsitransaksi.php";
    $ambil = $_POST['ambilanggota'];
    $id = $_POST['id'];
    $data = query("SELECT * from barang b inner join jenis_barang j on b.id_jenis_barang = j.id_jenis_barang where id_barang = '$id' ")[0];
    $kode = kodejualanggota();    
    ?>
    <form action="" method="post">
                <input type="hidden" name="id_jual_anggota" value="<?= $kode?>">
                <input type="hidden" name="id_barang" value="<?=$id?>">
                <input type="hidden" name="harga" value="<?=$data['harga_jual']?>">
                <input type="hidden" name="id_anggota" value="<?=$ambil?>">
                <input type="hidden" name="id_user" value="<?= $_SESSION['id_user'] ?>">
        <button type="submit" name="msk_keranjang" class="btn keranjang"><i class="fa fa-cart-arrow-down"></i> Masukan Keranjang
        </button>
    </form>
    <div class="container-fluid mt-1">
        <div class="row justify-content-center">
            <div class="col-md-8" align="center">
                <div>
                    <img src="../img/barang/<?=$data['gambar']?>" width="250" height="200" alt="">
                </div>
                <div sty class="text-value-sm">
                    <?=$data['nama_barang']?>
                </div>
                <div style="font-size:16px; color:#c20808;">
                    Rp
                    <?= number_format($data['harga_jual'],0,",",".")?>
                </div>
                <div class="brand-card-body">
                    <div>
                        <div>STOK</div>
                        <div class="text-value">
                            <?=$data['stok']?>
                                <?=$data['keterangan_stok']?>
                        </div>
                    </div>
                    <div>
                        <div>JENIS</div>
                        <div class="text-value">
                            <?=$data['jenis']?>
                        </div>
                    </div>
                </div>
            </div>
                <div class="btn-group mt-3">
                    <a href="bayaranggotalangsung.php?id_ang=<?=$ambil?>&id_barang=<?=$id?>" class="btn keranjang">Bayar Langsung
                    <i class="fa fa-money"></i>
                </a>
                <a href="bayaranggotagaji.php?id_ang=<?=$ambil?>&id_barang=<?=$id?>" style="color:black;background:#dfc800;" class="btn">Potong Gaji
                    <i class="fa fa-money"></i>
                </a>
                </div>
        </div>
    </div>