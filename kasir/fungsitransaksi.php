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

     //Kode anggota
     function kodejualanggota(){
        global $koneksi;

        $query = mysqli_query($koneksi, "select max(id_jual_anggota) as maxkode from jual_anggota ");
        $data = mysqli_fetch_array($query);
        $kodebarang = $data['maxkode'];
        $nourut = (int)substr($kodebarang,3, 3);
        $nourut++;
        $char = "JA";
        $kodebarang = $char.sprintf("%03s", $nourut);
        return $kodebarang;
    }

    //bayar umum
    function bayarumum($data){
        global $koneksi;
        
        $id_jual_umum = $data['id_jual_umum'];
        $tgl_trak = $data['tanggal'];
        // $total = $data['subtotal'];

        $id_user = $data['id_user'];
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
        $query = "INSERT into detil_jual_umum values ('', '$id_barang', '$id_jual_umum', '$id_user', '$harga', '1', '0', '0')";
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

    function carianggota($data){
        $query = "SELECT * from anggota a inner join unit_kerja u on a.id_unit_kerja = u.id_unit_kerja where nama like '%$data%' ";
        return query($query);
    }

    function tambah_keranjang_anggota($data){
        global $koneksi;

        $id_jual_anggota = $data['id_jual_anggota'];
        $id_barang = $data['id_barang'];
        $harga = $data['harga'];
        $id_user = $data['id_user'];
        $id_anggota = $data['id_anggota'];

        $query = "INSERT into detil_jual_anggota values ('', '$id_barang', '0', '$id_anggota', '$id_user', '$harga', '1', '0', '0')";
        mysqli_query($koneksi, $query);        
        return mysqli_affected_rows($koneksi);
    }

    //bayar Anggota
    function bayarlangsung_anggota($data){
        global $koneksi;
        
        $id_jual_anggota = $data['id_jual_anggota'];
        $tgl_trak = $data['tanggal'];

        $id_anggota = $data['id_anggota'];
        $id_user = $data['id_user'];
        $harga = $data['harga_jual'];
        $jumlah = $data['beli_stok'];
        $total = $data['subtotal'];
        $id_barang = $data['id_barang'];

        $sisastok = $data['stok_awal'] - $data['beli_stok'];

        $query1 = "INSERT into jual_anggota values ('$id_jual_anggota', '$tgl_trak', '$total')";
        $query2 = "INSERT into detil_jual_anggota values ('', '$id_barang', '$id_jual_anggota', '$id_anggota', '$id_user', '$harga', '$jumlah', '$total', '1 ')";
        $query3 = "UPDATE barang SET stok = '$sisastok' where id_barang = '$id_barang' ";
        $data1 = mysqli_query($koneksi, $query1);
        $data2 = mysqli_query($koneksi, $query2);
        $data3 = mysqli_query($koneksi, $query3);

        return mysqli_affected_rows($koneksi);        
    }

    //Bayar keranjang anggota
    function bayarlangsung_keranjang_anggota($data){
        global $koneksi;

        $id_jual_anggota = $data['id_jual_anggota'];
        $total_semua = $data['semua'];
        $tanggal = date("Y-m-d");
        $id_anggota = $data['id_anggota'];

        $query1 = "INSERT into jual_anggota values ('$id_jual_anggota', '$tanggal', '$total_semua') ";
        $query2 = "UPDATE detil_jual_anggota SET status = '1', id_jual_anggota = '$id_jual_anggota' where id_jual_anggota = '0' and status = '0' and id_anggota = '$id_anggota' ";
        
        mysqli_query($koneksi, $query1);
        mysqli_query($koneksi, $query2);

        return mysqli_affected_rows($koneksi);
    }

    //Bayar langsung potong gaji
    function potonggaji_anggota($data){
        global $koneksi;
        
        $id_jual_anggota = $data['id_jual_anggota']; //ambil id jual anggota
        $tgl_trak = $data['tanggal']; //Tanggal transaksi sekarang

        $id_anggota = $data['id_anggota'];
        $id_user = $data['id_user'];
        $harga = $data['harga_jual'];
        $jumlah = $data['beli_stok'];
        $total = $data['subtotal']; //Subtotal dan Potongan
        $id_barang = $data['id_barang'];

        $sisastok = $data['stok_awal'] - $data['beli_stok']; //menghitung sisa stok
        $sisagaji = $data['sisaakhir'];

        $query1 = "INSERT into jual_anggota values ('$id_jual_anggota', '$tgl_trak', '$total')";
        $query2 = "INSERT into detil_jual_anggota values ('', '$id_barang', '$id_jual_anggota', '$id_anggota', '$id_user', '$harga', '$jumlah', '$total', '2')";
        $query3 = "UPDATE barang SET stok = '$sisastok' where id_barang = '$id_barang' ";
        $query4 = "INSERT into gaji values('', '$id_anggota', '$id_jual_anggota', '$total', '$sisagaji', '$tgl_trak')";
        mysqli_query($koneksi, $query1);
        mysqli_query($koneksi, $query2);
        mysqli_query($koneksi, $query3);
        mysqli_query($koneksi, $query4);

        return mysqli_affected_rows($koneksi);        
    }
    
    function potonggaji_keranjang_anggota($data){
        global $koneksi;

        $id_jual_anggota = $data['id_jual_anggota'];
        $total_semua = $data['semua'];
        $tanggal = date("Y-m-d");
        $id_anggota = $data['id_anggota'];
        $sisagaji = $data['sisagaji'];

        $query1 = "INSERT into jual_anggota values ('$id_jual_anggota', '$tanggal', '$total_semua') ";
        $query2 = "UPDATE detil_jual_anggota SET status = '2', id_jual_anggota = '$id_jual_anggota' where id_jual_anggota = '0' and status = '0' and id_anggota = '$id_anggota' ";
        $query3 = "INSERT into gaji values ('', '$id_anggota', '$id_jual_anggota', '$total_semua', '$sisagaji', '$tanggal')";

        mysqli_query($koneksi, $query1);
        mysqli_query($koneksi, $query2);
        mysqli_query($koneksi, $query3);

        return mysqli_affected_rows($koneksi);
    }

?>