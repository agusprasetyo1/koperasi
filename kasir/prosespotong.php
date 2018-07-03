<?php
    include "fungsitransaksi.php";
    $id_anggota = $_POST['id'];
    $ambiltgl = date("m");
    $ambilthn = date("Y");
    
   
    $q1 = mysqli_query($koneksi ,"SELECT a.id_anggota ,sum(potongan) as 'totalpotong', g.tgl_potong, u.gaji_pokok  from anggota a inner join gaji g on g.id_anggota = a.id_anggota inner join unit_kerja u
                    on u.id_unit_kerja = a.id_unit_kerja  WHERE a.id_anggota = '$id_anggota' and month(tgl_potong) = '$ambiltgl' and year(tgl_potong) = '$ambilthn'  group by g.id_anggota, month(tgl_potong), year(tgl_potong) " );
    $q2 = query("SELECT * from anggota a inner join unit_kerja u on a.id_unit_kerja = u.id_unit_kerja where a.id_anggota = '$id_anggota' ")[0];
    $potonggaji = mysqli_fetch_assoc($q1);
    $cek = mysqli_num_rows($q1);
    if (isset($_POST['id'])) {
        if ($cek == 1) {
            $total_potongan = $potonggaji['totalpotong'];
        }else{
            $total_potongan = 0;
        }
    }
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="" method="post">
                <div>
                    Gaji pokok : <?=$q2['gaji_pokok']?>
                </div>
                <div>
                    Potongan : <?=$total_potongan?>
                </div>
                <div>
                    Periode bulan : <?=date("M-Y")?>
                </div>
                <input type="submit" value="Simpan" name="potonggaji">
            </form>
        </div>
    </div>
</div>