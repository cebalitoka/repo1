<?php 

	require_once ("../../../josys/konfigurasi_global.php");
	require_once ("../../../josys/fungsi_global.php");
	require_once ("../../../josys/class/Konten_Ganda.php");

	if(isset($_POST['inputArtikel']) && $_POST['inputArtikel'] == "submit"){
		if(empty($_POST['judul_konten']) || empty($_POST['isi'])){
			$hasil = "kosong";		
		}else{
			$blog = new Konten_Ganda;
			$blog->simpanNilai($_POST);
			$hasil = $blog->buatKontenGanda();	
			$hasil = is_numeric($hasil) && $hasil > 0 ? 1 : 0 ;			
		}
		$hop = "buatArtikel";
	}elseif(isset($_POST['inputArtikel']) && $_POST['inputArtikel'] == "sunting"){
		if(empty($_POST['judul_konten']) || empty($_POST['isi'])){
			$hasil = "kosong";		
		}else{

			$artikel = new Konten_Ganda;
			$artikel->simpanNilai($_POST);
			$hasil = $artikel->suntingKontenGanda();	
			$hasil = is_numeric($hasil) && $hasil > 0 ? 1 : 0 ;			
		}
		$hop = "suntingArtikel";

	}elseif(isset($_GET['proses_artikel']) && $_GET['proses_artikel'] == "hapus"){
			$blog = Konten_Ganda::ambilKontenById($_GET['id_konten']);
			$hasil = $blog->hapusKontenGanda();
			$hop = "hapusBlog";
	}


	header("Location: ../../index.php?modul=artikel&aksi_modul=kelolaArtikel&hop=$hop&ho=$hasil");
	exit();

 ?>