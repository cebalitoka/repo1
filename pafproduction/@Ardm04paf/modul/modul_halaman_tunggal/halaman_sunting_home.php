<?php 

    $jenisKontenTunggal = isset($_GET['jenis_konten']) ? $_GET['jenis_konten'] : "" ;  

            $judulBox = "Sunting Halaman Home";
            $notifikasi['jenis_konten'] = "Home";
            $valueButton = "sunting";

        //status notifikasi
        $jenisAlert = isset($_GET['ho']) && $_GET['ho'] == 1 ? "alert-success" : "alert-danger" ;
        $ho = isset($_GET['ho']) ? $_GET['ho'] : "" ;

        switch($ho){
            case "1":$stringNotifikasi = "berhasil diperbaharui";break;
            case "0":$stringNotifikasi = "gagal diperbaharui, hubungi jogjasite untuk tindak lebih lanjut";break;
            case "kosong":$stringNotifikasi = "Anda belum melengkapi form, silahkan ulangi lagi";break;
        }        

        
        $buttonString = "Simpan Perubahan Halaman";
        $iconHome = Icon_Home::ambilSemuaIconHome();
 ?>

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
<?php require_once("joinc/breadcumb.php"); ?>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> <?php echo $judulBox; ?></h2>
            </div>
            <div class="box-content row">
                <div class="col-lg-12 col-md-12">

                <?php if(isset($_GET['ho'])): ?>
                    <div class="alert <?php echo $jenisAlert; ?>">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            Halaman <?php echo "<b>".$notifikasi['jenis_konten']."</b> ".$stringNotifikasi; ?>     
                    </div>
                <?php endif; ?>

                <div class="page-header">
                    <h1>Halaman Tunggal <br>
                        <small>Halaman tunggal merupakan halaman utama yang dapat diakses pada menu utama di website anda, biasanya berisi tentang profil, info kontak dan informasi penting lainnya yang ditempatkan pada satu halaman.</small>
                    </h1>
                </div>
                <div class="row">
                                <div class="box-content">
                                <a style="float:right;display:block;margin-right:10px;" class="btn btn-primary btn-lg btn-buat-icon-home"><i class="glyphicon glyphicon-chevron-left glyphicon-white"></i> Tambah Icon Home</a>
                                    <!-- modal pop up konfirmasi penghapusan file -->
                                    <div class="modal fade" id="myModal-buat-icon-home" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h3>Buat Icon Home</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" method="post" action="modul/modul_halaman_tunggal/proses_icon_home.php" enctype="multipart/form-data">
                                                        <input name="jenis_konten" value="icon_home" type="hidden" />
                                                                <div class="form-group">
                                                                    <input name="jenis_konten" value="contact" type="hidden"/>
                                                                    <label for="exampleInputEmail1">Nama Icon</label>
                                                                    <input name="nama_icon" type="text" class="form-control" id="exampleInputEmail1" placeholder="isi dengan nama kontak">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Icon Contact</label>
                                                                    <input name="gambar" type="file">
                                                                    <small>gunakan gambar dengan ukuran dimensi gambar maksimal 100 pixel untuk menghasilkan tampilan yang sesuai dengan layout website:)</small>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">File</label>
                                                                    <input name="file_upload" type="file">
                                                                    <small>Disarankan untuk tidak mengupload file dengan ukuran lebih dari 100 MB, agar sistem pada server tidak terganaggu</small>
                                                                </div>
                                                            
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="#" class="btn btn-default" data-dismiss="modal">Batal</a>
                                                        <button type="submit" name="icon_home" value="input" class="btn btn-primary">Submit</button>                                                        
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal pop up konfirmasi penghapusan file -->   
                                        <script type="text/javascript">
                                            $('.btn-buat-icon-home').click(function (e) {
                                                e.preventDefault();
                                                $('#myModal-buat-icon-home').modal('show');
                                            });
                                        </script>                                    
                                <?php if($iconHome['jumlahData'] <= 0): ?>
                                    <center><h3>Untuk saat ini tidak ada icon untuk halaman home</h3></center>
                                <?php else: ?>
                                    <table class="table table-striped">
                                          <thead>
                                            <tr>
                                                <th>Icon Home</th>
                                                <th>Nama Icon</th>
                                                <th>Nama File</th>
                                                <th>Ekstensi File</th>                                                
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($iconHome['hasilData'] as $baris): ?>
                                                <tr>
                                                    <td><img src="../joimg/halaman_tunggal/icon_home/<?php echo $baris->gambar; ?>"></td>
                                                    <td class="center"><?php echo $baris->nama_icon; ?></td>
                                                    <td class="center"><?php echo $baris->nama_file; ?>&nbsp;&nbsp;<a class="btn btn-success" href="../jofile/icon_home/<?php echo $baris->link_file; ?>"><i class="glyphicon glyphicon-download"></i></a></td>
                                                    <td class="center"><?php $ekstensi = explode(".",$baris->nama_file);echo $ekstensi[1]; ?></td>                                                    
                                                    <td class="center">
                                                         <div class="btn-group">
                                                            <button class="btn btn-default btn-lg">Aksi</button>
                                                            <button class="btn dropdown-toggle btn-default btn-lg" data-toggle="dropdown"><span class="caret"></span></button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="btn-sunting-<?php echo $baris->id; ?>" href="#" ><i class="glyphicon glyphicon-edit"></i> Sunting</a></li>
                                                                <li><a class="btn-hapus-<?php echo $baris->id; ?>" href="#"><i class="glyphicon glyphicon-trash"></i> Hapus</a></li>                                                                                                                                
                                                            </ul>
                                                                <!-- modal pop up konfirmasi sunting file -->
                                                                <div class="modal fade" id="myModal-sunting-<?php echo $baris->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                                                                    <h3>Sunting Icon Home</h3>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                        <form role="form" method="post" action="modul/modul_halaman_tunggal/proses_icon_home.php" enctype="multipart/form-data">                                                                                        
                                                                                        <input name="ukuran_file" value="<?php echo $baris->ukuran_file; ?>" type="hidden"/>
                                                                                        <input name="jenis_file" value="<?php echo $baris->jenis_file; ?>" type="hidden"/>
                                                                                        <input name="link_file" value="<?php echo $baris->link_file; ?>" type="hidden"/>
                                                                                        <input name="nama_file" value="<?php echo $baris->nama_file; ?>" type="hidden"/>
                                                                                        <input name="gambar" value="<?php echo $baris->gambar; ?>" type="hidden"/>
                                                                                        <input name="id" value="<?php echo $baris->id; ?>" type="hidden"/>

                                                                                        <div class="form-group">
                                                                                            <input name="jenis_konten" value="contact" type="hidden"/>
                                                                                            <label for="exampleInputEmail1">Nama Icon</label>
                                                                                            <input name="nama_icon" value="<?php echo $baris->nama_icon; ?>" type="text" class="form-control" id="exampleInputEmail1" placeholder="isi dengan nama kontak">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputEmail1">Icon Home terupload</label><br>
                                                                                            <center><img src="../joimg/halaman_tunggal/icon_home/<?php echo $baris->gambar; ?>"></center>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputEmail1">Icon Contact</label>
                                                                                            <input name="gambar" type="file">
                                                                                            <small>Untuk mengganti gambar, upload gambar yang baru menggunakan tombol diatas. Gunakan gambar dengan ukuran dimensi gambar maksimal 100 pixel untuk menghasilkan tampilan yang sesuai dengan layout website:)</small>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputEmail1">File terupload</label><br>
                                                                                            <center><p><?php echo $baris->nama_file; ?>&nbsp;&nbsp;&nbsp;<a class="btn btn-success" href="../jofile/icon_home/<?php echo $baris->link_file; ?>"><i class="glyphicon glyphicon-download"></i></a></p></center>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputEmail1">File</label>
                                                                                            <input name="file_upload" type="file">
                                                                                            <small>Untuk mengganti file, upload file yang baru menggunakan tombol diatas. Disarankan untuk tidak mengupload file dengan ukuran lebih dari 100 MB, agar sistem pada server tidak terganaggu</small>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <a href="#" class="btn btn-default" data-dismiss="modal">Batal</a>
                                                                                        <button type="submit" name="icon_home" value="sunting" class="btn btn-primary">Submit</button>                                                        
                                                                                        </form>
                                                                                </div>
                                                                                
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <!-- modal pop up konfirmasi sunting file -->
                                                            <script type="text/javascript">
                                                                $('.btn-sunting-<?php echo $baris->id; ?>').click(function (e) {
                                                                    e.preventDefault();
                                                                    $('#myModal-sunting-<?php echo $baris->id; ?>').modal('show');
                                                                });
                                                            </script>  
                                                                <!-- modal pop up konfirmasi penghapusan file -->
                                                                <div class="modal fade" id="myModal-hapus-<?php echo $baris->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                                                                    <h3>Konfirmasi</h3>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p>Anda yakin akan menghapus foto <b>"<?php echo $baris->nama_icon; ?>"</b> ? File yang bersangkutan juga akan terhapus.
                                                                                    </p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <a href="#" class="btn btn-default" data-dismiss="modal">Batal</a>
                                                                                    <a href="modul/modul_halaman_tunggal/proses_icon_home.php?&icon_home=hapus&id=<?php echo $baris->id; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-trash"></i> &nbsp; Hapus Icon</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <!-- modal pop up konfirmasi penghapusan file -->
                                                            <script type="text/javascript">
                                                                $('.btn-hapus-<?php echo $baris->id; ?>').click(function (e) {
                                                                    e.preventDefault();
                                                                    $('#myModal-hapus-<?php echo $baris->id; ?>').modal('show');
                                                                });
                                                            </script>

                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                    </table>
                                <?php endif; ?>
                                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->