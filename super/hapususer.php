<?php
    include "fungsi.php";
    $id = $_GET['id'];

    if (hapususer($id) > 0) {
        echo "
            <script>
                alert('Hapus data sukses');
                document.location.href = 'user.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Hapus data gagal');
                document.location.href = 'user.php';
            </script>
        ";
        echo("<br>");
        echo mysqli_error($koneksi);
    }
    
?>