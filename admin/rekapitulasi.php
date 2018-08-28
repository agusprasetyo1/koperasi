<?php
    $judul = "Koperasi Bahagia";
    $lokasi1 = "Super Admin";
    $lokasi2 = "Potong Gaji";
    $lokasi3 = "";
    $linklokasi2 = "";
    $linklokasi3 = "";
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsitransaksi.php";

    // $bln = 02;
    $q1 = mysqli_query($koneksi ,"SELECT sum(d.jumlah) as 'jml', b.*, j.*  FROM detil_jual_umum d inner join jual_umum j on j.id_jual_umum = d.id_jual_umum
    inner join barang b on b.id_barang = d.id_barang group by d.id_barang , month(j.tgl_transaksi), year(j.tgl_transaksi) order by tgl_transaksi ");
    
?>
<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Rekapitulasi</h2>
    <div class="row justify-content-center">
        <div class="col-sm-12 col-lg-12 ">
            <table class="table table-striped table-hover table-bordered table-align-middle" id="data">
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>ID Barang</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Periode Bulan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        // foreach ($q1 as $data) {
                        while($data = mysqli_fetch_assoc($q1)){
                            $tgl = date("m", strtotime($data['tgl_transaksi']));
                            switch ($tgl) {
                                case '01':
                                    $bulan = "Januari";
                                    break;
                                case '02':
                                    $bulan = "Pebruari";
                                    break;
                                case '03':
                                    $bulan = "Maret";
                                    break;
                                case '04':
                                    $bulan = "April";
                                    break;
                                case '05':
                                    $bulan = "Mei";
                                    break;
                                case '06':
                                    $bulan = "Juni";
                                    break;
                                case '07':
                                    $bulan = "Juli";
                                    break;
                                case '08':
                                    $bulan = "Agustus";
                                    break;
                                case '09':
                                    $bulan = "September";
                                    break;
                                case '10':
                                    $bulan = "Oktober";
                                    break;
                                case '11':
                                    $bulan = "Nopember";
                                    break;
                                case '12':
                                    $bulan = "Desember";
                                    break;                   
                            }

                    ?>
                        <tr>
                            <td align="center"><?=$i++?>.</td>
                            <td align="center"><img src="../img/barang/<?=$data['gambar']?>" alt="<?=$data['nama_barang']?>" width='130' height='100'></td>
                            <td><?=$data['nama_barang']?></td>
                            <td><?=$data['jml']." ".$data['keterangan_stok']?></td>
                            <td align="center"><?=$bulan." ".date("Y", strtotime($data['tgl_transaksi']))?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
            </table>
            <div class="clearfix mb-3"></div>
        </div>
    </div>
</div>
<?php
    include "template/footer.php";
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#data').DataTable();
    });
</script>
