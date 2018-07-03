<?php
ini_set("display_errors", 0);
    include "fungsitransaksi.php";
    $id_umum = $_GET['umum'];
    $id_anggota = $_GET['anggota'];
    $id = $_GET['id'];

    if (isset($_GET['umum'])) {
        if (hapus_keranjang_umum($id_umum) > 0) {
            echo "
            <script>
                alert('Hapus keranjang sukses');
                document.location.href = 'pembelianumum.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Hapus keranjang gagal');
                document.location.href = 'pembelianumum.php';
            </script>
        ";
        echo("<br>");
        echo mysqli_error($koneksi);
    }
        
    }else if (isset($_GET['anggota'])){
        if (hapus_keranjang_anggota($id_anggota) > 0) {
            echo "
            <script>
                alert('Hapus keranjang sukses');
                document.location.href = 'pilihbarang.php?id=$id';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Hapus keranjang gagal');
                // document.location.href = 'pembeliananggota.php';
            </script>
        ";
        echo("<br>");
        echo mysqli_error($koneksi);
    }   
    }
?>