<?php
    ini_set("display_errors", 0);
    $ambil_id = $_GET['id_ang'];

    $judul = "Koperasi Bahagia";
    $lokasi1 = "Pembelian";
    $lokasi2 = "Pembelian Anggota";
    $lokasi3 = "Bayar Potong Gaji Anggota";
    $linklokasi2 = "pembeliananggota.php";
    $linklokasi3 = "";
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsitransaksi.php";
    $kode = kodejualanggota();
    $q1 = mysqli_query($koneksi, "SELECT * from detil_jual_anggota d inner join barang b on d.id_barang = b.id_barang where status = '0' and id_anggota = '$ambil_id' ");
    $total_semua = 0;

    $ambiltgl = date("m");
    $ambilthn = date("Y");
    //Untuk mengambil total potongan gaji anggota
    $q2 = mysqli_query($koneksi ,"SELECT a.id_anggota ,sum(potongan) as 'totalpotong', g.tgl_potong from gaji g inner join anggota a on g.id_anggota = a.id_anggota 
            WHERE a.id_anggota = '$ambil_id' and month(tgl_potong) = '$ambiltgl' and year(tgl_potong) = '$ambilthn'  group by g.id_anggota, month(tgl_potong), year(tgl_potong) " );

    //Ambil gaji bedasarkan id angota
    $ambilgaji = query("SELECT * from anggota a inner join unit_kerja u on a.id_unit_kerja = u.id_unit_kerja where a.id_anggota = '$ambil_id' ")[0];
    $potonggaji = mysqli_fetch_assoc($q2);
    $cek = mysqli_num_rows($q2);
    if (isset($_GET['id_ang'])) {
        if ($cek == 1) {
            $total_potongan = $potonggaji['totalpotong'];
        }else{
            $total_potongan = 0;
        }
    }
?>

    <div class="container-fluid">
        <h2 align="center" class="pt-3 pb-3">Pembayaran Potong Gaji Anggota</h2>
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
                        $sisagaji = $ambilgaji['gaji_pokok'] - $total_potongan - $total_semua;
                    ?>
            </div>
            <div class="col-md-4 ">
                <div class="col-md-12" style="float:right;height:100%">
                    <form action="" method="post" name="bayarumum">
                        <div class="form-group">
                            Gaji Pokok
                            <div style="float:right;font-size:15px;font-weight:700">
                                Rp
                                <?= number_format($ambilgaji['gaji_pokok'],0, ",", ".")?>
                            </div>
                        </div>
                        <div class="form-group">
                            Total Potongan/<?=date("M")." ".date("Y")?> 
                            <div style="float:right;font-size:15px;font-weight:700">
                                Rp
                                <?= number_format($total_potongan,0, ",", ".")?>
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
                            Sisa Gaji
                            <div style="float:right;font-size:15px;font-weight:700">
                                Rp
                                <font>
                                    <?=number_format($sisagaji, 0, ",", ".") ?>
                                </font>
                            </div>
                        </div>
                        <div align="center">
                                <input type="submit" name="proses" value="Potong Gaji" style="background:#dfc800;color:black" class="btn form-control mb-2">
                        </div>

                        <input type="hidden" name="semua" id="semua" value="<?=$total_semua?>">
                        <input type="hidden" name="id_jual_anggota" value="<?=$kode?>">
                        <input type="hidden" name="id_anggota" value="<?=$ambil_id?>">
                        <input type="hidden" name="sisagaji" value="<?=$sisagaji?>">
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
            if (potonggaji_keranjang_anggota($_POST) > 0) {
                echo "
                <script>
                    alert('Pembayaran Potong Gaji sukses');
                    document.location.href = 'pembeliananggota.php';
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
?>

<?php
    include "template/footer.php";
?>