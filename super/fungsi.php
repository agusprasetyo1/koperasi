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

    //Kode unit
    function kodeunit(){
        global $koneksi;

        $query = mysqli_query($koneksi, "select max(id_unit_kerja) as maxkode from unit_kerja ");
        $data = mysqli_fetch_array($query);
        $kodebarang = $data['maxkode'];
        $nourut = (int)substr($kodebarang,3, 3);
        $nourut++;
        $char = "UK";
        $kodebarang = $char.sprintf("%03s", $nourut);
        return $kodebarang;
    }

    //Tambah data unit
    function tambahunit($data){
        global $koneksi;
        $id = htmlspecialchars($data['id_unit_kerja']);
        $unitkerja = htmlspecialchars($data['unit_kerja']);
        
        $query = "INSERT INTO unit_kerja VALUES ('$id', '$unitkerja')";
        $data = mysqli_query($koneksi, $query);
        // var_dump($data);
        return mysqli_affected_rows($koneksi);
    }

    //Hapus data unit
    function hapusunit($id){
        global $koneksi;
        $query = "DELETE from unit_kerja where id_unit_kerja = '$id' ";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //Edit data unit
    function editunit($data){
        global $koneksi;
        $id = $data['id_unit_kerja'];
        $unitkerja = htmlspecialchars($data['unit_kerja']);
        
        $query = "UPDATE unit_kerja SET
            unit_kerja = '$unitkerja'
            WHERE id_unit_kerja = '$id' ";

        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //Kode jenis
    function kodejenis(){
        global $koneksi;

        $query = mysqli_query($koneksi, "select max(id_jenis_barang) as maxkode from jenis_barang");
        $data = mysqli_fetch_array($query);
        $kodebarang = $data['maxkode'];
        $nourut = (int)substr($kodebarang,3, 3);
        $nourut++;
        $char = "JB";
        $kodebarang = $char.sprintf("%03s", $nourut);
        return $kodebarang;
    }

    //Tambah data jenis
    function tambahjenis($data){
        global $koneksi;
        $id = htmlspecialchars($data['id_jenis_barang']);
        $jenis = htmlspecialchars($data['jenis']);
        
        $query = "INSERT INTO jenis_barang VALUES ('$id', '$jenis')";
        $data = mysqli_query($koneksi, $query);
        // var_dump($data);
        return mysqli_affected_rows($koneksi);
    }

    //Hapus data unit
    function hapusjenis($id){
        global $koneksi;
        $query = "DELETE from jenis_barang where id_jenis_barang = '$id' ";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //Edit data unit
    function editjenis($data){
        global $koneksi;
        $id = $data['id_jenis_barang'];
        $jenis = htmlspecialchars($data['jenis']);
        
        $query = "UPDATE jenis_barang SET
            jenis = '$jenis'
            WHERE id_jenis_barang = '$id' ";

        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

     //Kode barang
     function kodebarang(){
        global $koneksi;

        $query = mysqli_query($koneksi, "select max(id_barang) as maxkode from barang ");
        $data = mysqli_fetch_array($query);
        $kodebarang = $data['maxkode'];
        $nourut = (int)substr($kodebarang,3, 3);
        $nourut++;
        $char = "BR";
        $kodebarang = $char.sprintf("%03s", $nourut);
        return $kodebarang;
    }

?>