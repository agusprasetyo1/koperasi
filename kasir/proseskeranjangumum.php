<?php
    include "fungsitransaksi.php";
    $id = $_POST['id'];
    
    $q1 = mysqli_query($koneksi, "SELECT * from detil_jual_umum d inner join barang b on d.id_barang = b.id_barang where status = '$id'");
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
        <form action="" method="post" name="ubah_jumlah">
        <?php
            $i = 0;
            while ($data = mysqli_fetch_array($q1)) {
        ?>
            <div class="col-md-12 mb-1" style="background:#e9e9e9"> 
                <div class="row" style="margin-top:5px; margin-bottom:5px;font-size:17px;">
                    <div class="col-md-3">
                        <img src="../img/barang/<?=$data['gambar']?>" width="90" height="100" alt="">
                    </div>
                    <div class="col-md-7" style="margin-top:4%">
                        <font class="text-value-sm"><?=$data['nama_barang']?></font>

                        <div class="card-group">
                            <?php echo "<input type='number' class='form-control' style='width:100px;' value='$data[jumlah]' min='1' max='$data[stok]'  name='stok_beli[$i]'>" ?>
                           <font style="margin-top:5px;">&nbsp;<?=$data['keterangan_stok']?></font>

                        <?php echo "<input type='hidden' name='id_detil_umum[$i]' value='$data[id_detil_umum]' >" ?>
                        <?php echo "<input type='hidden' name='id_barang[$i]' value='$data[id_barang]'>" ?>
                        <?php echo "<input type='hidden' name='harga[$i]' value='$data[harga_jual]'>" ?>
                        </div>
                    </div>
                    <div class="col-md-2" style="margin-top:7%">
                        <a href="hapuskeranjang.php?umum=<?=$data['id_detil_umum']?>" onclick="return confirm('Apakah anda yakin menghapus barang ini ?')" class="btn btn-danger" style="float:right;margin-top:8%;">Hapus</a>
                    </div>
                </div>
            </div>
            
        <?php 
        $i++;

        } 
        
        ?>
            <div class="btn-group mt-3">
                <button type="submit" name="bayarkeranjang" class="btn keranjang">Bayar <i class="fa fa-cart-arrow-down"></i></button>
            </form>
        </div>
            </div>
    </div>