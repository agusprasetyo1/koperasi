<?php
    include "../koneksi/koneksi.php";
    
    function query($query_kedua){
        global $koneksi;

        $result = mysqli_query($koneksi, $query_kedua);
        $rows = [];
        while ($data = mysqli_fetch_assoc($result)) {
            $rows[] = $data;
        }
        return $rows;
    }

    function cariumum($data){
        $query = "SELECT * from barang where nama_barang like '%$data%' ";
        return query($query);
    }

     //Kode barang
     function kodejualumum(){
        global $koneksi;

        $query = mysqli_query($koneksi, "select max(id_jual_umum) as maxkode from jual_umum ");
        $data = mysqli_fetch_array($query);
        $kodebarang = $data['maxkode'];
        $nourut = (int)substr($kodebarang,3, 3);
        $nourut++;
        $char = "JU";
        $kodebarang = $char.sprintf("%03s", $nourut);
        return $kodebarang;
    }

    //bayar umum
    function bayarumum($data){
        global $koneksi;
        
        $id_jual_umum = $data['id_jual_umum'];
        $tgl_trak = $data['tanggal'];
        // $total = $data['subtotal'];

        $id_user = 'US001';
        $harga = $data['harga_jual'];
        $jumlah = $data['beli_stok'];
        $total = $data['subtotal'];
        $id_barang = $data['id_barang'];

        $sisastok = $data['stok_awal'] - $data['beli_stok'];

        $query1 = "INSERT into jual_umum values ('$id_jual_umum', '$tgl_trak', '$total')";
        $query2 = "INSERT into detil_jual_umum values ('', '$id_barang', '$id_jual_umum', '$id_user', '$harga', '$jumlah', '$total', '1 ')";
        $query3 = "UPDATE barang SET stok = '$sisastok' where id_barang = '$id_barang' ";
        $data1 = mysqli_query($koneksi, $query1);
        $data2 = mysqli_query($koneksi, $query2);
        $data3 = mysqli_query($koneksi, $query3);

        return mysqli_affected_rows($koneksi);        
    }

    //Hapus data keranjang UMUM
    function hapus_keranjang_umum($id){
        global $koneksi;

        $query = "DELETE from detil_jual_umum where id_detil_umum = '$id' ";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //Hapus data keranjang ANGGOTA
    function hapus_keranjang_anggota($id){
        global $koneksi;

        $query = "DELETE from detil_jual_anggota where id_detil_anggota = '$id' ";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    function tambah_keranjang_umum($data){
        global $koneksi;

        $id_jual_umum = $data['id_jual_umum'];
        $id_barang = $data['id_barang'];
        $harga = $data['harga'];
        $id_user = $data['id_user'];
        $query = "INSERT into detil_jual_umum values ('', '$id_barang', '$id_jual_umum', '$id_user', '$harga', '0', '0', '0')";
        mysqli_query($koneksi, $query);        
        return mysqli_affected_rows($koneksi);
    }

    function bayar_keranjang_umum($data){
        global $koneksi;
        $id_jual_umum = $data['id_jual_umum'];
        $total_semua = $data['semua'];
        $tanggal = date("Y-m-d");

        $query1 = "INSERT into jual_umum values ('$id_jual_umum', '$tanggal', '$total_semua') ";
        $query2 = "UPDATE detil_jual_umum SET status = '1' where id_jual_umum = '$id_jual_umum' and status = '0' ";
        mysqli_query($koneksi, $query1);
        mysqli_query($koneksi, $query2);

        return mysqli_affected_rows($koneksi);
    }

?>