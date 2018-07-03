<?php
    include "fungsitransaksi.php";
    $ambil = $_POST['idanggota'];
    $bln = $_POST['ambilbln'];
    $thn = $_POST['ambilthn'];
    $q1 = mysqli_query($koneksi, "SELECT j.*, a.*, d.*,sum(sub_total) as 'total', sum(jumlah) as 'jumlahbeli'  FROM gaji j inner join anggota a on j.id_anggota = a.id_anggota inner join detil_jual_anggota d
            on d.id_jual_anggota = j.id_jual_anggota where d.status = '2' and d.id_anggota = '$ambil'and month(tgl_potong) = '$bln' and year(tgl_potong) = '$thn' group by id_barang ");
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
        <form action="" method="post" name="ubah_jumlah">
        <?php
            while ($data = mysqli_fetch_assoc($q1)) {
                $barang = query("SELECT * from barang b inner join detil_jual_anggota d on b.id_barang = d.id_barang where d.id_anggota = '$ambil' and d.id_barang = '$data[id_barang]' ")[0];
        ?>
            <div class="col-md-12 mb-2" style="background:#e9e9e9"> 
                <div class="row" style="margin-top:5px; margin-bottom:5px;font-size:17px;">
                    <div class="col-md-3">
                        <img src="../img/barang/<?=$barang['gambar']?>" width="90" height="100%" alt="">
                    </div>
                    <div class="col-md-5" style="">
                        <font class="small text-muted">Nama Barang</font> <br>
                        <font class="text-value-sm"><?=$barang['nama_barang']?></font> <br>
                        <font class="small text-muted">Harga</font> <br>
                        <font class="text-value-sm">Rp<?=number_format($data['harga'], 0, ",", ".")?></font>
                    </div>
                    <div class="col-md-4">
                        <font class="small text-muted">Jumlah Beli</font> <br>
                        <font class="text-value-sm"><?=$data['jumlahbeli']." ".$barang['keterangan_stok']?></font> <br>
                        <font class="small text-muted">Total</font> <br>
                        <font class="text-value-sm">Rp<?=number_format($data['total'], 0, ",", ".")?></font>
                    </div>
                </div>
            </div>
            
        <?php 
        } 
        
        ?>
    </div>