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
    $id = $_GET['id'];
    $kode = kodejualumum();
    $data = query("SELECT * from barang where id_barang = '$id' ")[0];
?>

    <div class="container-fluid">
        <h2 align="center" class="pt-3 pb-3">Pembayaran Umum</h2>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-4">
                        <img src="../img/barang/<?=$data['gambar']?>" width="270" height="300" alt="">    
                    </div>
                    <div class="col-md-4">
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
                                Rp<?= number_format($data['harga_jual'],0,",",".")?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="stok">Jumlah Stok Beli</label>
                            <div class="card-group">
                                <input type="number" class="form-control" style="width:100px;" value="1" autofocus name="beli_stok" min="1" max="<?=$data['stok']?>" id="beli_stok" onFocus="mulaihitung();" onBlur="stophitung();">
                                <font style="margin-top:6px;">&nbsp;<?=$data['keterangan_stok']?></font>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                Subtotal
                            </div>
                            <div class="text-value input-group">
                                    <font>Rp </font> 
                                    <font name="subtotal" id="subtotal"></font> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div>
                                    <label for="bayar">Bayar</label>
                                    <input type="text" class="form-control" name="bayar" autocomplete = "off" id="bayar" onFocus="mulaihitung();" onBlur="stophitung();" required>
                                </div>
                            </div>
                            <div class="form-group">
                                    Harga
                                    <div style="float:right;font-size:15px;font-weight:700">
                                        Rp<?= number_format($data['harga_jual'],0, ",", ".")?>
                                    </div>
                            </div>
                            <div class="form-group">
                                Subtotal                                
                                <div style="float:right;font-size:15px;font-weight:700">
                                    Rp<font id="subtotal2"></font>
                                </div>
                            </div>
                            <div class="form-group">
                                Kembali
                                <div style="float:right;font-size:15px;font-weight:700">
                                    Rp<font id="kembali"></font>
                                </div>
                            </div>
                            <input type="hidden" name="id_jual_umum" id="id_jual_umum" value="<?=$kode?>">
                            <input type="hidden" name="stok_awal" value="<?=$data['stok']?>">
                            <input type="hidden" name="id_barang" value="<?=$id?>">
                            <input type="hidden" name="harga_jual" id="harga_jual" value="<?=$data['harga_jual']?>">
                            <input type="hidden" name="subtotal" id="subtotal" >
                            <input type="hidden" name="tanggal" value="<?= date("Y-m-d") ?>">
                            <input type="submit" name="proses" value="Bayar" class="btn btn-success form-control mt-4">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    $bayar = $_POST['bayar'];
    $subtotal = $_POST['subtotal'];


    if (isset($_POST['proses'])) {
        if ($bayar < $subtotal) {
            echo "
                <script>
                    alert('Harap menginputkan jumlah bayar dengan benar');
                    window.location('bayarumum.php?id=$id');
                </script>
            ";
        }else{
            if (bayarumum($_POST) > 0) {
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
                document.location.href = 'tambahbarang.php';            
            </script>
            ";
            echo("<br>");
            echo mysqli_error($koneksi); 
            }
            
            
        }
        
    }
?>
<script>
    function mulaihitung(){
        interval = setInterval("hitung()",1);
    }
    function hitung(){
        stok = document.bayarumum.beli_stok.value;
        hargajual = document.bayarumum.harga_jual.value; 
        bayar = document.bayarumum.bayar.value; 
        subtotal = stok * hargajual;
        document.bayarumum.subtotal.value = subtotal; 
        document.getElementById('subtotal').innerHTML = subtotal;
        document.getElementById('subtotal2').innerHTML = subtotal;
        if (bayar >= subtotal) {
            kembali = bayar - subtotal
            document.getElementById('kembali').innerHTML = kembali;
        }else{
            document.getElementById('kembali').innerHTML = 0;
        }    
}
function stophitung(){
    clearInterval(interval);}
</script>

<?php
    include "template/footer.php";
?>