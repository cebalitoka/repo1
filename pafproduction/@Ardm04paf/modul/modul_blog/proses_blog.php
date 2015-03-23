<?php 

	require_once ("../../../josys/konfigurasi_global.php");
	require_once ("../../../josys/fungsi_global.php");
	require_once ("../../../josys/class/Konten_Ganda.php");

	if(isset($_POST['inputBlog']) && $_POST['inputBlog'] == "submit"){
		if(empty($_POST['judul_konten']) || empty($_POST['isi'])){
			$hasil = "kosong";		
		}else{
			$blog = new Konten_Ganda;
			$blog->simpanNilai($_POST);
			$hasil = $blog->buatKontenGanda();	
			$hasil = is_numeric($hasil) && $hasil > 0 ? 1 : 0 ;			
		}
		$hop = "buatBlog";
	}elseif(isset($_POST['inputBlog']) && $_POST['inputBlog'] == "sunting"){
		if(empty($_POST['judul_konten']) || empty($_POST['isi'])){
			$hasil = "kosong";		
		}else{

			$artikel = new Konten_Ganda;
			$artikel->simpanNilai($_POST);
			$hasil = $artikel->suntingKontenGanda();	
			$hasil = is_numeric($hasil) && $hasil > 0 ? 1 : 0 ;			
		}
		$hop = "suntingBlog";

	}elseif(isset($_GET['proses_blog']) && $_GET['proses_blog'] == "hapus"){
			$blog = Konten_Ganda::ambilKontenById($_GET['id_konten']);
			$hasil = $blog->hapusKontenGanda();
			$hop = "hapusBlog";
	}


	header("Location: ../../index.php?modul=blog&aksi_modul=kelolaBlog&hop=$hop&ho=$hasil");
	exit();

 ?>