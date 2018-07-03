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
    $gaji = query("SELECT a.*, g.*, sum(potongan) as 'potongan_gaji'  from gaji g inner join anggota a on g.id_anggota = a.id_anggota 
             inner join detil_jual_anggota d on g.id_jual_anggota = d.id_jual_anggota WHERE d.status = '2' 
             group by g.id_anggota, month(tgl_potong), year(tgl_potong) order by tgl_potong");
    
?>
<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Data potong gaji</h2>
    <div class="row justify-content-center">
        <div class="col-sm-12 col-lg-12 ">
            <a href="../printpotonggaji.php" class="btn btn-primary mb-2">Print data</a>
            <table class="table table-striped table-hover table-bordered" id="data">
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Unit Kerja</th>
                        <th>Gaji Awal</th>
                        <th>Jumlah Potongan</th>
                        <th>Gaji Bersih</th>
                        <th>Periode Gaji</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
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

                            $data1 = query("SELECT * from anggota a inner join unit_kerja u on a.id_unit_kerja = u.id_unit_kerja where a.id_anggota = '$data[id_anggota]' ")[0];
                            $gajibersih = $data1['gaji_pokok'] - $data['potongan_gaji'];
                            $ambilbulan = date("m", strtotime($data['tgl_potong']));
                            $ambiltahun = date("Y", strtotime($data['tgl_potong']));
                    ?>
                        <tr align="center">
                            <td><?=$i++?>.</td>
                            <td><?=$data['nama']?></td>
                            <td><?=$data1['unit_kerja']?></td>
                            <td>Rp<?=number_format($data1['gaji_pokok'], 0, ",", ".")?></td>
                            <td>Rp<?=number_format($data['potongan_gaji'], 0, ",", ".")?></td>
                            <td>Rp<?=number_format($gajibersih, 0, ",", ".")?></td>
                            <td><?=$bulan?>-<?=date("Y", strtotime($data['tgl_potong']))?></td>
                            <td><a href="#" class="btn btn-info lihatdetil" id-anggota=<?=$data['id_anggota']?> bln="<?=$ambilbulan?>" thn="<?=$ambiltahun?>">Lihat Detil</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
            </table>
            <div class="clearfix mb-3"></div>
             <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?php
    include "template/footer.php";
?>
<script>
    $(function(){
        $(document).on('click','.lihatdetil',function(e){
            e.preventDefault();
            $("#myModal").modal('show');
            $.post('prosesdetil.php',
                {idanggota:$(this).attr('id-anggota'),
                    ambilbln:$(this).attr('bln'),
                    ambilthn:$(this).attr('thn') },
                function(html){
                    $(".modal-body").html(html);
                }   
            );
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#data').DataTable();
    });
</script>
