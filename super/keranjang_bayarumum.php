<?php
    ini_set("display_errors", 0);
    $judul = "Koperasi Bahagia";
    $lokasi1 = "Pembelian";
    $lokasi2 = "Pembelian Umum";
    $lokasi3 = "Bayar umum";
    $linklokasi2 = "pembelianumum.php";
    $linklokasi3 = "";
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsitransaksi.php";
    $kode = kodejualumum();
    $q1 = mysqli_query($koneksi, "SELECT * from detil_jual_umum d inner join barang b on d.id_barang = b.id_barang where status = '0' ");
    $total_semua = 0;
?>

    <div class="container-fluid">
        <h2 align="center" class="pt-3 pb-3">Pembayaran Umum</h2>
        <hr>
        <div class="row justify-content-center input-group">

            <div class="col-md-8 col-sm-12">

                <?php
                    $a = 0;    
                    while ($data = mysqli_fetch_assoc($q1)) {
                        $total_semua += $data['sub_total'];
                        ?>
                        
                    <div class="row mb-2 justify-content-center">
                        <div class="col-md-3">
                            <img src="../img/barang/<?=$data['gambar']?>" width="100%" height="130" alt="">
                        </div>
                        <div class="col-md-8 " style="background:#dfdede;">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="" method="post" name="bayarumum">
                                        <div class="form-group">
                                            <div>
                                                Nama barang
                                            </div>
                                            <div class="text-value-sm">
                                                <?=$data['nama_barang']?>
                                            </div>
                                        </div>
                                        <div class="form-group mt-4">
                                            <div>
                                                Harga
                                            </div>
                                            <div class="text-value-sm">
                                                Rp
                                                <?= number_format($data['harga_jual'],0,",",".")?>
                                            </div>
                                        </div>
                                </div>
                                <div class=" col-md-6">
                                    <div class="form-group mt-0 ">
                                        <div>
                                            Jumlah Beli
                                        </div>
                                        <div class="card-group text-value-sm">
                                            <?=$data['jumlah']?> <?=$data['keterangan_stok']?>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4">
                                        <div>
                                            Subtotal
                                        </div>
                                        <div class="text-value-sm input-group">
                                            <font>Rp </font>
                                            <font name="subtotal">
                                                <?=number_format($data['sub_total'],0, ",", ".")?>
                                            </font>
                                            <?php echo "<input type='hidden' name='ambil_id_barang[$a]' value='$data[id_barang]'>" ?>
                                            <?php echo "<input type='hidden' name='sisa_stok[$a]' value='$data[stok]'>" ?>
                                            <?php echo "<input type='hidden' name='jumlah_beli_stok[$a]' value='$data[jumlah]'>" ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        $a++; 
                        } 
                    ?>
            </div>
            <div class="col-md-4 ">
                <div class="col-md-12" style="float:right;height:100%">
                    <form action="" method="post" name="bayarumum">
                        <div class="form-group">
                            <div>
                                <label for="bayar">Bayar</label>
                                <input type="text" class="form-control" name="bayar" autocomplete="off" id="bayar" onFocus="mulaihitung();" onBlur="stophitung();"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            Subtotal
                            <div style="float:right;font-size:15px;font-weight:700">
                                Rp
                                <font>
                                    <?=number_format($total_semua, 0, ",", ".")?>
                                </font>
                            </div>
                        </div>
                        <div class="form-group">
                            Kembali
                            <div style="float:right;font-size:15px;font-weight:700">
                                Rp
                                <font id="kembali" name="kembali"></font>
                            </div>
                        </div>
                        <input type="submit" name="proses" value="Bayar" class="btn btn-success form-control mt-2">
                        <a href="pembelianumum.php" class="btn btn-warning form-control mt-1">Kembali</a>

                        <input type="hidden" name="semua" id="semua" value="<?=$total_semua?>">
                        <input type="hidden" name="id_jual_umum" value="<?=$kode?>">
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    <?php
    $bayar = $_POST['bayar'];
    $total = $_POST['semua'];

    if (isset($_POST['proses'])) {
        if ($bayar < $total) {
            echo "
                <script>
                    alert('Harap menginputkan jumlah bayar dengan benar');
                </script>
            ";
        }else{
            $i = 0;
            while ($i < $a) {
                $id_brng = $_POST['ambil_id_barang'][$i];
                $stok = $_POST['sisa_stok'][$i];
                $stok_beli = $_POST['jumlah_beli_stok'][$i];
                $sisa = $stok - $stok_beli;
                $query = "UPDATE barang SET stok = '$sisa' where id_barang = '$id_brng' ";
                mysqli_query($koneksi, $query);
                $i++;
            }
            echo "<pre>";
            var_dump($_POST);
            echo "</pre>";
            if (bayar_keranjang_umum($_POST) > 0) {
                echo "
                <script>
                    alert('Pembayaran sukses');
                    document.location.href = 'pembelianumum.php';
                </script>
                ";
            }else{
                echo "
                    <script>
                        alert('Pembayaran gagal');
                        // document.location.href = 'tambahbarang.php';            
                    </script>
                ";
                echo("<br>");
                echo mysqli_error($koneksi);    
            }
        }
        
    }
?>
        <script>
            function mulaihitung() {
                interval = setInterval("hitung()", 1);
            }

            function hitung() {
                bayar = document.bayarumum.bayar.value;
                totalsemua = document.getElementById('semua').value;
                if (bayar >= totalsemua * 1) {
                    kembali = bayar - totalsemua;
                    document.getElementById('kembali').innerHTML = kembali;
                } else {
                    document.getElementById('kembali').innerHTML = 0;
                }
            }

            function stophitung() {
                clearInterval(interval);
            }
        </script>

        <?php
    include "template/footer.php";
?>