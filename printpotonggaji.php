<?php
  session_start();
  if (!isset($_SESSION['username'])) {
    header('Location: ./');
  }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <?php
            include_once("koneksi/koneksi.php");
            //Mencari total potong gaji setiap anggota bedasarkan bulan dan tahun sekarang 
            $q = mysqli_query($koneksi ,"SELECT a.*, g.*, sum(potongan) as 'potongan_gaji'  from gaji g inner join anggota a on g.id_anggota = a.id_anggota 
            inner join detil_jual_anggota d on g.id_jual_anggota = d.id_jual_anggota WHERE d.status = '2' 
            group by g.id_anggota, month(tgl_potong), year(tgl_potong) order by tgl_potong");
        ?>
        <h1 align="center" class="mt-3 mb-3">Data potong gaji</h1>
        <table class="table table-striped table-hover table-bordered">
                    <tr align="center">
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Unit Kerja</th>
                        <th>Gaji Awal</th>
                        <th>Jumlah Potongan</th>
                        <th>Gaji Bersih</th>
                        <th>Periode Gaji</th>
                    </tr>
                    <?php
                        $i = 1;
                        // foreach ($gaji as $data) {
                            while ($data = mysqli_fetch_assoc($q)) {
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

                            $q2 = mysqli_query($koneksi ,"SELECT * from anggota a inner join unit_kerja u on a.id_unit_kerja = u.id_unit_kerja where a.id_anggota = '$data[id_anggota]' ");
                            $data1 = mysqli_fetch_assoc($q2);
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
                            </tr>
                        <?php } ?>
                </table>          
        </div>
    </div>
</div>

<script src="js/datatables.min.js"></script>
<script type='text/javascript'>
        $(document).ready(function () {
            $('.data').DataTable();
        });
</script>
<script>
    //Melakukan perintah print layar ketika masuk ke halaman ini
    window.load = print_d();
    function print_d(){
        window.print();
        // window.location = './super/potonggaji.php'
    }
</script>
<?php
    //Pengaturan posisi ketika setelah dilakukanya print data
    if ($_SESSION['akses'] == 1) {
        // echo "<script>window.location = './super/potonggaji.php'</script>";
    }else if($_SESSION['akses'] == 2){
        echo "<script>window.location = './kasir/potonggaji.php'; </script>";    
    }else{
        echo "<script>window.location = './admin/potonggaji.php'; </script>";    
    }
?>

</body>
</html>