<?php
ini_set("display_errors", 0);

$judul = "Koperasi Bahagia";
$lokasi1 = "Pembelian";
$lokasi2 = "Pembelian Anggota";
$lokasi3 = "Potong Gaji";
$linklokasi2 = "pembeliananggota.php";
$linklokasi3 = "";
include "template/header.php";
include "template/menu.php";
include "template/lokasi.php";
include "fungsitransaksi.php";
$id = $_GET['id_barang']; //Mengambil id barang
$ambil_id = $_GET['id_ang']; //MEngambil ID anggota
$kode = kodejualanggota(); //kode jual anggota

$ambiltgl = date("m");
$ambilthn = date("Y");
//Untuk mengambil total potongan gaji
$q1 = mysqli_query($koneksi ,"SELECT a.id_anggota ,sum(potongan) as 'totalpotong', g.tgl_potong from gaji g inner join anggota a on g.id_anggota = a.id_anggota 
        WHERE a.id_anggota = '$ambil_id' and month(tgl_potong) = '$ambiltgl' and year(tgl_potong) = '$ambilthn'  group by g.id_anggota, month(tgl_potong), year(tgl_potong) " );

//Ambil gaji bedasarkan
$ambilgaji = query("SELECT * from anggota a inner join unit_kerja u on a.id_unit_kerja = u.id_unit_kerja where a.id_anggota = '$ambil_id' ")[0];
$potonggaji = mysqli_fetch_assoc($q1);
$cek = mysqli_num_rows($q1);
if (isset($_GET['id_ang'])) {
    if ($cek == 1) {
        $total_potongan = $potonggaji['totalpotong'];
    }else{
        $total_potongan = 0;
    }
}

$data = query("SELECT * from barang where id_barang = '$id' ")[0];
?>

    <div class="container-fluid">

            <br> 
            <h2 align="center" class="pt-3 pb-3">Pembayaran Potong Gaji Anggota</h2>
            <hr>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="../img/barang/<?=$data['gambar']?>" width="270" height="300" alt="">
                        </div>
                        <div class="col-md-4 mt-3">
                            <form action="" method="post" name="bayarumum">
                                
                                <div class="form-group">
                                    <div>
                                        Nama barang
                                    </div>
                                    <div class="text-value">
                                        <?=$data['nama_barang']?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div>
                                        Harga
                                    </div>
                                    <div class="text-value">
                                        Rp
                                        <?= number_format($data['harga_jual'],0,",",".")?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="stok">Jumlah Stok Beli</label>
                                    <div class="card-group">
                                        <input type="number" class="form-control" style="width:100px;" value="1" autofocus name="beli_stok" min="1" max="<?=$data['stok']?>"
                                            id="beli_stok" onFocus="mulaihitung();" onBlur="stophitung();">
                                        <font style="margin-top:6px;">&nbsp;
                                            <?=$data['keterangan_stok']?>
                                        </font>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-4 mt-3">
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
                                    <font id="subtotal2"></font>
                                </div>
                            </div>
                            <div class="form-group">
                                Sisa Gaji
                                <div style="float:right;font-size:15px;font-weight:700">
                                    Rp
                                    <font id="sisa"></font>
                                </div>
                            </div>

                            <input type="hidden" name="id_anggota" value="<?=$ambil_id?>">
                            <input type="hidden" name="id_user" value="US001">
                            <input type="hidden" name="id_jual_anggota" id="id_jual_umum" value="<?=$kode?>">
                            <input type="hidden" name="stok_awal" value="<?=$data['stok']?>">
                            <input type="hidden" name="id_barang" value="<?=$id?>">
                            <input type="hidden" name="harga_jual" id="harga_jual" value="<?=$data['harga_jual']?>">
                            <input type="hidden" name="subtotal" id="subtotal">
                            <input type="hidden" name="tanggal" value="<?= date(" Y-m-d ") ?>">
                            <!-- Untuk Gaji -->
                            <input type="hidden" name="gajipokok" value="<?=$ambilgaji['gaji_pokok']?>" id="gajipokok">
                            <input type="hidden" name="potongan" value="<?=$total_potongan?>" id="potongan">
                            <input type="hidden" name="sisaakhir" id="sisaakhir">
                            <!--  -->
                            <div align="center">
                                <input type="submit" name="proses" value="Potong Gaji" style="background:#dfc800;color:black" class="btn form-control mt-3">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    <?php

    $sisaakhir = $_POST['sisaakhir'];

    if (isset($_POST['proses'])) {
            if (potonggaji_anggota($_POST) > 0) {
            echo "
                <script>
                    alert('Pembayaran potong gaji sukses');
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

        <script>
            function mulaihitung() {
                interval = setInterval("hitung()", 1);
            }

            function hitung() {
                stok = document.bayarumum.beli_stok.value;
                hargajual = document.bayarumum.harga_jual.value;
                gajipokok = document.bayarumum.gajipokok.value;
                potongan = document.bayarumum.potongan.value;
                sisaawal = gajipokok - potongan;
                subtotal = stok * hargajual;
                sisaakhir = sisaawal - subtotal;
                document.bayarumum.sisaakhir.value = sisaakhir; //Mengambil sisagaji
                document.getElementById('sisa').innerHTML = sisaakhir;
                document.bayarumum.subtotal.value = subtotal;
                document.getElementById('subtotal2').innerHTML = subtotal;
            }

            function stophitung() {
                clearInterval(interval);
            }
        </script>

        <?php
            include "template/footer.php";
        ?>