<?php
    include "fungsi.php";
    $id = $_GET['id'];

    if (hapusjenis($id) > 0) {
        echo "
            <script>
                alert('Hapus data sukses');
                document.location.href = 'jenisbarang.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Hapus data gagal');
                document.location.href = 'jenisbarang.php';
            </script>
        ";
        echo("<br>");
        echo mysqli_error($koneksi);
    }
    
?>