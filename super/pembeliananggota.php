<?php
    $judul = "Koperasi Bahagia";
    $lokasi1 = "Pembelian";
    $lokasi2 = "Pembelian Anggota";
    $lokasi3 = "";
    $linklokasi2 = "pembeliananggota.php";
    $linklokasi3 = "";
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsitransaksi.php";
    
    $anggota = query("SELECT * from anggota a inner join unit_kerja u on a.id_unit_kerja = u.id_unit_kerja order by a.id_unit_kerja ASC");
    if (isset($_POST['cari'])) {
        $anggota = carianggota($_POST['inputcari']);
    }

    ?>

<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Pembelian Anggota</h2>
        <div class="row">
            <div class="col-md-12">
                <div style="float:right;">
                    <form action="" method="post" class="input-group btn-group form-inline  mb-2" >
                        <input type="text" size="25" name="inputcari" autofocus="on" id="inputcari" class="form-control" placeholder="Masukan Nama Anggota"  required>
                        <input type="submit" class="btn btn-success" style="font-size:15px;padding:0px 30px;" name="cari"  id="cari"  value="Cari">
                    </form>
                </div>
            </div>        
        </div>
    <div class="row">
        <?php
            foreach ($anggota as $data) {
                
        ?>

        <a href="pilihbarang.php?id=<?=$data['id_anggota']?>" class="card-link edit-record">
        <div class="col-sm-4 col-lg-3 ">
            <div class="brand-card beliumum">
                <div class="card-body pb-3 mt-3">
                    <div class="brand-card-header">
                        <img src="../img/anggota/<?=$data['gambar']?>" width="130" height="150" alt="<?=$data['nama']?>">
                    </div>
                </div>
                <div class="brand-card-body">
                    <div>
                        <div style="font-size:15px;" class="text-value-sm"><?=$data['nama']?></div>
                        <div style="font-size:13px"><?=$data['unit_kerja']?></div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php } ?>
    </div>
</div>
<?php
    include "template/footer.php";
?>