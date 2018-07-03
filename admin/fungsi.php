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
        $gaji_pokok = $data['gaji_pokok'];
        
        $query = "INSERT INTO unit_kerja VALUES ('$id', '$unitkerja', '$gaji_pokok')";
        $data = mysqli_query($koneksi, $query);
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
        $gaji_pokok = $data['gaji_pokok'];
        
        $query = "UPDATE unit_kerja SET
            unit_kerja = '$unitkerja',
            gaji_pokok = '$gaji_pokok'
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

    //Tambah barang
    function tambahbarang($data){
        global $koneksi;

        $id_barang = htmlspecialchars($data['id_barang']);
        $id_jenis = htmlspecialchars($data['jenis']);
        $nama = htmlspecialchars($data['nama']);
        $harga_beli = $data['hargabeli'];
        $harga_jual = $data['hargajual'];
        $stok = $data['stok'];
        $keterangan = htmlspecialchars($data['keterangan']);
        // $gambar = htmlspecialchars($data['gambar']);
        $gambar = uploadbarang();
        if (!$gambar) {
            return false;
        }


        $query = "INSERT INTO barang VALUES ('$id_barang', '$id_jenis', '$nama', '$harga_beli', '$harga_jual', '$stok', '$keterangan', '$gambar')";
        $data = mysqli_query($koneksi, $query);
        // var_dump($data);
        return mysqli_affected_rows($koneksi);
    }

    //Edit barang
    function editbarang($data){
        global $koneksi;

        $id_barang = $data['id_barang'];
        $id_jenis = htmlspecialchars($data['jenis']);
        $nama = htmlspecialchars($data['nama']);
        $harga_beli = $data['hargabeli'];
        $harga_jual = $data['hargajual'];
        $stok = $data['stok'];
        $keterangan = htmlspecialchars($data['keterangan']);
        $gambarlama = htmlspecialchars($data['gambarlama']);
        
        if ($_FILES['gambar']['error'] === 4) {
            $gambar = $gambarlama;
        } else {
            $gambar = uploadbarang();
        }
        

        $query = "UPDATE barang SET
            id_jenis_barang = '$id_jenis',
            nama_barang = '$nama',
            harga_beli = '$harga_beli',
            harga_jual = '$harga_jual',
            stok = '$stok', 
            keterangan_stok = '$keterangan', 
            gambar = '$gambar' 
            WHERE id_barang = '$id_barang' ";

        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //Hapus data barang
    function hapusbarang($id){
        global $koneksi;

        $query = "DELETE from barang where id_barang = '$id' ";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //cari data barang
    function caribarang($cari){
        $query = "SELECT * FROM barang b inner join jenis_barang j on b.id_jenis_barang = j.id_jenis_barang WHERE
                nama_barang like '%$cari%' ";
        
        return query($query);
    }

    //Upload file gambar barang
    function uploadbarang(){
        $nama_file = $_FILES['gambar']['name'];
        $ukuran_file = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $file_tmp = $_FILES['gambar']['tmp_name'];

        if ($error === 4) { 
            echo "
            <script>
                alert('Tidak ada gambar yang diupload');
            </script>
            ";
            return false;
        }

        $jenis_gambar = ['jpg', 'jpeg', 'png', 'gif','JPG']; //jenis gambar yang boleh diinputkan
        $pecah_gambar = explode(".", $nama_file); //Memecah nama file dengan jenis gambar
        $pecah_gambar = strtolower(end($pecah_gambar)); //mengambil data array paling belakang
        if (!in_array($pecah_gambar, $jenis_gambar)) {
            echo "
                <script>
                    alert('Yang anda upload bukan file gambar');
                </script>
            ";
            return false;
        }
        //cek kapasitas file yang diupload dala bentuk byte 1 MB = 1000000 Byte
        if ($ukuran_file > 10000000) {
            echo"
                <script>
                    alert('Ukuran file terlalu besar');
                </script>
            ";
            return false;
        }

        $namafilebaru = uniqid();
        $namafilebaru .= ".";
        $namafilebaru .= $pecah_gambar;

        move_uploaded_file($file_tmp, '../img/barang/'.$namafilebaru);

        //mereturn nama file agar masuk ke $gambar == upload()
        return $namafilebaru;
    }

     //Kode Anggota
     function kodeanggota(){
        global $koneksi;

        $query = mysqli_query($koneksi, "select max(id_anggota) as maxkode from anggota ");
        $data = mysqli_fetch_array($query);
        $kodebarang = $data['maxkode'];
        $nourut = (int)substr($kodebarang,3, 3);
        $nourut++;
        $char = "AG";
        $kodebarang = $char.sprintf("%03s", $nourut);
        return $kodebarang;
    }

    //Tambah barang
    function tambahanggota($data){
        global $koneksi;

        $id_anggota = htmlspecialchars($data['id_anggota']);
        $nama = htmlspecialchars($data['nama']);
        $unit = $data['unit'];
        $npp = htmlspecialchars($data['npp']);
        $tempat = htmlspecialchars($data['tempat']);
        $tanggal = $data['tgl_lahir'];
        $jk = $data['jeniskelamin'];
        $alamat = htmlspecialchars($data['alamat']);
        $jadianggota = $data['jadianggota'];
        
        $gambar = uploadanggota();
        if (!$gambar) {
            return false;
        }


        $query = "INSERT INTO anggota VALUES ('$id_anggota', '$unit', '$npp', '$nama', '$tempat', '$tanggal', '$jk', '$alamat', '$jadianggota', '$gambar')";
        $data = mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //Edit Anggota
    function editanggota($data){
        global $koneksi;

        $id_anggota = $data['id_anggota'];
        $nama = htmlspecialchars($data['nama']);
        $unit = $data['unit'];
        $npp = htmlspecialchars($data['npp']);
        $tempat = htmlspecialchars($data['tempat']);
        $tanggal = $data['tgl_lahir'];
        $jk = $data['jeniskelamin'];
        $alamat = htmlspecialchars($data['alamat']);
        $gambarlama = htmlspecialchars($data['gambarlama']);
        
        if ($_FILES['gambar']['error'] === 4) {
            $gambar = $gambarlama;
        } else {
            $gambar = uploadanggota();
        }
        

        $query = "UPDATE anggota SET
            id_unit_kerja = '$unit',
            npp = '$npp',
            nama = '$nama',
            tempat = '$tempat',
            tgl_lahir = '$tanggal', 
            jenis_kelamin = '$jk', 
            alamat = '$alamat', 
            gambar = '$gambar' 
            WHERE id_anggota = '$id_anggota' ";

        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //Hapus data barang
    function hapusanggota($id){
        global $koneksi;

        $query = "DELETE from anggota where id_anggota = '$id' ";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //cari data barang
    function carianggota($cari){
        $query = "SELECT * FROM anggota a inner join unit_kerja u on a.id_unit_kerja = u.id_unit_kerja WHERE
                nama like '%$cari%' ";
        
        return query($query);
    }

    //Upload file gambar anggota
    function uploadanggota(){
        $nama_file = $_FILES['gambar']['name'];
        $ukuran_file = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $file_tmp = $_FILES['gambar']['tmp_name'];

        if ($error === 4) { 
            echo "
            <script>
                alert('Tidak ada gambar yang diupload');
            </script>
            ";
            return false;
    }

        $jenis_gambar = ['jpg', 'jpeg', 'png', 'gif']; //jenis gambar yang boleh diinputkan
        $pecah_gambar = explode(".", $nama_file); //Memecah nama file dengan jenis gambar
        $pecah_gambar = strtolower(end($pecah_gambar)); //mengambil data array paling belakang
        if (!in_array($pecah_gambar, $jenis_gambar)) {
            echo "
                <script>
                    alert('Yang anda upload bukan file gambar');
                </script>
            ";
            return false;
        }
        //cek kapasitas file yang diupload dala bentuk byte 1 MB = 1000000 Byte
        if ($ukuran_file > 10000000) {
            echo"
                <script>
                    alert('Ukuran file terlalu besar');
                </script>
            ";
            return false;
        }

        $namafilebaru = uniqid();
        $namafilebaru .= ".";
        $namafilebaru .= $pecah_gambar;

        move_uploaded_file($file_tmp, '../img/anggota/'.$namafilebaru);

        //mereturn nama file agar masuk ke $gambar == upload()
        return $namafilebaru;
    }

    //Kode Anggota
    function kodeuser(){
        global $koneksi;

        $query = mysqli_query($koneksi, "select max(id_user) as maxkode from user ");
        $data = mysqli_fetch_array($query);
        $kodeuser = $data['maxkode'];
        $nourut = (int)substr($kodeuser,3, 3);
        $nourut++;
        $char = "US";
        $kodeuser = $char.sprintf("%03s", $nourut);
        return $kodeuser;
    }

    //Hapus user
    function hapususer($id){
        global $koneksi;

        $query = "DELETE from user where id_user = '$id' ";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //cari data barang
    function cariuser($cari){
        $query = "SELECT * FROM user where nama like '%$cari%' ";
        
        return query($query);
    }

    function registrasi($data){
        global $koneksi;
        
        $id = htmlspecialchars($data['id_user']);
        $nama = htmlspecialchars($data['nama']);
        $akses = $data['akses'];
        $username = strtolower(stripcslashes($data['username']));

        $password = mysqli_real_escape_string($koneksi, $data['password']);
        $password2 = mysqli_real_escape_string($koneksi, $data['password2']);
        
        //mengecek username
        $query = mysqli_query($koneksi, "SELECT username FROM user WHERE username='$username' ");
    
        if (mysqli_fetch_assoc($query)) {
            echo "
                <script>
                    alert('Username sudah ada');
                    window.location = 'registrasi.php';
                </script>
                    ";
                    return false;
        }
        //cek informasi password
        if ($password !== $password2) {
                    echo "
                    <script>
                        alert('Harap memasukan password dengan benar');
                        // window.location = 'registrasi.php';
                    </script>
            ";
            die();
            return false;
        }

        //enkripsi password
        $password = password_hash($password,PASSWORD_DEFAULT);

        //tambah data
        mysqli_query($koneksi, "INSERT INTO user VALUES ('$id', '$nama', '$username', '$password','$akses')");   

        return mysqli_affected_rows($koneksi);
    }

    function tambahstok($data){
        global $koneksi;
        $id_brng = $data['id_barang'];
        $stokawal = $data['stokawal'];
        $jumlah_tambah = $data['jumlah'];
        $total = $stokawal + $jumlah_tambah;

        $query = "UPDATE barang SET stok = '$total' WHERE id_barang = '$id_brng' ";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }
?>