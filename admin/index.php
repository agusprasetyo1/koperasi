<?php
    ini_set("display_errors", 0);   
    $judul = "Koperasi Bahagia";
    $lokasi1 = "Admin";
    $lokasi2 = "Dashboard";
    $linklokasi2 = "index.php";
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";
    include "../koneksi/koneksi.php";

    $q1 = mysqli_query($koneksi, "select count(id_barang) as jumlah from barang");
    $data1 = mysqli_fetch_assoc($q1);
    $q2 = mysqli_query($koneksi, "select count(id_anggota) as jumlah from anggota");
    $data2 = mysqli_fetch_assoc($q2);
    $q3 = mysqli_query($koneksi, "select count(id_unit_kerja) as jumlah from unit_kerja");
    $data3 = mysqli_fetch_assoc($q3);
    $jumlahbarang = $data1['jumlah'];    
    $jumlahanggota = $data2['jumlah'];    
    $jumlahunit = $data3['jumlah'];
        
?>
    <div class="container-fluid">
        <h1 align="center" class="pt-3">Selamat datang di Koperasi Bahagia</h1>
        <div class="row pt-5">

            <div class="col-sm-6 col-lg-4">
                <div class="brand-card">
                    <div class="brand-card-header bg-facebook">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="card-body pb-0">
                        <div class="text-value" align="center">Jumlah Anggota</div>
                    </div>
                    <div class="brand-card-body">
                        <div>
                            <div class="text-value"><?=$jumlahanggota?></div>
                            <div class="text-uppercase text-muted small">Orang</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 col-lg-4">
                <div class="brand-card">
                    <div class="brand-card-header bg-twitter">
                        <i class="fa fa-dropbox"></i>
                    </div>
                    <div class="card-body pb-0">
                        <div class="text-value" align="center">Jumlah Barang Dijual</div>
                    </div>
                    <div class="brand-card-body">
                        <div>
                            <div class="text-value"><?=$jumlahbarang?></div>
                            <div class="text-uppercase text-muted small">Item</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 col-lg-4">
                <div class="brand-card">
                    <div class="brand-card-header bg-linkedin">
                        <i class="icon-settings"></i>
                    </div>
                    <div class="card-body pb-0">
                        <div class="text-value" align="center">Jumlah Unit Kerja koperasi</div>
                    </div>
                    <div class="brand-card-body">
                        <div>
                            <div class="text-value"><?=$jumlahunit?></div>
                            <div class="text-uppercase text-muted small">Unit Kerja</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

<?php
    include "template/footer.php";
?>