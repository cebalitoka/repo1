<?php 

    $jenisKontenTunggal = isset($_GET['jenis_konten']) ? $_GET['jenis_konten'] : "" ;  
    $idAlbum = isset($_GET['id_album']) ? $_GET['id_album'] : "" ;        
    $infoAlbum = Photo::ambilPhotoById($idAlbum);

            $judulBox = "Upload foto untuk album ".$infoAlbum->keterangan;
            $notifikasi['jenis_konten'] = "Foto";
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
        $photoDariAlbum = Anak_gallery::ambilAnakGalleryByIdParent($idAlbum);
 ?>


        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Uupss!</h4>

                <p>Anda memerlukan <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    untuk menggunakan sistem ini.</p>
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
                        <small>Anda sekarang berada di halaman album foto "<?php echo $infoAlbum->keterangan; ?>". Isi album anda dengan foto yang menarik untuk mempercantik website anda, gunakan dengan gambar yang tidak melebihi dari 20MB dan ukuran dimensi gambar tidak melebih 1000 pixel.</small>
                    </h1>
                </div>
                <div class="row">
                                <div class="box-content">
                                <a style="float:right;display:block;margin-right:10px;" class="btn btn-primary btn-lg btn-buat-photo"><i class="glyphicon glyphicon-chevron-left glyphicon-white"></i> Upload Foto ke Album</a>
                                    <!-- modal pop up konfirmasi penghapusan file -->
                                    <div class="modal fade" id="myModal-buat-photo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h3>Upload Foto untuk Album "<?php echo $infoAlbum->keterangan; ?>"</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" method="post" action="modul/modul_halaman_tunggal/proses_anak_gallery.php" enctype="multipart/form-data">
                                                        <input type="hidden" name="jenis_konten" value="photo">
                                                        <input type="hidden" name="id_album" value="<?php echo $idAlbum; ?>"/>
                                                        <input type="hidden" name="nama_album" value="<?php echo $infoAlbum->keterangan; ?>"/>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Upload Foto</label>
                                                                    <input name="gambar" type="file">
                                                                    <small>Upload foto untuk memberi warna web anda, ukuran file tidak melebihi 20 MB dan dimensinya tidak melebihi 1000 pixel:)</small>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="jenis_konten" value="contact" type="hidden"/>
                                                                    <label for="exampleInputEmail1">Keterangan Foto</label>
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
                                <?php if($photoDariAlbum['jumlahData'] <= 0): ?>
                                    <center><h3>Untuk saat ini anda belum memiliki foto dalam album "<?php echo $infoAlbum->keterangan; ?>"</h3></center>
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
                                            <?php foreach($photoDariAlbum['hasilData'] as $baris): ?>
                                                <tr>
                                                    <td><center><img src="../joimg/halaman_tunggal/photo/kecil-<?php echo $baris->gambar; ?>"></center></td>
                                                    <td class="center"><?php echo $baris->keterangan; ?></td>                                                    
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
                                                                                    <h3>Sunting Foto</h3>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                        <form role="form" method="post" action="modul/modul_halaman_tunggal/proses_anak_gallery.php" enctype="multipart/form-data">
                                                                                        <input type="hidden" name="id" value="<?php echo $idAlbum; ?>"/>
                                                                                        <input type="hidden" name="id_album" value="<?php echo $baris->id_album; ?>"/>
                                                                                        <input type="hidden" name="gambar" value="<?php echo $baris->gambar; ?>"/>
                                                                                                <div class="form-group">
                                                                                                    <center><img style="width:30%;" src="../joimg/halaman_tunggal/photo/kecil-<?php echo $baris->gambar; ?>"></center>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <input name="id" value="<?php echo $baris->id; ?>" type="hidden"/>
                                                                                                    <input name="jenis_konten" value="contact" type="hidden"/>                                                                                                    

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
                                                                                    <p>Anda yakin akan menghapus foto ? 
                                                                                    </p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <a href="#" class="btn btn-default" data-dismiss="modal">Batal</a>
                                                                                    <a href="modul/modul_halaman_tunggal/proses_anak_gallery.php?&anak_gallery=hapus&id=<?php echo $baris->id; ?>&id_album=<?php echo $idAlbum; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-trash"></i> &nbsp; Hapus Foto</a>
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