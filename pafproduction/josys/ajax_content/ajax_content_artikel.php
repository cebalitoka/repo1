<?php 
	include("../konfigurasi_global.php");
	include("../class/Konten_Ganda.php");

	$jenisKonten = isset($_GET['jenis_konten']) ? $_GET['jenis_konten'] : "" ;
	$jenisKonten = $jenisKonten == "artikel" ? "Event" : $jenisKonten ;
	$idKonten = isset($_GET['id_konten']) ? $_GET['id_konten'] : "" ;
	$kontenGanda = Konten_Ganda::ambilKontenById($idKonten);


?> 
	<div class="col-lg-12 text-center">
    <h2 class="section-heading"><?php echo $jenisKonten; ?></h2>                    
	</div>
	<div class="col-lg-12 header-section-sketch-full">
	    <img class="gambar-header-section-sketch-full-modal" src="jolibs/common-site/img/header-gallery.png">                    
	</div>
	<div class="konten-margin-responsive-pop-up991">
		<div class="judul-konten-ajax"><?php echo $kontenGanda->judul_konten; ?></div>
		<h5 class="tgl-konten-ajax"><?php echo $kontenGanda->hari; ?>, <?php echo $kontenGanda->tgl_buat_tgl; ?></h5>
		<?php echo $kontenGanda->isi; ?>
	</div>