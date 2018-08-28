<?php
    include "../koneksi/koneksi.php";
    // $q = mysqli_query($koneksi, "select * from unit_kerja");
    
    function query($query_kedua){
        global $koneksi;

        $result = mysqli_query($koneksi, $query_kedua);
        $rows = [];
        while ($data = mysqli_fetch_assoc($result)) {
            $rows[] = $data;
        }
        return $rows;
    }
?>