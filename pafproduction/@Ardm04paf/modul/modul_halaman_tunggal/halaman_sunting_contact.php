<?php 

    $jenisKontenTunggal = isset($_GET['jenis_konten']) ? $_GET['jenis_konten'] : "" ;  

            $judulBox = "Sunting Halaman Contact";
            $notifikasi['jenis_konten'] = "Contact";
            $valueButton = "sunting";

        //status notifikasi
        $jenisAlert = isset($_GET['ho']) && $_GET['ho'] == 1 ? "alert-success" : "alert-danger" ;
        $stringNotifikasi = isset($_GET['ho']) && $_GET['ho'] == 1 ? "berhasil diperbaharui" : "gagal diperbaharui, hubungi jogjasite untuk tindak lebih lanjut" ; 

        
        $buttonString = "Simpan Perubahan Halaman";
        $sosMed = Sosial_Media::ambilSemuaSosialMedia();
        $nomorTelpon = Konten_Tunggal::ambilKontenByJenisKonten("nomortelpon");
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
                                <a style="float:right;display:block;margin-right:10px;margin-bottom:10px;" class="btn btn-primary btn-lg btn-buat-kontak"><i class="glyphicon glyphicon-chevron-left glyphicon-white"></i> Tambah Kontak</a>
                                <div class="form-group col-md-12 well">
                                    <form method="POST" action="modul/modul_halaman_tunggal/proses_halaman_tunggal.php">
                                        <input name="jenis_konten" value="contact" type="hidden">
                                        <input name="judul_konten" value="Nomor Telpon" type="hidden">
                                        <input name="gambar_sampul_konten" value="kosong" type="hidden">
                                        <input name="seo_deskripsi" value="kosong" type="hidden">
                                        <input name="seo_keywords" value="kosong" type="hidden">
                                        <input name="id_konten" value="<?php echo $nomorTelpon->id_konten; ?>" type="hidden">                                        
                                                    <label for="exampleInputEmail1">
                                                        <div class="alert alert-success">                   
                                                            <i class="glyphicon glyphicon-flag"></i><strong>Nomor Telpon</strong>
                                                        </div>
                                                    </label>
                                                      <input value="<?php echo $nomorTelpon->isi; ?>" name="isi" type="text" style="height:50px;" class="form-control" id="exampleInputEmail1" placeholder="Isi dengan nomor telpon">                                                     
                                                        <p class="help-block">Isi dengan nomor telpon untuk kontak bisnis anda, nomor telpon akan tertampil pada bagian kontak dibawah icon gambar telpon.</p>
                                                <button name="proses_telpon" value="sunting_telpon" type="submit">Simpan Nomor Telpon</button>
                                    </form>
                                </div>
                                    <!-- modal pop up konfirmasi penghapusan file -->
                                    <div class="modal fade" id="myModal-buat-kontak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h3>Buat Kontak</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" method="post" action="modul/modul_halaman_tunggal/proses_halaman_tunggal.php" enctype="multipart/form-data">
                                                                <div class="form-group">
                                                                    <input name="jenis_konten" value="contact" type="hidden"/>
                                                                    <label for="exampleInputEmail1">Nama Contact</label>
                                                                    <input name="nama_sosial_media" type="text" class="form-control" id="exampleInputEmail1" placeholder="isi dengan nama kontak">
                                                                </div>
                                                                <div class="form-group">
                                                                   <div class="checkbox">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input id="konfirmasi_kontak" name="jenis_form" value="dengan-link" type="checkbox">
                                                                                Link contact
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Link Sosial Media</label>
                                                                    <textarea id="link_kontak" class="form-control" name="link" class="auto-grow" disabled="disabled"></textarea>
                                                                    <!-- <input name="link" value="http://" type="text" class="form-control" id="link_kontak" placeholder="isi dengan link sosial media" disabled="disabled"> -->
                                                                </div>
                                                                <script type="text/javascript">
                                                                    document.getElementById('konfirmasi_kontak').onchange = function() {
                                                                      document.getElementById('link_kontak').disabled = !this.checked;
                                                                    };
                                                                </script>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Icon Contact</label>
                                                                    <input name="gambar_contact" type="file">
                                                                    <small>gunakan gambar dengan ukuran dimensi gambar maksimal 100 pixel untuk menghasilkan tampilan yang sesuai dengan layout website:)</small>
                                                                </div>
                                                            
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="#" class="btn btn-default" data-dismiss="modal">Batal</a>
                                                        <button type="submit" name="contact" value="input" class="btn btn-primary">Submit</button>                                                        
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal pop up konfirmasi penghapusan file -->   
                                        <script type="text/javascript">
                                            $('.btn-buat-kontak').click(function (e) {
                                                e.preventDefault();
                                                $('#myModal-buat-kontak').modal('show');
                                            });
                                        </script>                                    
                                <?php if($sosMed['jumlahData'] <= 0): ?>
                                    <center><h3>Untuk saat ini anda belum memiliki kontak</h3></center>
                                <?php else: ?>
                                    <table class="table table-striped">
                                          <thead>
                                            <tr>
                                                <th>Icon Contact</th>
                                                <th>Nama Contact</th>
                                                <th>Link Contact</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($sosMed['hasilData'] as $baris): ?>
                                                <tr>
                                                    <td><img src="../joimg/halaman_tunggal/contact/<?php echo $baris->gambar; ?>"></td>
                                                    <td class="center"><?php echo $baris->nama_sosial_media; ?></td>
                                                    <td class="center"><?php $link = $baris->link == "kosong" ? '<span class="label label-info">tidak memiliki link</span>' : $baris->link; echo $link; ?></td>
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
                                                                                    <h3>Konfirmasi</h3>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                        <form role="form" method="post" action="modul/modul_halaman_tunggal/proses_halaman_tunggal.php" enctype="multipart/form-data">
                                                                                                <div class="form-group">
                                                                                                    <input name="id" value="<?php echo $baris->id; ?>" type="hidden"/>
                                                                                                    <input name="jenis_konten" value="contact" type="hidden"/>
                                                                                                    <input name="gambar" value="<?php echo $baris->gambar; ?>" type="hidden"/>

                                                                                                    <label for="exampleInputEmail1">Nama Contact</label>
                                                                                                    <input name="nama_sosial_media" value="<?php echo $baris->nama_sosial_media; ?>" type="text" class="form-control" id="exampleInputEmail1" placeholder="isi dengan nama kontak">
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                   <div class="checkbox">
                                                                                                        <div class="checkbox">
                                                                                                            <?php $checkbox = $baris->jenis == "non-link" ? "" : "checked"; ?>
                                                                                                            <label>
                                                                                                                <input id="konfirmasi_kontak_sunting-<?php echo $baris->id ?>" name="jenis_form" value="dengan-link" type="checkbox" <?php echo $checkbox; ?>>
                                                                                                                Link contact
                                                                                                            </label><br>
                                                                                                            <small>Jika anda ingin menyertakan link, centang terlebih dahulu checkbox diatas. Bila anda tidak mencentang checkbox diatas, maka link akan tetap tidak terisi, sebaliknya jika anda ingin menonaktifkan link, hilangkan centang pada checkbox tersebut :)</small>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                <div class="form-group">
                                                                                                    <?php $linkSosMed = $baris->jenis == "non-link" ? "disabled=disabled" : "disabled=disabled" ; ?>
                                                                                                    <?php $stringLink = $baris->jenis == "non-link"? "" : $baris->link; ?>
                                                                                                    <label for="exampleInputEmail1">Link Sosial Media</label><br>
                                                                                                    <textarea id="link_kontak_sunting-<?php echo $baris->id ?>" class="form-control" name="link" class="auto-grow" disabled="disabled"><?php echo $stringLink; ?></textarea>                                                                                                    
                                                                                                    <small>Jangan lupa untuk menyertakan http:// pada awal link agar link dapat aktif sebagaimana mestinya menuju link yang anda tuju :)</small>
                                                                                                </div>
                                                                                                <script type="text/javascript">
                                                                                                    document.getElementById('konfirmasi_kontak_sunting-<?php echo $baris->id ?>').onchange = function() {
                                                                                                      document.getElementById('link_kontak_sunting-<?php echo $baris->id ?>').disabled = !this.checked;
                                                                                                    };
                                                                                                </script>
                                                                                                <div class="form-group">
                                                                                                    <label for="exampleInputEmail1">Icon Contact terupload</label><br>
                                                                                                    <center><img src="../joimg/halaman_tunggal/contact/<?php echo $baris->gambar; ?>"></center>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="exampleInputEmail1">Icon Contact</label>
                                                                                                    <input name="gambar_contact" type="file">
                                                                                                    <small>untuk mengganti gambar link cukup upload gambar baru pada tombol diatas dan gambar lama akan terganti dengan gambar baru :), gunakan gambar dengan ukuran dimensi gambar maksimal 100 pixel untuk menghasilkan tampilan yang sesuai dengan layout website:)</small>
                                                                                                </div>
                                                                                            
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <a href="#" class="btn btn-default" data-dismiss="modal">Batal</a>
                                                                                        <button type="submit" name="contact" value="sunting" class="btn btn-primary">Submit</button>                                                        
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
                                                                                    <p>Anda yakin akan menghapus contact <b>"<?php echo $baris->nama_sosial_media; ?>"</b> ? 
                                                                                    </p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <a href="#" class="btn btn-default" data-dismiss="modal">Batal</a>
                                                                                    <a href="modul/modul_halaman_tunggal/proses_halaman_tunggal.php?&contact=hapus&id=<?php echo $baris->id; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-trash"></i> &nbsp; Hapus Contact</a>
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