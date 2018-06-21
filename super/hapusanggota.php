<?php
    include "fungsi.php";
    $id = $_GET['id'];

    if (hapusanggota($id) > 0) {
        echo "
            <script>
                alert('Hapus data sukses');
                document.location.href = 'anggota.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Hapus data gagal');
                document.location.href = 'anggota.php';
            </script>
        ";
        echo("<br>");
        echo mysqli_error($koneksi);
    }
    
?>