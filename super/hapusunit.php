<?php
    include "fungsi.php";
    $id = $_GET['id'];

    if (hapusunit($id) > 0) {
        echo "
            <script>
                alert('Hapus data sukses');
                document.location.href = 'unitkerja.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Hapus data gagal');
                document.location.href = 'unitkerja.php';
            </script>
        ";
        echo("<br>");
        echo mysqli_error($koneksi);
    }
    
?>