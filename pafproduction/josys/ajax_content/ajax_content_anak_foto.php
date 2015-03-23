<?php 
	include("../../josys/konfigurasi_global.php");
	include("../../josys/class/Photo.php");
	include("../../josys/class/Anak_gallery.php");

	$idAlbum = isset($_GET['id_album']) ? $_GET['id_album'] : "" ;	
	$anakFoto = Anak_gallery::ambilAnakGalleryByIdParent($idAlbum);


?> 

<?php foreach($anakFoto['hasilData'] as $baris): ?>
        <div class="col-md-4 col-sm-6 portfolio-item">
            <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
            <div class="wrapper_gambar">
                <!-- class="fancybox" data-fancybox-group="gallery" -->
                <center>
                    <a class="fancybox" id="list-foto-<?php echo $baris->id; ?> " href="joimg/halaman_tunggal/photo/<?php echo $baris->gambar; ?>" title="<?php echo $baris->keterangan; ?>">
                        <img src="joimg/halaman_tunggal/photo/kecil-<?php echo $baris->gambar; ?>" alt="" />                                            
                </center>                                                                     
            </div>
            <div class="portfolio-caption">                                        
                <h4 class="text-muted text-center"><?php echo $baris->keterangan; ?></h4></a>
            </div>
        </div>
<?php endforeach; ?>