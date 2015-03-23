<?php 

    $jenisKontenTunggal = isset($_GET['jenis_konten']) ? $_GET['jenis_konten'] : "" ;  

            $judulBox = "Sunting Halaman Photo";
            $notifikasi['jenis_konten'] = "Photo";
            $valueButton = "sunting";

        //status notifikasi
        $jenisAlert = isset($_GET['ho']) && $_GET['ho'] == 1 ? "alert-success" : "alert-danger" ;        
        $ho = isset($_GET['ho']) ? $_GET['ho'] : "" ;
        switch($ho){
            case "1":$stringNotifikasi = "berhasil diperbaharui";break;
            case "0":$stringNotifikasi = "gagal diperbaharui, hubungi jogjasite untuk tindak lebih lanjut";break;
            case "kosong":$stringNotifikasi = "gagal diperbaharui, anda belum melengkapi form dengan benar, silahkan ulangi sekali lagi";break;
        }

        
        $buttonString = "Simpan Perubahan Halaman";
        $photo = Photo::ambilSemuaPhoto();
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
                    <h1>Halaman Tunggal atau lebih tepatnya album foto <br>                        
                        <small>Anda dapat mengelompokkan foto anda berdasarkan album, setiap albumnya memiliki foto dan keterangan, begitu juga untuk setiap foto yang ada di dalam album. Untuk mengisi website anda dengan foto, buat terlebih dahulu album, lalu isi album tersebut dengan foto.</small>
                    </h1>
                </div>
                <div class="row">
                                <div class="box-content">
                                <a style="float:right;display:block;margin-right:10px;" class="btn btn-primary btn-lg btn-buat-photo"><i class="glyphicon glyphicon-chevron-left glyphicon-white"></i> Buat Album</a>
                                    <!-- modal pop up konfirmasi penghapusan file -->
                                    <div class="modal fade" id="myModal-buat-photo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h3>Upload Foto untuk Album</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" method="post" action="modul/modul_halaman_tunggal/proses_photo.php" enctype="multipart/form-data">
                                                        <input type="hidden" name="jenis_konten" value="photo">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Upload Foto</label>
                                                                    <input name="gambar" type="file">
                                                                    <small>Upload foto untuk memberi warna web anda, ukuran file tidak melebihi 25 MB dan dimensinya tidak melebihi 1000 pixel:)</small>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="jenis_konten" value="contact" type="hidden"/>
                                                                    <label for="exampleInputEmail1">Judul album</label>
                                                                    <input name="keterangan" type="text" class="form-control" id="exampleInputEmail1" placeholder="isi dengan judul album">
                                                                </div>                                                            
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="#" class="btn btn-default" data-dismiss="modal">Batal</a>
                                                        <button type="submit" name="photo" value="input" class="btn btn-primary">Submit</button>                                                        
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal pop up konfirmasi penghapusan file -->   
                                        <script type="text/javascript">
                                            $('.btn-buat-photo').click(function (e) {
                                                e.preventDefault();
                                                $('#myModal-buat-photo').modal('show');
                                            });
                                        </script>                                    
                                <?php if($photo['jumlahData'] <= 0): ?>
                                    <center><h3>Untuk saat ini anda belum memiliki album</h3></center>
                                <?php else: ?>
                                    <table class="table table-striped">
                                          <thead>
                                            <tr>
                                                <th>Foto</th>
                                                <th>Keterangan</th>                                                
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($photo['hasilData'] as $baris): ?>
                                                <tr>
                                                    <td><center><img src="../joimg/halaman_tunggal/photo/kecil-<?php echo $baris->gambar; ?>"></center></td>
                                                    <td class="center"><?php echo $baris->keterangan; ?></td>                                                    
                                                    <td class="center">
                                                         <div class="btn-group">
                                                            <button class="btn btn-default btn-lg">Aksi</button>
                                                            <button class="btn dropdown-toggle btn-default btn-lg" data-toggle="dropdown"><span class="caret"></span></button>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="index.php?modul=halamanTunggal&aksi_modul=suntingHalamanTunggal&jenis_konten=buat_anak_photo&id_album=<?php echo $baris->id; ?>"><i class="glyphicon glyphicon-picture"></i> Lihat isi album</a></li>
                                                                <li><a class="btn-sunting-<?php echo $baris->id; ?>" href="#" ><i class="glyphicon glyphicon-edit"></i> Sunting</a></li>
                                                                <li><a class="btn-hapus-<?php echo $baris->id; ?>" href="#"><i class="glyphicon glyphicon-trash"></i> Hapus</a></li>                                                                                                                                
                                                            </ul>
                                                                <!-- modal pop up konfirmasi sunting file -->
                                                                <div class="modal fade" id="myModal-sunting-<?php echo $baris->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                                                                    <h3>Sunting Album</h3>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                        <form role="form" method="post" action="modul/modul_halaman_tunggal/proses_photo.php" enctype="multipart/form-data">
                                                                                        <input type="hidden" name="id" value="<?php echo $baris->id; ?>"/>
                                                                                        <input type="hidden" name="gambar" value="<?php echo $baris->gambar; ?>"/>
                                                                                                <div class="form-group">
                                                                                                    <center><img style="width:30%;" src="../joimg/halaman_tunggal/photo/kecil-<?php echo $baris->gambar; ?>"></center>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <input name="id" value="<?php echo $baris->id; ?>" type="hidden"/>
                                                                                                    <input name="jenis_konten" value="contact" type="hidden"/>                                                                                                    

                                                                                                <div class="form-group">
                                                                                                    <label for="exampleInputEmail1">Ganti Foto</label>
                                                                                                    <input name="gambar_baru" type="file">
                                                                                                    <small>Jika anda ingin mengganti foto untuk visualisasi album anda cukup upload foto baru melalui tombol di atas, ukuran file tidak melebihi 25 MB dan dimensinya tidak melebihi 1000 pixel:)</small>
                                                                                                </div>

                                                                                                    <label for="exampleInputEmail1">Keterangan Gambar</label>
                                                                                                    <input name="keterangan" value="<?php echo $baris->keterangan; ?>" type="text" class="form-control" id="exampleInputEmail1" placeholder="isi dengan nama kontak">
                                                                                                </div>                                                                                  
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <a href="#" class="btn btn-default" data-dismiss="modal">Batal</a>
                                                                                        <button type="submit" name="photo" value="sunting" class="btn btn-primary">Submit</button>                                                        
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
                                                                                    <p>Anda yakin akan menghapus album "<?php echo $baris->keterangan; ?>" ?  , semua foto yang ada dalam album "<?php echo $baris->keterangan; ?>" akan terhapus.
                                                                                    </p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <a href="#" class="btn btn-default" data-dismiss="modal">Batal</a>
                                                                                    <a href="modul/modul_halaman_tunggal/proses_photo.php?&photo=hapus&id=<?php echo $baris->id; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-trash"></i> &nbsp; Hapus Foto</a>
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