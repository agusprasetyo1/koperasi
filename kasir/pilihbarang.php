<?php
    include "fungsitransaksi.php";
    $id = $_GET['id'];
    $cari = query("SELECT * FROM anggota WHERE id_anggota = '$id' ")[0]; //Mengambil inputan dari parameter dan ditampilkan dengan select

    $judul = "Koperasi Bahagia";
    $lokasi1 = "Pembelian";
    $lokasi2 = "Pembelian Anggota";
    $lokasi3 = $cari['nama'];
    $linklokasi2 = "pembeliananggota.php";
    $linklokasi3 = "";
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";
    $kode = kodejualanggota();
    $barang = query("SELECT * from barang order by id_barang");
    if (isset($_POST['cari'])) {
        $barang = cariumum($_POST['inputcari']);
    }

    $q = mysqli_query($koneksi, "SELECT count(id_barang) as jumlah from detil_jual_anggota  where status = '0' and id_anggota = '$cari[id_anggota]' ");
    $data = mysqli_fetch_assoc($q);
    $jmlkeranjang = $data['jumlah'];   
    
    $id_anggota = $cari['id_anggota'];
    ?>

    <div class="container-fluid">
        <h2 align="center" class="pt-3 pb-3">Pilih Barang</h2>
        <div class="row">
            <div class="col-md-12">
                <div style="float:right;">
                    <form action="" method="post" class="input-group btn-group form-inline  mb-2">
                        <input type="text" size="25" name="inputcari" id="inputcari" class="form-control" placeholder="Masukan Nama Barang" required>
                        <input type="submit" class="btn btn-success" style="font-size:15px;padding:0px 30px;" name="cari" id="cari" value="Cari">
                    </form>
                </div>

                <div>
                    <font style="font-size:15px;color:#696969"> Keranjang
                        <b>
                            <?=$jmlkeranjang?>
                        </b> Barang
                    </font>
                    <a href="#" ambil-anggota="<?=$cari['id_anggota']?>" class="card-link edit-keranjang btn btn-info">
                        <i class="fa fa-cart-plus"></i>
                    </a>

                </div>
            </div>
        </div>
        <div class="row">
            <?php
            foreach ($barang as $data) {
        ?>

                <a href="#" data-id="<?=$data['id_barang']?>" ambil-anggota="<?=$cari['id_anggota']?>" class="card-link edit-record">
                    <div class="col-sm-4 col-lg-3 ">
                        <div class="brand-card beliumum">
                            <div class="card-body pb-3 mt-3">
                                <div class="brand-card-header">
                                    <img src="../img/barang/<?=$data['gambar']?>" width="130" height="150" alt="<?=$data['nama_barang']?>">
                                </div>
                            </div>
                            <div class="brand-card-body">
                                <div>
                                    <div style="font-size:15px;">
                                        <?=$data['nama_barang']?>
                                    </div>
                                    <div style="font-size:13px;color:#c20808;">Rp
                                        <?= number_format($data['harga_jual'],0,",",".")?>
                                    </div>
                                </div>
                            </div>
                        </div>
                </a>
                </div>
                <!-- Modal BARANG -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Pilih Aksi</h4>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                            </div>
                            <div class="modal-body mt-1">
                            </div>
                            <div class="modal-footer">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->
                <?php } ?>
        </div>
    </div>
    <!-- Modal KERANJANG -->
    <div class="modal fade" id="modalKeranjang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Pembayaran Keranjang</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                <div class="modal-body mt-1 mb-0">
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    <?php
    $q1 = mysqli_query($koneksi, "SELECT * from detil_jual_anggota d inner join barang b on d.id_barang = b.id_barang where status = '0'");

        if (isset($_POST['bayarlangsung'])) {
            $i = 0;
        
            while ($i < $jmlkeranjang) {
                $id_anggota = $_POST['id_anggota'][$i];
                $id_barang = $_POST['id_barang'][$i];
                $jumlah_beli = $_POST['stok_beli'][$i];
                $harga = $_POST['harga'][$i];
                $total = $jumlah_beli * $harga;
                $update = "UPDATE detil_jual_anggota set jumlah = '$jumlah_beli', sub_total = '$total' 
                where id_jual_anggota = '0' and status = '0' and id_anggota = '$id_anggota' and id_barang = '$id_barang' "; 
                mysqli_query($koneksi, $update);
                echo "
                    <script>
                        window.location = 'keranjang_bayaranggota.php?id_ang=$id_anggota';
                    </script>
                ";
                $i++;
            }
        }else if(isset($_POST['potonggaji'])){
            $i = 0;
        
            while ($i < $jmlkeranjang) {
                $id_anggota = $_POST['id_anggota'][$i];
                $id_barang = $_POST['id_barang'][$i];
                $jumlah_beli = $_POST['stok_beli'][$i];
                $harga = $_POST['harga'][$i];
                $total = $jumlah_beli * $harga;
                $update = "UPDATE detil_jual_anggota set jumlah = '$jumlah_beli', sub_total = '$total' 
                where id_jual_anggota = '0' and status = '0' and id_anggota = '$id_anggota' and id_barang = '$id_barang' "; 
                mysqli_query($koneksi, $update);
                echo "
                    <script>
                        window.location = 'keranjang_bayarpotong.php?id_ang=$id_anggota';
                    </script>
                ";
                $i++;
            }
            echo "
            <script>
                alert('Potong Gaji');
            </script>
            ";
        }
    ?>

    <?php
        if (isset($_POST['msk_keranjang'])) { //KETIKA DI TEKAN TOMBOL PADA MODAL
            $cek_idbrg = $_POST['id_barang'];
            $q = mysqli_query($koneksi, "SELECT id_barang, status from detil_jual_anggota where status = '0' and id_barang = '$cek_idbrg' and id_anggota = '$id_anggota' ");
            $cek = mysqli_num_rows($q);
    
            if ($cek > 0) {
                echo "
                <script>
                    alert('Data sudah masuk keranjang');
                    window.location = 'pilihbarang.php?id=$id_anggota';
                </script>
                ";
            }else{
            if (tambah_keranjang_anggota($_POST) > 0) { //TAMBAH KERANJANG
                echo "
                    <script>
                        alert('Input keranjang sukses');
                        window.location = 'pilihbarang.php?id=$id_anggota';
                    </script>
                ";
            }else{
                echo "
                <script>
                alert('Input keranjang gagal');
                // document.location.href = 'tambahanggota.php';            
                </script>
                ";
            echo mysqli_error($koneksi);        
            echo("<br>");
            }
        }
        }
        ?>
            <?php
    include "template/footer.php";
?>
                <script>
                    // Keranjang
                    $(function () {
                        $(document).on('click', '.edit-keranjang', function (e) {
                            e.preventDefault();
                            $("#modalKeranjang").modal('show');
                            $.post('proseskeranjanganggota.php', {
                                    ambilanggota: $(this).attr('ambil-anggota')
                                },
                                function (html) {
                                    $(".modal-body").html(html);
                                }
                            );
                        });
                    });
                </script>
                <script>
                    //Barang
                    $(function () {
                        $(document).on('click', '.edit-record', function (e) {
                            e.preventDefault();
                            $("#myModal").modal('show');
                            $.post('prosesanggota.php', {
                                    id: $(this).attr('data-id'),
                                    ambilanggota: $(this).attr('ambil-anggota')
                                },
                                function (html) {
                                    $(".modal-body").html(html);
                                }
                            );
                        });
                    });
                </script>