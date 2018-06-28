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
    $gaji = query("SELECT a.*, g.*, u.nama as 'nama_user', sum(potongan) as 'potongan_gaji'  from gaji g inner join anggota a on g.id_anggota = a.id_anggota 
                    inner join user u on g.id_user = u.id_user group by g.id_anggota, month(tgl_potong), year(tgl_potong) order by tgl_potong");
?>
<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Data potong gaji</h2>
    <div class="row justify-content-center">
        <div class="col-sm-12 col-lg-12 ">
            <a href="tambahunit.php" class="btn btn-primary mb-2">Print data</a>
            <table class="table table-striped table-hover table-bordered">
                <tr align="center">
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Nama Kasir</th>
                    <th>Gaji Awal</th>
                    <th>Jumlah Potongan</th>
                    <th>Gaji Bersih</th>
                    <th>Periode Gaji</th>
                </tr>
                <?php
                    $i = 1;
                    $bulan;
                    foreach ($gaji as $data) {
                        $tgl = date("m", strtotime($data['tgl_potong']));
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
                <tr align="center">
                    <td><?=$i++?>.</td>
                    <td><?=$data['nama']?></td>
                    <td><?=$data['nama_user']?></td>
                    <td>Rp<?=number_format($data['gaji'], 0, ",", ".")?></td>
                    <td>Rp<?=number_format($data['potongan_gaji'], 0, ",", ".")?></td>
                    <td>Rp<?=number_format($data['gajibersih'], 0, ",", ".")?></td>
                    <td><?=$bulan?>-<?=date("Y", strtotime($data['tgl_potong']))?></td>
                </tr>
                    <?php } ?>
            </table>
        </div>
    </div>
</div>
<?php
    include "template/footer.php";
?>