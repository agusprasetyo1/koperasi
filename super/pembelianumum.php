<?php
    $judul = "Koperasi Bahagia";
    $lokasi1 = "Pembelian";
    $lokasi2 = "Pembelian Umum";
    $lokasi3 = "";
    $linklokasi2 = "pembelianumum.php";
    $linklokasi3 = "";
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsitransaksi.php";

    $barang = query("SELECT * from barang order by id_barang");
    if (isset($_POST['cari'])) {
        $barang = cariumum($_POST['inputcari']);
    }

    $q = mysqli_query($koneksi, "select count(id_barang) as jumlah from detil_jual_umum where status = '0' ");
    $data = mysqli_fetch_assoc($q);
    $jmlkeranjang = $data['jumlah'];   
    
    ?>

<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Pembelian Umum</h2>
        <div class="row">
            <div class="col-md-12">
                <div style="float:right;">
                    <form action="" method="post" class="input-group btn-group form-inline  mb-2" >
                        <input type="text" size="25" name="inputcari" id="inputcari" class="form-control" placeholder="Masukan Nama Barang"  required>
                        <input type="submit" class="btn btn-success" style="font-size:15px;padding:0px 30px;" name="cari"  id="cari"  value="Cari">
                    </form>
                </div>

                <div>
                    <font style="font-size:15px;color:#696969"> Keranjang <b> <?=$jmlkeranjang?> </b> Barang 
                    </font>
                    <a href="#" data-id="0" class="card-link edit-keranjang btn btn-info"><i class="fa fa-cart-plus"></i></a>
                    
                </div>
            </div>        
        </div>
    <div class="row">
        <?php
            foreach ($barang as $data) {
        ?>

        <a href="#" data-id="<?=$data['id_barang']?>" class="card-link edit-record">
        <div class="col-sm-4 col-lg-3 ">
            <div class="brand-card beliumum">
                <div class="card-body pb-3 mt-3">
                    <div class="brand-card-header">
                        <img src="../img/barang/<?=$data['gambar']?>" width="130" height="150" alt="<?=$data['nama_barang']?>">
                    </div>
                </div>
                <div class="brand-card-body">
                    <div>
                        <div style="font-size:15px;"><?=$data['nama_barang']?></div>
                        <div style="font-size:13px;color:#c20808;">Rp<?= number_format($data['harga_jual'],0,",",".")?></div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <!-- Modal BARANG -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Pilih Aksi</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    </div>
                    <div class="modal-body mt-3 mb-1">
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    <!-- modal -->
    <?php } ?>
    </div>
</div>
<!-- Modal KERANJANG -->
<div class="modal fade" id="modalKeranjang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Keranjang</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body mt-1 mb-0">
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
    <!-- modal -->
    <?php
        if (isset($_POST['msk_keranjang'])) {
            if (tambah_keranjang_umum($_POST) > 0) {
                echo "
                    <script>
                        alert('Input keranjang sukses');
                        window.location = 'pembelianumum.php';
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert('Input keranjang gagal');
                        // document.location.href = 'tambahanggota.php';            
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
<script>
    // Keranjang
    $(function(){
            $(document).on('click','.edit-keranjang',function(e){
                e.preventDefault();
                $("#modalKeranjang").modal('show');
                $.post('proseskeranjang.php',
                    {id:$(this).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }   
                );
            });
        });
</script>
<script>
        //Barang
        $(function(){
            $(document).on('click','.edit-record',function(e){
                e.preventDefault();
                $("#myModal").modal('show');
                $.post('prosesumum.php',
                    {id:$(this).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }   
                );
            });
        });
</script>


