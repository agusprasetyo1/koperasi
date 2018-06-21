<?php
    include "fungsi.php";
    $id = $_GET['id'];

    if (hapusbarang($id) > 0) {
        echo "
            <script>
                alert('Hapus data sukses');
                document.location.href = 'barang.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Hapus data gagal');
                document.location.href = 'barang.php';
            </script>
        ";
        echo("<br>");
        echo mysqli_error($koneksi);
    }
    
?>