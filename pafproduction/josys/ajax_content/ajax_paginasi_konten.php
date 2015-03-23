<?php
    include("../../josys/konfigurasi_global.php");
    include("../../josys/class/Konten_Tunggal.php");
    include("../../josys/class/Konten_Ganda.php");
$item_per_page = 10;
//sanitize post value
if(isset($_POST["page"])){
	$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
	if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
}else{
	$page_number = 1;
}

//get current starting point of records
$position = (($page_number-1) * $item_per_page);

//Limit our results within a specified range. 
$jenisKonten = isset($_GET['jenis_konten']) ? $_GET['jenis_konten'] : "" ;
	switch($jenisKonten){
		case 'artikel':$jenis="artikel";break;
		case 'blog':$jenis="blog";break;
	}

$konten = Konten_Ganda::ambilSemuaKontenByJenisPaging($jenis,$item_per_page, $position);?>
<ul class="wrapper-list-konten">
	<?php  foreach($konten['hasilData'] as $baris): ?>

<script type="text/javascript">

$(document).ready(function() {
	$("#list-konten-<?php echo $jenisKonten; ?>-<?php echo $baris->id_konten; ?>").click(function(){
	    $("#ajaxKontenIsi").load("josys/ajax_content/ajax_content_artikel.php?jenis_konten=<?php echo $jenisKonten; ?>&id_konten=<?php echo $baris->id_konten; ?>");  
	    $(".paginasiKonten").bootpag({

	    <?php 
	        $item_per_halaman = 10;
	        $halaman = ceil(10/$item_per_halaman);   
	     ?>
	       total: <?php echo $halaman; ?>,
	       page: 1,
	       maxVisible: 5 
	    }).on("page", function(e, num){
	        e.preventDefault();
	        $("#ajaxKontenIsi").prepend('<div class="loading-indication"><img src="josys/ajax_content/ajax-loader.gif" /> Memuat Konten...</div>');
	        setTimeout(
	            $("#ajaxKontenIsi").load("josys/ajax_content/ajax_paginasi_konten.php?jenis_konten=blog", {'page':num})
	        ,50000);
	    });

	});
});
</script>

		<a class='linkKontenAjax' id="list-konten-<?php echo $jenisKonten; ?>-<?php echo $baris->id_konten; ?>" href='#ajax-pop-up-konten' data-toggle='modal'><li><span class='page_name'><?php echo $baris->judul_konten; ?></span></li></a>
	<?php endforeach; ?>	
</ul>





    