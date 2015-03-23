<?php 
    $halamanSekarang = isset($_GET['hal']) ? $_GET['hal'] : 1 ;
    $paginator = Zebra_Pagination_Proses::zebra_pagination("konten_ganda","WHERE jenis_konten = 'artikel'",5,$halamanSekarang);

    
    $blog = Konten_Ganda::ambilSemuaKontenByJenisPaging("artikel", $paginator->dataPerHalaman, $paginator->offset);
    $hop = isset($_GET['hop']) ? $_GET['hop'] : NULL ;
    $ho = isset($_GET['ho']) ? $_GET['ho'] : NULL ;
    $string ="";
    switch($hop){
        case 'buatArtikel': 
            if($ho == 1){$string="Event baru anda sudah tersimpan.";$jenisAlert="alert-success";}
            elseif($ho == 0){$string="Event anda gagal tersimpan, hubungi jogjasite untuk tindak lebih lanjut.";$jenisAlert="alert-danger";}
            elseif($ho == "kosong"){$string="Sepertinya anda belum mengisi semua form, ulangi lagi ya.";$jenisAlert="alert-danger";}
            break;
        case 'suntingArtikel': 
            if($ho == 1){$string="Event anda sudah diperbaharui.";$jenisAlert="alert-success";}
            else{$string="Event anda gagal diperbaharui, hubungi jogjasite untuk tindak lebih lanjut.";$jenisAlert="alert-danger";}
            break;
        case 'hapusArtikel': 
            if($ho == 1){$string="Event sudah terhapus.";$jenisAlert="alert-success";}
            else{$string="Proses hapus Event gagal, hubungi jogjasite untuk tindak lebih lanjut.";$jenisAlert="alert-danger";}
            break;
    }

 ?>

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Upppsss!</h4>
                <p>Anda harus mengaktifkan <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> untuk dapat menggunakan sistem ini.</p>
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
                <h2><i class="glyphicon glyphicon-info-sign"></i> Kelola Event</h2>
            </div>
            <div class="box-content row">
                <div class="col-lg-12 col-md-12">

                <?php if($hop != NULL): ?>
                    <div class="alert <?php echo $jenisAlert; ?>">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <?php echo $string; ?>
                </div>
                <?php endif; ?>

                <div class="page-header">
                    <h1>Kelola Event
                        <small>Kelola Event anda dengan mudah.</small>
                    </h1>
                </div>
                <div class="row">
                                <div class="box-content">
                                <?php if($blog['jumlahData'] <= 0): ?>
                                    <div class="well">
                                        <h2>Anda belum memiliki event untuk saat ini.</h2>
                                        <p>Perkaya website anda dengan tulisan-tulisan menarik untuk meningkatkan pengunjung, semakin banyak yang mengunjungi website anda, semakin diketahui banyak orang bisnis anda.</p>
                                        <center><a href="index.php?modul=artikel&aksi_modul=buatArtikel" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-chevron-left glyphicon-white"></i> Buat Event Sekarang</a></center>
                                    </div>
                                <?php else: ?>                                   
                                        <a style="float:right;display:block;margin-right:10px;" href="index.php?modul=artikel&aksi_modul=buatArtikel" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-chevron-left glyphicon-white"></i> Buat Event</a>                                    
                                    <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Event</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($blog['hasilData'] as $barisArtikel): ?>
                                                <tr>
                                                    <td>
                                                        <h3><?php echo $barisArtikel->judul_konten; ?></h3>
                                                        <p><b>Tanggal Posting :</b> <?php echo $barisArtikel->hari.", ".$barisArtikel->tgl_buat_tgl." ".$barisArtikel->tgl_buat_jam; ?></p>
                                                    </td>
                                                    <td class="center">
                                                    <div class="col-md-12 center-block">
                                                    <br>
                                                        <div class="btn-group">
                                                            <button class="btn btn-default btn-lg">Aksi</button>
                                                            <button class="btn dropdown-toggle btn-default btn-lg" data-toggle="dropdown"><span class="caret"></span></button>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="index.php?modul=artikel&aksi_modul=suntingArtikel&id_konten=<?php echo $barisArtikel->id_konten; ?>"><i class="glyphicon glyphicon-edit"></i> Sunting</a></li>
                                                                <li><a class="btn-hapus-<?php echo $barisArtikel->id_konten; ?>" href="#"><i class="glyphicon glyphicon-trash"></i> Hapus</a></li>                                                                                                                                
                                                            </ul>
                                                                <!-- modal pop up konfirmasi penghapusan file -->
                                                                <div class="modal fade" id="myModal-hapus-<?php echo $barisArtikel->id_konten; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                                                                    <h3>Konfirmasi</h3>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p>Anda yakin akan menghapus artikel <b>"<?php echo $barisArtikel->judul_konten; ?>"</b> ? 
                                                                                    Semua file (gambar) yang berkaitan dengan blog ini akan terhapus.</p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <a href="#" class="btn btn-default" data-dismiss="modal">Batal</a>
                                                                                    <a href="modul/modul_artikel/proses_artikel.php?&proses_artikel=hapus&id_konten=<?php echo $barisArtikel->id_konten; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-trash"></i> &nbsp; Hapus Event</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <!-- modal pop up konfirmasi penghapusan file -->
                                                            <script type="text/javascript">
                                                                $('.btn-hapus-<?php echo $barisArtikel->id_konten; ?>').click(function (e) {
                                                                    e.preventDefault();
                                                                    $('#myModal-hapus-<?php echo $barisArtikel->id_konten; ?>').modal('show');
                                                                });
                                                            </script>                                                            
                                                        </div>
                                                    </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                    </table>
        	<div class="col-md-12 center-block"><div class="dataTables_paginate paging_bootstrap pagination"><?php echo $paginator->render; ?></div></div>
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